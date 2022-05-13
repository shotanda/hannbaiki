<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class UserController extends Controller
{

    public function index()
    {
     $products = sale::all();
    return view('sale',['products'=>$products]);
    }
    

}