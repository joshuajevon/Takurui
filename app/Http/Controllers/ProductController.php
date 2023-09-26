<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function welcome(){
        return view('main.welcome');
    }

    public function product(){
        return view('main.product');
    }

    public function productById(){
        return view('main.productById');
    }
}
