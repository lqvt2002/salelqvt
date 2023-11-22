@php
$title='Quản lý phản hồi';
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
                <th class="border-top-0" style="width:20%;">Tiêu đề</th>
                <th class="border-top-0" style="width:30%;">Nội dung</th>
                <th class="border-top-0" style="width:10%;">Ngày cập nhật</th>
                <th class="border-top-0" style="width:10%;">Trạng thái</th>
                <th class="border-top-0" style="width:10%;"></th>           
            </tr>
        </thead>
        <tbody>
            
                @foreach($dataList as $item)
                    <tr>
                        <td>{{++$index}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phonenumber}}</td>
                        <td>{{$item->subject_name}}</td>
                        <td>{{$item->note}}</td>
                        <td>{{getTimeFormat($item->updated_at)}}</td>
                        <td>
                            @if ($item->status ==0)
                                <label for="" style="color:green">Chưa đọc</label>
                            @else
                                <label for="" style="color:red">Đã đọc</label>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="updateItem({{$item->id}})" >Đã đọc</button>
                        </td>
                    <tr>  
                @endforeach
            
        </tbody>
    </table>

{!! $dataList->links() !!} 

@endsection
@section('js')
<script type="text/javascript">
    function updateItem(id){
        $.post('{{route('feedback_update')}}', {
                    '_token':'{{ csrf_token() }}', 
                    'id':id
                },function(data){
                    location.reload()
                })
    }
</script>
@stop