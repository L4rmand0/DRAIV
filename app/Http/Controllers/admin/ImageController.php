<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imagenes;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Illuminate\Support\Facades\Storage;

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
        echo '<pre>';
        print_r($request->all());
        $file = request()->file('file')[request()->get('key')];
        $size = $file->getSize();
        // if($size > 4000){
        //     return response()->json(['errors' => ['response' => 'El archivo debe pesar 4mb máximo.']]);
        // }
        // print_r($file->getSize());
        // die;
        // Storage::disk('s3')->put('','');
        // request()->file('file')->store(
        //     'my-file','s3'
        // );
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
}
