<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\TextExtractDocuments;

class ApiController extends Controller
{
    protected $text_extract;

    public function __construct(TextExtractDocuments $text_extract)
    {
    	$this->text_extract = $text_extract;
    }

    public function index()
    {
    	// Get all the post
        $extracts = $this->text_extract->all();
        return response()->json(['response' => $extracts]);
    }

    public function show($id)
    {
    	$post = $this->post->findById($id);
    	return view('someview', compact('post'));
    }

}
