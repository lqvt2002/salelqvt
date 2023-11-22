@php
$title='Liên hệ';
@endphp

@extends('layouts.frontend')

@section('content')
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Liên hệ với chúng tôi</h1>
            <p>
            Hãy liên hệ để chúng tôi có thể tư vấn trực tiếp cho bạn về sản phẩm và dịch vụ bạn quan tâm. 
            Chúng tôi luôn sẵn lòng lắng nghe và hỗ trợ bạn.
            </p>
        </div>
    </div>

    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">
            <form class="col-md-9 m-auto" method="post" role="form" action="{{route('frontend_postContact')}}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Họ và tên</label>
                        <input type="text" class="form-control mt-1" id="fullname" name="fullname" placeholder="Họ và tên" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputemail">Email</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputemail">Số điện thoại</label>
                        <input type="number" class="form-control mt-1" id="phonenumber" name="phonenumber" placeholder="Số điện thoại" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputsubject">Tiêu đề</label>
                    <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Tiêu đề" required>
                </div>
                <div class="mb-3">
                    <label for="inputmessage">Nội dung</label>
                    <textarea class="form-control mt-1" id="note" name="note" placeholder="Nội dung" rows="8"></textarea required>
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success btn-lg px-3">Gửi phản hồi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
    <!-- End Contact -->
    @endsection