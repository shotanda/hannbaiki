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
        $product =Product::all();
        $sort = $request->sort;
        if (is_null($sort)) {
            $sort = 'id';
           }
        $products = DB::table('products')->orderBy($sort, 'asc')->orderBy($sort,'desc')->Paginate(6);
        $param = ['products' => $products, 'sort' => $sort,'maxprice' => '',
         'minprice' => '','maxstock' =>'','minstock' =>''];
        
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
    public function Search(Request $request)
    {
        // キーワードを取得
        $keyword = $request->input('keyword');
        
        //クエリ作成
        $query = product::query();

        //キーワードが入力されている場合
        if(!empty($keyword)){
        $query->where('product_name', 'like', '%'.$keyword.'%')
              ->orWhere('company_name','like','%'.$keyword.'%');
        }
        $products = $query->get();
         
        return view('home')->with(compact("products","keyword"));


    }

    public function getsearch(){
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $minstock = $request->minstock;
        $maxprice = $request->maxstock;

        $targets = product::minprice($minprice)->
                       maxprice($maxprice)->get();
        $stockers = product::minstock($minstock)->
                       maxstock($maxstock)->get();
        $param = ['input' => $request ->input,'param' =>$parem];
        return view('home',$param);
    }
    
                    
    
    //削除機能
    public function delete($id){
        //削除対象レコードを検索
        $products = Product::find($id);
        //削除
        $products->delete();
        return redirect()->to('home');
    }
 
    
    

    //APIを作る
    
}

  

