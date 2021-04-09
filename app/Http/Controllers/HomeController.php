<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products =product::all();
        return view('home',['products' => $products]);
    }
    //登録画面
    public function create(Request $request){
        $products =product::all();
        return view('resisterpro',['products' => $products]);
    }
    //登録する
    public function exestore(Request $request){
        $inputs=$request->all();
        Product::create($inputs);
       return view('store');
    }
    //詳細画面
    public function showDetail($id)
    {
        $product = product::find($id);
        return view('productDatail',['product'=> $product]);
    }
    
    //商品編集画面表示
    public function showEdit($id){
       $product = product::all(); 
       $product = product::find($id);
       return view('edit',['product'=> $product]);
    }

    //更新する
    public function exeUpdate(Request $request){
        $inputs = $request ->all();
        
        $product = product::find($inputs['id']);
         $product->fill([
             'product_name'=> $inputs['product_name'],
             'company_name'=> $inputs['company_name'],
             'price'=> $inputs['price'],
             'stock'=> $inputs['stock'],
         ]);
         $product->save();
         
        return view('update');
     }

}
