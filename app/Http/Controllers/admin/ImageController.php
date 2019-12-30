<?php

namespace App\Http\Controllers\admin;

use App\Imagenes;
use DB;
use League\Flysystem\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = DriverInformationController::getListDrivers();
        $type_images = Imagenes::enum_assoc_tipo_doc;

        return view('admin.images', [
            'list_drivers' => $drivers,
            'type_images' => $type_images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date("Y-m-d");
        // echo '<pre>';
        // print_r($request->all());
        $file_type = request()->get('key');
        $cedula = request()->get('driver_information_dni_id');
        $file = $request->file('file');
        $size = $file->getSize();

        $validator = Validator::make(
            $request->all(),
            [
                'file' => ['required', 'max:1000', 'mimes:jpeg']
            ],
            [
                'file.required' => "Se debe seleccionar un archivo.",
                'file.max' => "El archivo supera el máximo peso permitido (2MB).",
                'file.mimes' => "Los formatos permitidos son: jpg.",
            ]
        );

        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['response' => 'validator errors', 'errors' => $errors]);
        }

        $check_document = DB::table('imagenes')
            ->where('imagenes.type_image', '=', $file_type)
            ->where('imagenes.driver_information_dni_id', '=', $cedula)
            ->select(DB::raw(
                'imagenes.image_id, 
                 imagenes.tipo_doc,
                 imagenes.url'
            ))->get()->toArray();
        // print_r($check_document);
        // die;
        if (!empty($check_document)) {
            return response()->json(['response' => 'file exists', 'errors' => ['message' => 'Este archivo del conductor ya ha sido subido.']]);
        }
        $filename = $file_type . '_' . $cedula . '_' . $date . '.jpg';
        $path = $cedula . '/' . $filename;

        $upload = Storage::disk('s3')->put($path, file_get_contents($file));
        if ($upload) {
            Imagenes::create([
                'tipo_doc' => $file_type,
                'url' => $path,
                'size_image' => $size,
                'type_image' => $file_type,
                'user_id' => auth()->id(),
                'driver_information_dni_id' => $cedula
            ]);
            return response()->json(['response' => 'ok', 'errors' => []]);
        } else {
            return response()->json(['response' => 'Carga fallida', 'errors' => ['response' => 'Carga fallida', 'message' => 'El archivo no se pudo cargar']]);
        }
    }


    public function downloadFile($path)
    {
        $clean_path = str_replace(" ", "/", $path);
        return Storage::disk('s3')->download($clean_path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDocumentsDriver(Request $request)
    {
        $driver_information_dni_id = $request->get('driver_information_dni_id');
        if (empty($driver_information_dni_id)) {
            return response()->json(['errors' => ['response' => 'vacío']]);
        }
        $checked_documents = [];
        $documents = DB::table('imagenes')
            ->where('imagenes.driver_information_dni_id', '=', $driver_information_dni_id)
            ->select(DB::raw(
                'imagenes.image_id, 
                 imagenes.tipo_doc,
                 imagenes.url'
            ))->get()->toArray();
        $list_documents = Imagenes::enum_assoc_tipo_doc;
        foreach ($documents as $key => $value) {
            $arr_documents[] = $value->tipo_doc;
            $arr_url_documents[$value->tipo_doc] = $value->url;
        }
        if (!empty($documents)) {
            foreach ($list_documents as $key_l => $value_l) {
                if (in_array($list_documents[$key_l], $arr_documents)) {
                    $checked_documents[$key_l]['check'] = 'Y';
                    $checked_documents[$key_l]['url'] = $arr_url_documents[$value_l];
                } else {
                    $checked_documents[$key_l]['check'] = 'N';
                }
            }
        } else {
            foreach ($list_documents as $key_l => $value_l) {
                $checked_documents[$key_l]['check'] = 'N';
            }
        }
        return response()->json(['errors' => '', 'documents' => $checked_documents]);
    }
}
