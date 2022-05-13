<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\BlogRequest;


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
    public function index(Request $request)
    {
        $sort = $request->sort;
        if (is_null($sort)) {
            $sort = 'id';
           }
        $products = DB::table('products')->orderBy($sort, 'asc')->orderBy($sort,'desc')->Paginate(6);
        $param = ['products' => $products, 'sort' => $sort];
        return view('home',$param);
    }
    
    //登録画面
    public function create(){
        $products =product::all();
        $json = json_decode($products, true);
        return view('resisterpro',['products' => $products]);
    }
    //登録する
    public function exestore(BlogRequest $request){
        $inputs=$request->all();
        \DB::beginTransaction();
        try{
        Product::create($inputs);
        \DB::commit();
       return view('store');
        }catch(\Throwable $e){
        \DB::rollback();
        about(500);
    }
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
    public function exeUpdate(BlogRequest $request)
    {
        $inputs=$request->all();
        \DB::beginTransaction();
        try{
        $product = product::find($inputs['id']);
         $product->fill([
             'product_name' => $inputs['product_name'],
             'company_name' => $inputs['company_name'],
             'price' => $inputs['price'],
             'stock' => $inputs['stock'],
         ]);
         \DB::commit();
         $product -> save();
        return view('update');
         }catch(\throwable $e){
           \DB::rollback();
        about(500);
        }
     }

    //検索機能

    public function getSearch(request $request)
    {
        $query = Product::query();


        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $minStock = $request->minStock;
        $maxStock = $request->maxStock;
        $prices = $request->prices;
        $stockers = $request->stockers;

        $products = Product::where('product_name','like',"%$request->product_name%")->get();
        if((!empty($minPrice) or !empty($maxPrice))) {
            if(empty($minPrice)) {
              $minPrice = 0;
            }
            if(empty($maxPrice)) {
              $maxPrice = 9999999;
            }
            $prices = $query->from('products')->whereBetween('price',[$minPrice, $maxPrice])->get();
        }

        if((!empty($minStock) or !empty($maxStock))) {
            if(empty($minStock)) {
              $minStock = 0;
            }
            if(empty($maxStock)) {
              $maxStock = 9999999;
            }
            $stockers = $query->from('products')->whereBetween('stock',[$minStock, $maxStock])->get();
        }


        return response()->json([
            'products'=>$products,
            'minPrice'=>$minPrice,
            'maxPrice'=>$maxPrice,
            'prices'=>$prices,
            'minStock'=>$minStock,
            'maxStock'=>$maxStock,
            'stockers'=>$stockers,
        ]);
        
    }

    public function test(Request $request){
        $products = product::all();
        return view('sample',['products'=> $products]);
    }
    
        //削除機能
        public function delete($id){
            //削除対象レコードを検索
            $product = product::all(); 
            
            if ($product != null) {
                $product->each->delete();
            }
    
            return response()->json(['product'=>$product]);
        }


    }