@php
$title='Quản lý danh mục sản phẩm';
@endphp

@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-6">
        <form action="{{route('category_add')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control"  name="id" value="{{$id}}"  style="display: none;">
                <label for="name">Tên category:</label>
                <input type="text" class="form-control" placeholder="Nhập tên category" name="name" value="{{$name}}">
            </div>

            <button type="submit" class="btn btn-primary" style='background-color: #1a9bfc;margin-top: 20px '>Lưu</button>
        </form>
    </div>
    <div class="col-md-6">
        <table class="table mb-0 table-hover align-middle text-nowrap" style="background-color: aliceblue;border-radius: 20px;">
            <thead>
                <tr>
                    <th class="border-top-0">STT</th>
                    <th class="border-top-0">Tên danh mục</th>
                    <th class="border-top-0" style="width:100px"></th>
                    
                </tr>
            </thead>
            <tbody>
                
                    @foreach($dataList as $item)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <a href="{{route('category_index')}}?id={{$item->id}}"><button class="btn btn-warning" >Sửa</button></a>
                                <button class="btn btn-danger" onclick="deleteItem({{$item->id}})" >Xóa</button>
                            </td>
                        <tr>  
                    @endforeach
                
            </tbody>
        </table>
    </div>
                                    
</div>
@endsection
@section('js')
<script type="text/javascript">
    function deleteItem(id){
        $.post('{{route('category_delete')}}', {
                    '_token':'{{ csrf_token() }}', 
                    'id':id
                },function(data){
                    location.reload()
                })
    }
</script>
@stop