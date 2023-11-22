@php
$title='Quản lý sản phẩm';
@endphp

@extends('layouts.admin')

@section('content')
    <a href="{{route('product_viewAdd')}}"><button class="btn btn-success" style="margin-bottom:20px">Thêm sản phẩm.</button></a>

    <table class="table mb-0 table-hover align-middle" style="background-color: aliceblue;border-radius: 20px;">
        <thead>
            <tr style="">
                <th class="border-top-0" style="width:5%;">STT</th>
                <th class="border-top-0" style="width:30%;">Tên SP</th>
                <th class="border-top-0" style="width:10%;">Danh mục</th>
                <th class="border-top-0" style="width:10%;">Giá tiền</th>
                <th class="border-top-0" style="width:10%;">Giảm giá</th>
                <th class="border-top-0" style="width:10%;">Hình ảnh</th>
                <th class="border-top-0" style="width:10%;">Ngày cập nhật</th>
                <th class="border-top-0" style="width:10%;"></th>           
            </tr>
        </thead>
        <tbody>
            
                @foreach($dataList as $item)
                    <tr>
                        <td>{{++$index}}</td>
                        <td> {{$item->title}}</td>
                        <td>{{$item->category_name}}</td>
                        <td>{{number_format($item->price,0)}}</td>
                        <td>{{number_format($item->discount,0)}}</td>
                        <td><img src="{{$item->thumbnail}}" style="width:100px" alt=""></td>
                        <td>{{getTimeFormat($item->updated_at)}}</td>
                        <td>
                            <a href="{{route('product_viewAdd')}}?id={{$item->id}}"><button class="btn btn-warning" >Sửa</button></a>
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
        $.post('{{route('product_delete')}}', {
                    '_token':'{{ csrf_token() }}', 
                    'id':id
                },function(data){
                    location.reload()
                })
    }
</script>
@stop