@php
$title='Chi tiết đơn hàng';
@endphp

@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-4" style="background-color: aliceblue;border-radius: 20px;">
            <div style="margin:20px">
                <strong>Tên khách hàng: </strong> {{$orderItem->name}}.
            </div>
            <div style="margin:20px"> 
                <strong>Email:</strong> {{$orderItem->email}}.
            </div>
            <div style="margin:20px">
                <strong>Số điện thoại:</strong> {{$orderItem->phonenumber}}.
            </div>
            <div style="margin:20px">
                <strong>Địa chỉ:</strong> {{$orderItem->address}}.
            </div>
            <div style="margin:20px">
                <strong>Ghi chú:</strong> {{$orderItem->note}}.
            </div>
            <div style="margin:20px">
                <strong>Trạng thái:</strong>
                @if ($orderItem->status ==0)
                    <label for="" style="color:green">Đang duyệt</label>
                @elseif ($orderItem->status ==1)
                    <label for="" style="color:blue">Đã duyệt</label>
                @else
                    <label for="" style="color:red">Đã hủy</label>
                @endif            
            </div>
            <div style="margin:20px">
                <strong>Tổng tiền:</strong> {{number_format($orderItem->totalmoney)}} đ.
            </div>
            <div style="margin:20px">
            <a href="{{route('order_index')}}">Quay lại.</a>
            </div>
        </div>
        <div class="col-8" > 
            <table class="table mb-0 table-hover align-middle" style="background-color: aliceblue;border-radius: 20px;">
            <thead>
                <tr>
                    <th class="border-top-0" style="width:10%;">STT</th>
                    <th class="border-top-0" style="width:40%;">Tên sản phẩm</th>
                    <th class="border-top-0" style="width:10%;">Hình ảnh</th>
                    <th class="border-top-0" style="width:10%;">Giá</th>
                    <th class="border-top-0" style="width:10%;">Số lượng</th>
                    <th class="border-top-0" style="width:20%;">Tổng tiền</th>
                        </tr>
            </thead>
            <tbody>
                
                    @foreach($itemList as $item)
                        <tr>
                            <td style="    text-align: center;">
                                {{++$index}} 
                                </td>
                            <td>{{$item->title}}</td>
                            <td><img src="{{$item->thumbnail}}" style="width:100px" alt=""></td>
                            <td>{{number_format($item->price)}}</td>
                            <td>{{number_format($item->number)}}</td>
                            <td>{{number_format($item->price* $item->number)}}</td>
                        <tr>  
                    @endforeach
                
            </tbody>
            </table>
        </div>
    </div>

@endsection
