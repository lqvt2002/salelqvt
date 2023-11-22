@php
$title='Quản lý đơn hàng';
@endphp

@extends('layouts.admin')

@section('content')
    <table class="table mb-0 table-hover align-middle" style="background-color: aliceblue;border-radius: 20px;">
        <thead>
            <tr>
                <th class="border-top-0" style="width:10%;">STT</th>
                <th class="border-top-0" style="width:20%;">Tên người dùng</th>
                <th class="border-top-0" style="width:10%;">Email</th>
                <th class="border-top-0" style="width:10%;">Số điện thoại</th>
                <th class="border-top-0" style="width:20%;">Địa chỉ</th>
                <th class="border-top-0" style="width:20%;">Ghi chú</th>
                <th class="border-top-0" style="width:10%;">Ngày đặt hàng</th>
                <th class="border-top-0" style="width:10%;">Trạng thái</th>
                <th class="border-top-0" style="width:10%;">Tổng tiền</th>
                <th class="border-top-0" style="width:10%;"></th>           
            </tr>
        </thead>
        <tbody>
            
                @foreach($dataList as $item)
                    <tr>
                        <td style="    text-align: center;">
                            {{++$index}} 
                            <br>
                            <a href="{{route('order_detail')}}?id={{$item->id}}"><button class="btn btn-link"  >Chi tiết</button></a>
                            </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phonenumber}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->note}}</td>
                        <td>{{getTimeFormat($item->order_date)}}</td>
                        <td>
                            @if ($item->status ==0)
                                <label for="" style="color:green">Đang duyệt</label>
                            @elseif ($item->status ==1)
                                <label for="" style="color:blue">Đã duyệt</label>
                            @else
                                <label for="" style="color:red">Đã hủy</label>
                            @endif
                        </td>
                        <td>{{number_format($item->totalmoney)}}</td>
                        <td>
                            @if ($item->status ==0)
                            <button class="btn btn-success" onclick="updateItem({{$item->id}},1)" >Duyệt</button>
                            <button class="btn btn-danger" onclick="updateItem({{$item->id}},2)" >Hủy</button>
                            @endif
                        </td>
                    <tr>  
                @endforeach
            
        </tbody>
    </table>

{!! $dataList->links() !!} 

@endsection
@section('js')
<script type="text/javascript">
    function updateItem(id, status){
        $.post('{{route('order_update')}}', {
                    '_token':'{{ csrf_token() }}', 
                    'id': id,
                    'status':status
                },function(data){
                    location.reload()
                })
    }
</script>
@stop