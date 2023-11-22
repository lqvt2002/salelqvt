@php
$title='Trang chủ';
@endphp

@extends('layouts.frontend')

@section('content')
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last" style="text-align:center;">
                            <img class="img-fluid" src="{{ asset('themes/front-end/img/banner_img_1.png')}}" alt="" style="max-height:400px"> 
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>LQVT</b>sale</h1>
                                <h3 class="h2">Cửa hàng thủ công bằng len!</h3>
                                <p>
                                    Chúng tôi tự hào giới thiệu một kho báu thủ công với hàng trăm sản phẩm độc đáo mà chúng tôi đã tạo ra bằng tâm huyết. Duyệt qua danh mục của chúng tôi để tìm kiếm những món đồ thủ công thú vị cho gia đình và bạn bè của bạn.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last" style="text-align:center;">
                            <img class="img-fluid" src="{{ asset('themes/front-end/img/banner_img_2.png')}}" alt="" style="max-height:400px">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Sản phẩm thủ công</h1>
                                <h3 class="h2">Sự kết hợp giữa tạo nghệ thuật và yêu thương</h3>
                                <p>
                                Mọi sản phẩm đều được <strong>làm hoàn toàn bằng tay</strong>, từ việc chọn nguyên liệu đến việc tạo ra sản phẩm hoàn thiện. Điều này đảm bảo rằng mỗi sản phẩm chứa sự chăm sóc và tình yêu của người thợ thủ công.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last" style="text-align:center;">
                            <img class="img-fluid" src="{{ asset('themes/front-end/img/banner_img_3.png')}}" alt="" style="max-height:400px">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Sáng tạo và sự khéo léo</h1>
                                <h3 class="h2">Là ngôi nhà của nghệ thuật thủ công. </h3>
                                <p>
                                Chúng tôi tin rằng nghệ thuật và thủ công là nguồn cảm hứng vô tận. Cửa hàng của chúng tôi tổng hợp những <strong>sản phẩm thủ công sáng tạo nhất</strong>, và chúng tôi hy vọng rằng bạn sẽ tìm thấy niềm vui và sự sáng tạo khi khám phá nó.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Danh mục sản phẩm</h1>
                <p>
                Dựa trên mục đích sử dụng và tính chất của sản phẩm móc len
                chúng tôi gửi đến bạn các loại sản phẩm từ len.
                </p>
            </div>
        </div>
        <div class="row">
            @foreach ($categoryList as $item)
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="{{route('frontend_showProduct')}}?categoryUrl={{$item->categoryUrl}}"><img src="{{ $item->thumbnail}}" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">{{$item->name}}</h5>
                <p class="text-center"><a class="btn btn-success">Mua sắm</a></p>
            </div>
            @endforeach
        </div>
        
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Sản phẩm nổi bậc</h1>
                    <p>
                    Sức mạnh của móc len không chỉ nằm ở sản phẩm hoàn thiện
                     mà còn ở quá trình làm việc thú vị.
                    </p>
                </div>
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
    <!-- End Featured Product -->
@endsection