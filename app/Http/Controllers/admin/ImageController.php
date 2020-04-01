<?php

namespace App\Http\Controllers\admin;

use App\Imagenes;
use DB;
use League\Flysystem\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ImagenesVehiculo;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_id = auth()->user()->id;
        // $permissions = $this->getPermissions($user_id);
        // $drivers = DriverInformationController::getListDrivers();
        // $type_images = Imagenes::enum_assoc_tipo_doc;
        // $company_id = auth()->user()->company_id;
        // $company = CompanyController::getCompanyByid($company_id);

        // return view('admin.images', [
        //     'list_drivers' => $drivers,
        //     'type_images' => $type_images,
        //     'company_name' => ucwords(strtolower($company->company)),
        //     'permissions' => $permissions,
        // ]);
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
        // $date = date("Y-m-d");
        $now = date("Y-m-d H-i-s");
        $now_new = str_replace(" ", "-", $now);
        $now_new = str_replace("-", "", $now_new);
        // echo '<pre> acá';
        // print_r($request->file('file'));
        // print_r($request->all());
        // die;
        $file_type = request()->get('key');
        $cedula = Request()->get('driver_information_dni_id');
        // $cedula = request()->get('driver_information_dni_id');
        $file = $request->file('file')[$file_type];
        $size = $file->getSize() / 1024;
        $extension = $file->getClientOriginalExtension();
        $extensions_permited = ['jpg'];
        if (!in_array($extension, $extensions_permited)) {
            return response()->json(['response' => 'validator errors', 'errors' => ['file' => ['Los formatos permitidos son: jpg']]]);
        }
        if ($size > 5120) {
            return response()->json(['response' => 'validator errors', 'errors' => ['file' => ['El archivo supera el máximo peso permitido (5MB).']]]);
        }
        $check_document = DB::table('imagenes')
            ->where('imagenes.tipo_doc', '=', $file_type)
            ->where('imagenes.driver_information_dni_id', '=', $cedula)
            ->select(DB::raw(
                'imagenes.image_id, 
                 imagenes.tipo_doc,
                 imagenes.url,
                 imagenes.operation'
            ))->first();
        // El nombre del archivo es el tipo de imagemn + la cédula + la fecha del momento horas, minutos y segundos
        $filename = $file_type . '_' . $cedula . '_' . $now_new . '.jpg';
        //el path almacena las imágenes en una carpeta con la cédula del conductor y el nombre del archivo
        $path = $cedula . '/' . $filename;

        if (!empty($check_document)) {
            // Si el registro del documento existe y está delete, entonces actualiza el registro y 
            //lo pone en el s3 y también borra el anterior documento del s3
            if ($check_document->operation == 'D') {
                $image_id = $check_document->image_id;
                $path_old = $check_document->url;
                $upload = Storage::disk('s3')->put($path, file_get_contents($file));
                if ($upload) {
                    $delete_file = Storage::disk('s3')->delete($path_old);
                    $response = Imagenes::where('image_id', $image_id)->update([
                        'url' => $path,
                        'size_image' => $size,
                        'type_image' => $extension,
                        'operation' => 'U',
                        'user_id' => auth()->id(),
                        'date_operation' => $now
                    ]);
                    return response()->json(['response' => 'ok', 'errors' => []]);
                } else {
                    return response()->json(['response' => 'Carga fallida', 'errors' => ['response' => 'Carga fallida', 'message' => 'El archivo no se pudo cargar']]);
                }
            } else {
                return response()->json(['response' => 'file exists', 'errors' => [
                    'message' => 'Este archivo ya fue cargado ¿Desea reemplazarlo?',
                    'id' => $check_document->image_id,
                    'path' => $check_document->url
                ]]);
            }
        } else {
            $upload = Storage::disk('s3')->put($path, file_get_contents($file));
            if ($upload) {
                Imagenes::create([
                    'tipo_doc' => $file_type,
                    'url' => $path,
                    'size_image' => $size,
                    'type_image' => $extension,
                    'user_id' => auth()->id(),
                    'driver_information_dni_id' => $cedula
                ]);
                return response()->json(['response' => 'ok', 'errors' => []]);
            } else {
                return response()->json(['response' => 'Carga fallida', 'errors' => ['response' => 'Carga fallida', 'message' => 'El archivo no se pudo cargar']]);
            }
        }
    }

    public function storeVehicles(Request $request)
    {
        $now = date("Y-m-d H-i-s");
        $now_new = str_replace(" ", "-", $now);
        $now_new = str_replace("-", "", $now_new);
        $file_type = request()->get('key');
        $index = request()->get('index');
        $cedula = Request()->get('driverInformation')['dni_id'];
        $plate_id = Request()->get('plate');
        $user_vehicle_id = DB::table('user_vehicle as uv')
            ->where('uv.driver_information_dni_id', '=', $cedula)
            ->where('uv.vehicle_plate_id', '=', $plate_id)
            ->where('uv.operation', '!=', 'D')
            ->select(DB::raw(
                'uv.id, 
                uv.vehicle_plate_id,
                uv.driver_information_dni_id'
            ))->first()->id;
        //Se obtiene toda la información del archivo a subir        
        $file = $request->file('file')[$index][$file_type];
        
        $size = $file->getSize() / 1024;
        $extension = $file->getClientOriginalExtension();
        $extensions_permited = ['jpg','jpeg'];
        //Se hacen las validaciones a la imagen
        if (!in_array($extension, $extensions_permited)) {
            return response()->json(['response' => 'validator errors', 'errors' => ['file' => ['Los formatos permitidos son: jpg']]]);
        }
        if ($size > 5120) {
            return response()->json(['response' => 'validator errors', 'errors' => ['file' => ['El archivo supera el máximo peso permitido (5MB).']]]);
        }
        // Se revisa que el archivo no exista en la tabla de imágenes
        $check_document = DB::table('imagenes_vehiculo as iv')
            ->where('iv.tipo_doc', '=', $file_type)
            ->where('iv.user_vehicle_id', '=', $user_vehicle_id)
            ->select(DB::raw(
                'iv.image_id, 
                 iv.tipo_doc,
                 iv.url,
                 iv.operation'
            ))->first();
        // El nombre del archivo es el tipo de imagemn + la cédula + la fecha del momento horas, minutos y segundos
        $filename = $file_type . '_' . $cedula . '_' . $now_new . '.jpg';
        //el path almacena las imágenes en una carpeta con la cédula del conductor y el nombre del archivo
        $path = $cedula . '/vehicles/' . $filename;

        if (!empty($check_document)) {
            // echo ' no está vació ';
            // Si el registro del documento existe y está delete, entonces actualiza el registro y 
            //lo pone en el s3 y también borra el anterior documento del s3
            if ($check_document->operation == 'D') {
                $image_id = $check_document->image_id;
                $path_old = $check_document->url;
                $upload = Storage::disk('s3')->put($path, file_get_contents($file));
                if ($upload) {
                    $delete_file = Storage::disk('s3')->delete($path_old);
                    $response = ImagenesVehiculo::where('image_id', $image_id)->update([
                        'url' => $path,
                        'size_image' => $size,
                        'type_image' => $extension,
                        'operation' => 'U',
                        'user_id' => auth()->id(),
                        'date_operation' => $now
                    ]);
                    return response()->json(['response' => 'ok', 'errors' => []]);
                } else {
                    return response()->json(['response' => 'Carga fallida', 'errors' => ['response' => 'Carga fallida', 'message' => 'El archivo no se pudo cargar']]);
                }
            } else {
                return response()->json(['response' => 'file exists', 'errors' => [
                    'message' => 'Este archivo ya fue cargado ¿Desea reemplazarlo?',
                    'id' => $check_document->image_id,
                    'path' => $check_document->url
                ]]);
            }
        } else {
            // echo ' vacio ';
            $upload = Storage::disk('s3')->put($path, file_get_contents($file));
            if ($upload) {
                ImagenesVehiculo::create([
                    'tipo_doc' => $file_type,
                    'url' => $path,
                    'size_image' => $size,
                    'type_image' => $extension,
                    'user_id' => auth()->id(),
                    'user_vehicle_id' => $user_vehicle_id
                ]);
                return response()->json(['response' => 'ok', 'errors' => []]);
            } else {
                return response()->json(['response' => 'Carga fallida', 'errors' => ['response' => 'Carga fallida', 'message' => 'El archivo no se pudo cargar']]);
            }
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
    public function update(Request $request)
    {
        $now = date("Y-m-d H-i-s");
        $now_new = str_replace(" ", "-", $now);
        $now_new = str_replace("-", "", $now_new);
        $date = date("Y-m-d");
        // echo '<pre>';
        // print_r($request->all());
        // die;

        //Se arma el nuevo path del archivo
        $file_type = request()->get('key');
        $image_id = request()->get('id');
        // $cedula = request()->get('driver_information_dni_id');
        $cedula = Request()->get('driver_information_dni_id');
        $path_old = request()->get('url');
        $file = $request->file('file')[$file_type];
        $filename = $file_type . '_' . $cedula . '_' . $now_new . '.jpg';
        $path = $cedula . '/' . $filename;

        $response = 0;
        //Se sube el archivo al S3
        $upload = Storage::disk('s3')->put($path, file_get_contents($file));
        if ($upload) {
            //Si, sube el archivo entonces se actualiza el registro con el nuevo path y la fecha de operación
            $delete_file = Storage::disk('s3')->delete($path_old);
            $response = Imagenes::where('image_id', $image_id)->update([
                'url' => $path,
                'operation' => 'U',
                'date_operation' => $now,
                'user_id' => auth()->id()
            ]);
        }

        if ($response > 0) {
            return response()->json(['errors' => '', 'response' => 'ok', 'messagge' => 'Archivo Actualizado correctamente.']);
        } else {
            return response()->json(['errors' => ['response' => 'el archivo no se puedo actualizar.'], 'response' => 'error update']);
        }
    }

    public function updateVehicles(Request $request)
    {
        $now = date("Y-m-d H-i-s");
        $now_new = str_replace(" ", "-", $now);
        $now_new = str_replace("-", "", $now_new);
        $date = date("Y-m-d");
        $cedula = Request()->get('driverInformation')['dni_id'];
        $plate_id = Request()->get('plate');
        // $user_vehicle_id = DB::table('user_vehicle as uv')
        //     ->where('uv.driver_information_dni_id', '=', $cedula)
        //     ->where('uv.vehicle_plate_id', '=', $plate_id)
        //     ->where('uv.operation', '!=', 'D')
        //     ->select(DB::raw(
        //         'uv.id, 
        //         uv.vehicle_plate_id,
        //         uv.driver_information_dni_id'
        //     ))->first()->id;
        // echo '<pre>';
        // print_r($request->all());
        // print_r($user_vehicle_id);
        // die;
        //Se arma el nuevo path del archivo
        $file_type = request()->get('key');
        $index = request()->get('index');
        $image_id = request()->get('id');
        // $cedula = request()->get('driver_information_dni_id');
        $path_old = request()->get('url');
        $file = $request->file('file')[$index][$file_type];
        $filename = $file_type . '_' . $cedula . '_' . $now_new . '.jpg';
        $path = $cedula . '/vehicles/' . $filename;

        $response = 0;
        //Se sube el archivo al S3
        $upload = Storage::disk('s3')->put($path, file_get_contents($file));
        if ($upload) {
            //Si, sube el archivo entonces se actualiza el registro con el nuevo path y la fecha de operación
            $delete_file = Storage::disk('s3')->delete($path_old);
            $response = ImagenesVehiculo::where('image_id', $image_id)->update([
                'url' => $path,
                'operation' => 'U',
                'date_operation' => $now,
                'user_id' => auth()->id()
            ]);
        }
        if ($response > 0) {
            return response()->json(['errors' => '', 'response' => 'ok', 'messagge' => 'Archivo Actualizado correctamente.']);
        } else {
            return response()->json(['errors' => ['response' => 'el archivo no se puedo actualizar.'], 'response' => 'error update']);
        }
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
            ->where('imagenes.operation', '!=', 'D')
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
            $has_documents_required = false;
        } else {
            foreach ($list_documents as $key_l => $value_l) {
                $checked_documents[$key_l]['check'] = 'N';
            }
            $has_documents_required = false;
        }
        // echo '<pre>';
        // print_r($checked_documents);
        // die;
        $has_documents_required = $this->checkRequiredDocuments($documents);
        return response()->json(['errors' => '', 'documents' => $checked_documents, 'documents_required' => $has_documents_required]);
    }

    public function checkRequiredDocuments($documents)
    {
        $documents_required = Imagenes::REQUIRED_DOCUMENTS;
        // echo '<pre> in';
        // print_r($documents);
        // print_r($documents_required);
        $total_req = count($documents_required);
        $total_docs = 0;
        foreach ($documents as $key_doc => $value_doc) {
            foreach ($documents_required as $key_req => $value_req) {
                if ($value_doc->tipo_doc == $value_req) {
                    $total_docs++;
                }
            }
        }
        if ($total_docs == $total_req) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIncompleteDocumentDrivers($company_id)
    {
        $images = $this->getAllImages($company_id);
        $required_documents = Imagenes::REQUIRED_DOCUMENTS;
        $number_documents = count($required_documents);
        $last_documwent = end($required_documents);
        foreach ($required_documents as $key => $value) {
            $number_documents_drivers = 0;
            foreach ($images as $key => $value) {
            }
            if ($number_documents_drivers == $number_documents) {
            } else {
            }
        }
    }

    public function getAllImages($company_id)
    {
        return  DB::table('imagenes as i')
            ->select(DB::raw(
                'tipo_doc, driver_information_dni_id'
            ))
            ->join('driver_information as di', 'di.dni_id', '=', 'i.driver_information_dni_id')
            ->where('i.operation', '!=', 'D')
            ->where('di.company_id', '=', $company_id)
            ->orderBy('driver_information_dni_id', 'desc')
            ->get()->toArray();
    }

    public function validateInformation()
    {
        return response()->json(['response' => 'ok', 'errors' => []]);
    }
}
