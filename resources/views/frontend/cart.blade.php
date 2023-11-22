@php
$title='LQVTSale';
@endphp

@extends('layouts.frontend')

@section('content')
<section class="">
    <div class="">
        <form class="" method="post" role="form" action="{{route('frontend_postCart')}}">
            @csrf
            <div class="card-body bg-light">
                <div class="row text-center pt-3 pb-3">
                    <div class="col-lg-6 m-auto">
                        <h1 class="h1">Giỏ hàng.</h1>
                        <p>Hãy nhập thông tin của bạn và kiểm tra đơn hàng thật cẩn thận nhé.</p>
                    </div>
                </div>
                <div class="row container m-auto">
                    <div class="col-lg-4 mt-5" style="background-color: white;">
                        <div style="text-align:center; margin:10px;">
                            <h3 class="h3" style="color: #56ae6c;">THÔNG TIN KHÁCH HÀNG</h3>
                        </div>
                        <div class="mb-3">
                                <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Họ và tên" required>
                            </div>
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <input type="number" class="form-control mt-1" id="phonenumber" name="phonenumber" placeholder="Số điện thoại" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control mt-1" id="address" name="address" placeholder="Địa chỉ nhận hàng." required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control mt-1" id="note" name="note" placeholder="Ghi chú (Nếu có)" rows="5"></textarea >
                        </div>
                    </div>  
                    <!-- col end -->
                    <div class="col-lg-8 mt-5">
                        <div class="card">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0" style="width:50%;">Tên sản phẩm</th>
                                            <th class="border-top-0" style="width:10%;">Hình ảnh</th>
                                            <th class="border-top-0" style="width:10%;">Giá</th>
                                            <th class="border-top-0" style="width:15%;">Số lượng</th>
                                            <th class="border-top-0" style="width:15%;">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total=0;
                                        @endphp
                                    @foreach($cartProductList as $item)
                                        @php
                                        $total += $item->discount*$item->num;
                                        @endphp
                                        <tr>
                                            <td>{{$item->title}}</td>
                                            <td><img src="{{$item->thumbnail}}" style="width:100px" alt=""></td>
                                            <td>{{number_format($item->discount)}}</td>
                                            <td>
                                             <input type="number" name="num" value="{{$item->num}}" style="width:50px" onchange="updateCart({{$item->id}}, this.value)" >
                                            </td>
                                            <td>{{number_format($item->discount*$item->num)}}</td>
                                        <tr>  
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-lg-7 card-body bg-light">
                                        <label for="">Tổng tiền: {{number_format($total)}} VNĐ</label>
                                        <h5 style="font-style: italic; color: #56ae6c; font-size: 10px;">*Lưu ý: Điều chỉnh số lượng sản phẩm về 0, thì sản phẩm sẽ tự động xóa khỏi giỏ hàng.</h5>
                                        <input type="number" value="{{$total}}" name="totalmoney" hidden>
                                    </div>
                                    <div class="col-lg-5 card-body bg-light" style="text-align:right;">
                                        <button class="btn btn-success btn-lg" value="" type="submit" >Tiến hành thanh toán</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
//CẬP NHẬT LẠI SỐ LƯỢNG HÀNG
function updateCart(id, num){
        //Kiểm tra trong cookie có lưu cái 'cart' chưa.
        cartList= getCookie('cart')
        if(cartList !=null && cartList !=''){
            cartList =JSON.parse(cartList) //nếu có thì tạo thành 1 mảng
        }   else{
            cartList = [] //chưa có thì khỏi tạo mới
        }
        isFind =false  
        for (var i = 0; i < cartList.length; i++) {
            //Nếu tìm tháy thì tăng số lượng sp đó lên, còn nếu k có thì thêm mới
            if(cartList[i].id ==id){
                if(num<=0){
                    cartList.splice(i,1)
                } else{
                    cartList[i].num =parseInt(num)
                }
                isFind=true
                break
            }
        }
        //Lưu vào giỏ hàng
        cartList =JSON.stringify(cartList)
        document.cookie = 'cart=' + cartList + getExpireTime();
        location.reload()
    }

    //SET THỜI GIAN SỐNG CHO COOKIE 
    function getExpireTime(){
        var now = new Date();
        var time = now.getTime();
        var expireTime = time + 1000*60*60*24;
        now.setTime(expireTime);
        return ';expires='+now.toUTCString()+';path=/';
    }
    //HÀM HỖ TRỢ LẤY COOKIE
    function getCookie(name) {
        function escape(s) { return s.replace(/([.*+?\^$(){}|\[\]\/\\])/g, '\\$1'); }
        var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
        return match ? match[1] : null;
    }
</script>
@endsection