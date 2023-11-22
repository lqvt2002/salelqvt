<?php

namespace App\Http\Controllers\feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class feedbackController extends Controller
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
        //lấy ra danh sách các feedback
        $dataList = DB::table('feedback')
            ->orderBy('status','asc')
            ->orderBy('updated_at','desc')
            ->paginate(10); //dùng paginate để phân trang, 10 người trong 1 trang
        //kiểm tra nếu tồn tại 1 id nào đó thì lấy thông tin của id đó.
    
        //hiển thị ra Ds các feedback, và thông tin của 1 feedback dc chọn theo id
        return view('feedback.index')->with ([
            'dataList'=> $dataList,
            'index'=>0,
        ]);
    }

    public function update(request $request){
        $id= $request->id;
       DB::table('feedback')
        ->where('id',$id)
        ->update(['status'=>1,
                'updated_at'=>date('Y-m-d H:i:s')
                    ]);
    }
}
