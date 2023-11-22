@php
$title='LQVTSale';
@endphp

@extends('layouts.frontend')

@section('content')
<!-- Open Content -->
<section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{($product!=null)?$product->thumbnail:''}}" alt="Card image cap" id="product-detail">
                    </div>
                </div>  
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{($product!=null)?$product->title:''}}</h1>
                            <p class="h3 py-2" style="color: #56ae6c;">{{($product!=null)?number_format($product->discount):''}} VNĐ</p>
                            <p style="text-decoration: line-through;">{{($product!=null)?number_format($product->price):''}} VNĐ</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Thương hiệu:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>LQVTSale</strong></p>
                                </li>
                            </ul>

                            <h4>Mô tả sản phẩm:</h4>
                            <p>{!! ($product!=null)?$product->decription:'' !!}</p>
                            
                                  <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Số lượng :
                                                <input type="hidden" name="num" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button class="btn btn-success btn-lg" value="addtocart" onclick="addCart({{$product->id}}, document.querySelector('[name=num]').value)">Thêm vào giỏ hàng</button>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Sản phẩm tương tự</h4>
            </div>
            <div class="row">
                @foreach ($productList as $item)
                <div class="col-12 col-md-3 mb-3">
                    <div class="product-wap card rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="{{$item->thumbnail}}">
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-success text-white mt-2" href="{{ route('frontend_showDetail', ['id' => $item->id, 'url' => $item->productUrl ]) }}"><i class="far fa-eye"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="{{ route('frontend_showDetail', ['id' => $item->id, 'url' => $item->productUrl ]) }}"><i class="fas fa-cart-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                     {{$item->category_name}}
                                </li>
                                <li class="text-muted text-right"><p style="text-decoration: line-through;">{{number_format($item->price)}} VNĐ</p></li>
                            </ul>
                            <a href="{{ route('frontend_showDetail', ['id' => $item->id, 'url' => $item->productUrl]) }}" class="h3 text-decoration-none text-dark"  style="display: -webkit-box;    -webkit-box-orient: vertical;-webkit-line-clamp: 2; overflow: hidden;">
                                    {{$item->title}}                           
                            </a>
                            <p class="" style="color: #56ae6c; margin-top:16px">{{number_format($item->discount)}} VNĐ</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Article -->
@endsection
@section('js')
<script type="text/javascript">

    function addCart(id, num){
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
                cartList[i].num = parseInt(cartList[i].num) +parseInt(num)
                isFind=true
                break
            }
        }
        if(!isFind){
            cartList.push({
                'id':id,
                'num':num
            })
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