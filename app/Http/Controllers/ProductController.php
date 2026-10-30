<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        // return '<h1>this is productController index function</h1>';
        return view('products.index');
    }
}
