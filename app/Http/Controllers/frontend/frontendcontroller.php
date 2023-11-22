<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\order;
class frontendcontroller extends Controller
{
    public function index(request $request){
        $productList =DB::table('product')
            ->leftJoin('category','category.id','=','product.category_id') //Nó nối các dòng dữ liệu từ bảng "product" với các dòng dữ liệu từ bảng "category" dựa trên điều kiện rằng "id" từ bảng "category" phải trùng với "category_id" từ bảng "product". Điều này giúp kết hợp thông tin từ hai bảng dữ liệu trong kết quả truy vấn.
            ->where('product.deleted',0)
            ->select('product.*','category.name as category_name')  //sau đó xuấ ra tất cả thuộc tính của bnagr product và tên của category
            ->take(8)
            ->get();
        $categoryList =DB::table('category')
            ->get();
        return view('frontend.home')->with([
            'productList'=> $productList,
            'categoryList'=> $categoryList,
            'cartNum' => $this->getCartNum()
        ]);
    }

    public function showProduct(request $request){
        $categoryList =DB::table('category')
            ->get();
        if(asset($request->categoryUrl)&& $request->categoryUrl !=null){
                //nếu tồn tại id
                //Lấy id của cái danh mục này.
                $check =DB::table('category')
                    ->where('categoryUrl',  $request->categoryUrl)
                    ->select('category.id')
                    ->first();
                if($check!=null){
                    $productList =DB::table('product')
                    ->leftJoin('category','category.id','=','product.category_id') //Nó nối các dòng dữ liệu từ bảng "product" với các dòng dữ liệu từ bảng "category" dựa trên điều kiện rằng "id" từ bảng "category" phải trùng với "category_id" từ bảng "product". Điều này giúp kết hợp thông tin từ hai bảng dữ liệu trong kết quả truy vấn.
                    ->where('product.deleted',0)
                    ->where('product.category_id',$check->id) //lấy tất cả các sp trong danh mục này theo id
                    ->select('product.*','category.name as category_name')  //sau đó xuấ ra tất cả thuộc tính của bnagr product và tên của category
                    ->paginate(6);
                } else{
                    return view('frontend.notFound');
                }
        }else{
            $productList =DB::table('product')
                ->leftJoin('category','category.id','=','product.category_id') //Tại bảng category, lấy id của category trùng vs id_category trong product
                ->where('product.deleted',0)
                ->select('product.*','category.name as category_name')  //sau đó xuấ ra tất cả thuộc tính của bnagr product và tên của category
                ->paginate(6);
        }

        return view('frontend.product')->with([
            'productList'=> $productList,
            'categoryList'=> $categoryList,
            'cartNum' => $this->getCartNum()
        ]);
    }

    public function showDetail(request $request){
        //HIỂN THỊ THÔNG TIN CHI TIẾT CỦA SẢN PHẨM
        $product =null;
        if(asset($request->id)&& $request->id>0){
            //nếu tồn tại id
            $product = DB::table('product')->where('id',$request->id)->get();
            if($product !=null && count($product)>0){
                $product=$product[0];
            } else{
                return view('frontend.notFound')->with([
                    'cartNum' => $this->getCartNum()
                ]);
            }
        }
        else{
            return view('frontend.notFound')->with([
                'cartNum' => $this->getCartNum()
            ]);
        }
        $productList =DB::table('product')
            ->leftJoin('category','category.id','=','product.category_id') //Nó nối các dòng dữ liệu từ bảng "product" với các dòng dữ liệu từ bảng "category" dựa trên điều kiện rằng "id" từ bảng "category" phải trùng với "category_id" từ bảng "product". Điều này giúp kết hợp thông tin từ hai bảng dữ liệu trong kết quả truy vấn.
            ->where('product.deleted',0)
            ->select('product.*','category.name as category_name')  //sau đó xuấ ra tất cả thuộc tính của bnagr product và tên của category
            ->take(8)
            ->get();
        $categoryList =DB::table('category')
            ->get();
        return view('frontend.detail')->with([
            'productList'=> $productList,
            'categoryList'=> $categoryList,
            'product'=>$product,
            'cartNum' => $this->getCartNum()
        ]);
    }

    public function showContact(request $request){
        return view('frontend.contact')->with([
            'cartNum' => $this->getCartNum()
        ]);
    }
    public function postContact(request $request){
        $fullname= $request->fullname;
        $email=$request->email;
        $phonenumber= $request->phonenumber;
        $subject= $request->subject;
        $note= $request->note;
                DB::table('feedback')->insert([
                    'fullname'=>$fullname,
                    'email'=>$email,
                    'phonenumber'=>$phonenumber,
                    'subject_name'=>$subject,
                    'note'=>$note,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'status'=>0
                ]);
        return redirect()->route('frontend_showContact')->with([
            'cartNum' => $this->getCartNum()
        ]);
    }

    public function showInfor(request $request){
        return view('frontend.infor')->with([
            'cartNum' => $this->getCartNum()
        ]);
    }
    
    public function showCart(request $request){
        $cartList =[];
        //Lấy danh sacsch các SP trong giỏ hàng
        if (isset($_COOKIE['cart'])){
            $cartList= json_decode($_COOKIE['cart']);
        }
        //Sau đó lấy danh sách các id trong giỏ hàng
        $idList=[];
        foreach($cartList as $item){
            $idList[] =$item->id;
        }
        //Sau đó truy vấn thông tin sản phẩm
        $cartProductList =DB::table('product')
            ->where('deleted',0)
            ->whereIn('id',$idList)
            ->get();
        //Lấy số lượng của mỗi sản phẩm.
        for($i=0; $i<count($cartProductList); $i++){
            for($j=0; $j<count($cartList); $j++){
                if($cartProductList[$i]->id == $cartList[$j]->id){
                    $cartProductList[$i]->num = $cartList[$j]->num;
                    break;
                }
            }
        }
        return view('frontend.cart')->with([
            'cartProductList'=> $cartProductList,
            'cartNum' => $this->getCartNum()
            ]);
    }
    //NHẬP DỮ LIỆU VÀO CSDL
    public function postCart(request $request){
        $cartList =[];
        //Lấy danh sacsch các SP trong giỏ hàng
        if (isset($_COOKIE['cart'])){
            $cartList= json_decode($_COOKIE['cart']);
        }
        //NẾU GIỎ HÀNG RÕ THÌ RETURN LẠI CHÍNH TRANG ĐÓ.
        if($cartList==null && count($cartList)==0){
            return redirect()->route('frontend_showCart')->with([
                'cartNum' => $this->getCartNum()
            ]);
        }
        //Sau đó lấy danh sách các id trong giỏ hàng
        $idList=[];
        foreach($cartList as $item){
            $idList[] =$item->id;
        }
        //Sau đó truy vấn thông tin sản phẩm
        $cartProductList =DB::table('product')
            ->where('deleted',0)
            ->whereIn('id',$idList)
            ->get();
        //Lấy số lượng của mỗi sản phẩm.
        for($i=0; $i<count($cartProductList); $i++){
            for($j=0; $j<count($cartList); $j++){
                if($cartProductList[$i]->id == $cartList[$j]->id){
                    $cartProductList[$i]->num = $cartList[$j]->num;
                    break;
                }
            }
        }
        
        $name= $request->name;
        $email=$request->email;
        $phonenumber= $request->phonenumber;
        $address= $request->address;
        $note= $request->note;
        $totalmoney= $request->totalmoney;
        $orderItem = order::create([
            'name'=>$name,
            'email'=>$email,
            'phonenumber'=>$phonenumber,
            'address'=>$address,
            'note'=>$note,
            'totalmoney'=>$totalmoney,
            'order_date'=>date('Y-m-d H:i:s'),
            'status'=>0,
            'user_id'=>2
        ]);
        //Add dữ liệu của SP vào bảng chi tiết SP.
        foreach($cartProductList as $item){
            DB::table('order_detail')->insert([
                'order_id'=>$orderItem->id,
                'product_id'=>$item->id,
                'price'=>$item->discount,
                'number'=>$item->num,
                'totalmoney'=>$item->discount*$item->num,
            ]);
        }
       setcookie("cart",'',time(),'/');
        return redirect()->route('frontend_showCheckout')->with([
            'cartNum' => $this->getCartNum()
        ]);

    }

    public function showCheckout(request $request){
        return view('frontend.checkout')->with([
            'cartNum' => $this->getCartNum()
        ]);
    }

    public function showNotFound(request $request){
        return view('frontend.notFound')->with([
            'cartNum' => $this->getCartNum()
        ]);
    }
    
    //HÀM HIỂN THỊ SỐ LƯỢNG SP TRONG GIỎ HÀNG. (HIỂN THỊ TRÊN ICON)
    private function getCartNum(){
        $cartList =[];
        if (isset($_COOKIE['cart'])){
            $cartList= json_decode($_COOKIE['cart']);
            $num=0;
            foreach($cartList as $item){
                $num += $item->num;
            }
            return $num;
        } else{
            return 0;
        }
    }
}
