<?php

namespace App\Http\Controllers\user;
use Illuminate\Support\Facades\Hash;// THƯ VIỆN MÃ HÓA MẬT KHÂUr
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class usercontroller extends Controller
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
        //lấy ra danh sách các user, dùng paginate để phân trang, 10 người trong 1 trang
        $dataList = DB::table('users')
            ->leftJoin('role','role.id','=','users.role_id') //Tại bảng role, lấy id của role trùng vs id_role trong users
            ->where('users.deleted',0)
            ->select('users.*','role.name as role_name')  //sau đó xuấ ra tất cả thuộc tính của bnagr users và tên của role
            ->paginate(10); //dùng paginate để phân trang, 10 người trong 1 trang
        
        //hiển thị ra Ds các user, và thông tin của 1 user dc chọn theo id
        return view('user.index')->with ([
            'dataList'=> $dataList,
            'index'=>0 //index để đánh STT người dung.
        ]);
}
    public function viewAdd(request $request){
        $roleList =DB::table('role')->get();
        
        $user =null;
        if(asset($request->id)&& $request->id>0){
            //nếu tồn tại id
            $user = DB::table('users')->where('id',$request->id)->get();
            if($user !=null && count($user)>0){
                $user=$user[0];
            } else{
                $user=null;
            }
        }
        else{
           
        }
        return view('user.viewAdd')->with ([
            'roleList'=>$roleList,
            'user'=>$user
        ]);

}
    public function add(request $request){
        $name= $request->name;
        $email= $request->email;
        $phonenumber= $request->phonenumber;
        $address= $request->address;
        $password=$request->password;
        $role_id=$request->role_id;
        $id=$request->id;
        if(asset($id)&& $id>0){
            //nếu tồn tại id
            if($password !=null){
                DB::table('users')->where('id',$id)->update([
                    'name'=>$name,
                    'phonenumber'=>$phonenumber,
                    'address'=>$address,
                    'password'=>Hash::make($password),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'role_id'=>$role_id
            ]);
            }
                else{
                    DB::table('users')->where('id',$id)->update([
                        'name'=>$name,
                        'phonenumber'=>$phonenumber,
                        'address'=>$address,
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'role_id'=>$role_id
                ]);
                }
            
        }
        else{
            //không có id nào cả=> thêm
            $check = DB::table('users')->where('email',$email)->get();
            if($check!=null && count($check)>0){
                return redirect()->route('user_index');
            }
            else{
                DB::table('users')->insert([
                    'name'=>$name,
                    'email'=>$email,
                    'phonenumber'=>$phonenumber,
                    'address'=>$address,
                    'password'=>Hash::make($password),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'role_id'=>$role_id
                ]);
            }
        }
        
        return redirect()->route('user_index');
    }
    public function delete(request $request){
        $id= $request->id;
       DB::table('users')
        ->where('id',$id)
        ->update(['deleted'=>1]);
        return redirect()->route('user_index');
    }
}
