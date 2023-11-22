@php
$title='Giới thiệu';
@endphp

@extends('layouts.frontend')

@section('content')

<section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>Về chúng tôi</h1>
                    <p>
                    Chúng tôi là một nhóm những người nhiệt tình về nghệ thuật và thủ công. 
                    Chúng tôi đặt ra mục tiêu tạo ra các sản phẩm handmade chất lượng cao với sự tỉ mỉ và tinh tế. 
                    Sản phẩm của chúng tôi là sự kết hợp giữa sự sáng tạo và kỹ thuật thủ công tinh tế.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="assets/img/about-hero.svg" alt="About Hero">
                </div>
            </div>
        </div>
    </section>
    <!-- Close Banner -->

    <!-- Start Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Tại sao chọn chúng tôi</h1>
                <p>
                    Tôi cần bạn.
                    Bạn cần tôi.
                    Chúng mình có nhau.
                </p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-4 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-star"></i></i></div>
                    <h2 class="h5 mt-4 text-center">Chất lượng</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-camera-retro fa-lg"></i></div>
                    <h2 class="h5 mt-4 text-center">Nghệ thuật</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-key fa-fw"></i></div>
                    <h2 class="h5 mt-4 text-center">Giá trị</h2>
                </div>
            </div>

        </div>
    </section>
    <!-- End Section -->

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Vị trí</h1>
                    <p>
                        Hãy đến thăm cửa hàng của chúng tôi nhé.
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3850.3523835717947!2d108.72438807472274!3d15.193870162277475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTXCsDExJzM3LjkiTiAxMDjCsDQzJzM3LjEiRQ!5e0!3m2!1svi!2s!4v1687972578396!5m2!1svi!2s" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->
@endsection