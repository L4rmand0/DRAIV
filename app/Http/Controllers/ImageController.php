<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;

class ImageController extends Controller
{
    public function saveImgS3(Request $request){
        dd($request->file('file'));
        // dd($request->all());
        die;
        request()->file('file')->store(
            'my-file','s3'
        );
    }
}
