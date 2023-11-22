@php
$title='Sản phẩm';
@endphp

@extends('layouts.frontend')

@section('content')
 <!-- Start Content -->
 <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <h1 class="h2 pb-4">Danh mục sản phẩm</h1>
                <ul class="list-unstyled templatemo-accordion">
                @foreach ($categoryList as $item)
                    <div style="margin-bottom:25px;">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="{{route('frontend_showProduct')}}?categoryUrl={{$item->categoryUrl}}">
                           {{$item->name}}
                            <i class="fa fa-fw fa-chevron-circle-down mt-1" style="margin-right: 30px;"></i>
                        </a>
                    </div>
                @endforeach
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-inline shop-top-menu pb-3 pt-1">
                    
                        </ul>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="d-flex">
                            <select class="form-control">
                                <option>Nổi bật</option>
                                <option>A đến Z</option>
                                <option>Danh mục</option>
                            </select>
                        </div>
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
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                    {!! $productList->links() !!} 
                    <!-- //Phân trang -->
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->

@endsection