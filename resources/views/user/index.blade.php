@php
$title='Quản lý người dùng';
@endphp

@extends('layouts.admin')

@section('content')
    <a href="{{route('user_viewAdd')}}"><button class="btn btn-success" style="margin-bottom:20px" >Thêm người dùng.</button></a>

    <table class="table mb-0 table-hover align-middle" style="background-color: aliceblue;border-radius: 20px;">
        <thead>
            <tr>
                <th class="border-top-0" style="width:10%;">STT</th>
                <th class="border-top-0" style="width:30%;">Tên</th>
                <th class="border-top-0" style="width:10%;">Email</th>
                <th class="border-top-0" style="width:10%;">Số điện thoại</th>
                <th class="border-top-0" style="width:10%;">Địa chỉ</th>
                <th class="border-top-0" style="width:10%;">Tên role</th>
                <th class="border-top-0" style="width:10%;">Ngày cập nhật</th>
                <th class="border-top-0" style="width:10%;"></th>   
            </tr>
        </thead>
        <tbody>
            
                @foreach($dataList as $item)
                    <tr>
                        <td>{{++$index}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phonenumber}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->role_name}}</td>
                        <td>{{getTimeFormat($item->updated_at)}}</td>
                        <td>
                            <a href="{{route('user_viewAdd')}}?id={{$item->id}}"><button class="btn btn-warning" >Sửa</button></a>
                            <button class="btn btn-danger" onclick="deleteItem({{$item->id}})" style="margin-top:10px">Xóa</button>
                        </td>
                    <tr>  
                @endforeach
            
        </tbody>
    </table>

{!! $dataList->links() !!} 

@endsection
@section('js')
<script type="text/javascript">
    function deleteItem(id){
        $.post('{{route('user_delete')}}', {
                    '_token':'{{ csrf_token() }}', 
                    'id':id
                },function(data){
                    location.reload()
                })
    }
</script>
@stop