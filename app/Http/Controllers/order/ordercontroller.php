<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ordercontroller extends Controller
{
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
        //lấy ra danh sách các order
        $dataList = DB::table('order')
            ->orderBy('status','asc')
            ->orderBy('order_date','desc')
            ->paginate(10); //dùng paginate để phân trang, 10 người trong 1 trang
        //kiểm tra nếu tồn tại 1 id nào đó thì lấy thông tin của id đó.
    
        //hiển thị ra Ds các order, và thông tin của 1 order dc chọn theo id
        return view('order.index')->with ([
            'dataList'=> $dataList,
            'index'=>0,
        ]);
    }

    public function detail(request $request){
        $id= $request->id;
        //   LẤY THÔNG TIN CỦA ĐƠN HÀNG TRONG BẢNG ORDER 
        $dataList = DB::table('order')
        ->where('id',$id)
        ->get();
        // SAU ĐÓ LẤY THÔNG TIN CHI TIẾT CỦA CÁC SP TRONG ĐƠN HÀNG.
        if($dataList !=null){
            $orderItem =$dataList[0];
            $itemList =DB::table('order_detail')
                -> leftjoin('product', 'product.id','=', 'order_detail.product_id')
                ->where ('order_detail.order_id',$id)
                ->select('order_detail.*','product.title','product.thumbnail')
                ->get();
                //TRẢ VỀ THÔNG TIN ĐƠN HÀNG VÀ CÁC SP CÓ TRONG ĐƠN HÀNG. và hiển thị tại file order/detail.blade.php
            return view('order.detail')->with([
                'index'=>0,
                'orderItem'=>$orderItem,
                'itemList'=>$itemList
            ]);
        }
    }


    public function update(request $request){
        $id= $request->id;
       DB::table('order')
        ->where('id',$id)
        ->update(['status'=> $request->status                ]);
    }
}
