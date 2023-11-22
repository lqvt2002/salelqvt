<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class productcontroller extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //Yêu cầu đăng nhập thì mới dc vào trang quản trị
        $this->middleware('checkPermission'); //Kiểm tra nếu role_id=1 thì mới truy cập dc chức năng này.
    }
    
    public function index(request $request){
        //lấy ra danh sách các sản phẩm, dùng paginate để phân trang, 10 sp trong 1 trang
        $dataList = DB::table('product')
            ->leftJoin('category','category.id','=','product.category_id') //Tại bảng category, lấy id của category trùng vs id_category trong product
            ->orderBy('product.updated_at','desc')//Sắp xếp sp theo ngày sửa gần nhất
            ->where('product.deleted',0)
            ->select('product.*','category.name as category_name')  //sau đó xuấ ra tất cả thuộc tính của bnagr product và tên của category
            ->paginate(10); //dùng paginate để phân trang, 10 người trong 1 trang
        
        //hiển thị ra Ds các product, và thông tin của 1 product dc chọn theo id
        return view('product.index')->with ([
            'dataList'=> $dataList,
            'index'=>0 //index để đánh STT người dung.
        ]);
}
    public function viewAdd(request $request){
        $categoryList =DB::table('category')->get();
        $product =null;
        if(asset($request->id)&& $request->id>0){
            //nếu tồn tại id
            $product = DB::table('product')->where('id',$request->id)->get();
            if($product !=null && count($product)>0){
                $product=$product[0];
            } else{
                $product=null;
            }
        }
        else{
        
        }
        return view('product.viewAdd')->with ([
            'categoryList'=>$categoryList,
            'product'=>$product
        ]);

    }
    public function add(request $request){
        $title= $request->title;
        $category_id=$request->category_id;
        $price= $request->price;
        $discount= $request->discount;
        $decription= $request->decription;
        $thumbnail=$request->thumbnail;

        $id=$request->id;

        if(asset($id)&& $id>0){
            //nếu tồn tại id
                DB::table('product')->where('id',$id)->update([
                    'title'=>$title,
                    'category_id'=>$category_id,
                    'price'=>$price,
                    'discount'=>$discount,
                    'decription'=>$decription,
                    'thumbnail'=>$thumbnail,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                }
            
        else{
            //không có id nào cả=> thêm
            $productUrl = getProductUrl($title);
                DB::table('product')->insert([
                    'title'=>$title,
                    'category_id'=>$category_id,
                    'price'=>$price,
                    'discount'=>$discount,
                    'decription'=>$decription,
                    'thumbnail'=>$thumbnail,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'productUrl'=>$productUrl
                ]);
            }

        return redirect()->route('product_index');
    }
    public function delete(request $request){
        $id= $request->id;
        DB::table('product')
        ->where('id',$id)
        ->update(['deleted'=>1]);
        return redirect()->route('product_index');
    }
}
