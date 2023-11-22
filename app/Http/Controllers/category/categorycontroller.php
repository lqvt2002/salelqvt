<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class categorycontroller extends Controller
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
    //
    public function index(request $request){
        //lấy ra danh sách các category
        $dataList = DB::table('category')->get();
        //kiểm tra nếu tồn tại 1 id nào đó thì lấy thông tin của id đó.
        $id= $request->id;
        $name='';
        if(asset($id)&& $id>0){
            $item = DB::table('category')->where('id',$id)->get();
            if($item !=null && count($item)>0){
                //lấy tên của id đó ra.
                $name=$item[0]->name;
            }
        }
        //hiển thị ra Ds các category, và thông tin của 1 category dc chọn theo id
        return view('category.index')->with ([
            'dataList'=> $dataList,
            'index'=>0,
            'id'=>$id,
            'name'=>$name
        ]);
    }
    public function add(request $request){
        $name= $request->name;
        $id=$request->id;
        if(asset($id)&& $id>0){
            //nếu tồn tại id
            DB::table('category')->where('id',$id)->update([
                'name'=>$name
            ]);
        }
        else{
            //không có id nào cả=> thêm
            $check = DB::table('category')->where('name',$name)->get();
            if($check!=null && count($check)>0){
                //fail.
            }else{
                DB::table('category')->insert([
                    'name'=>$name
                ]);
            }
        }
        return redirect()->route('category_index');
    }
    public function delete(request $request){
        $id= $request->id;
       DB::table('category')->where('id',$id)->delete();
        return redirect()->route('category_index');
    }
}
