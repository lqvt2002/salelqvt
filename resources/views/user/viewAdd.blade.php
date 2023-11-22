@php
$title='Thêm/sửa thông tin người dùng';
@endphp

@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-7">
    <form action="{{route('user_add')}}" method="post" id="myForm">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control"  name="id" value="{{($user!=null)?$user->id:''}}"  style="display: none;">
        </div>
        <div class="form-group">
            <label for="">Họ tên:</label>
            <input type="text" class="form-control" placeholder="Nhập họ tên" name="name" value="{{($user!=null)?$user->name:''}}" require>
        </div>
        <div class="form-group">
            <label for="">Email:</label>
            <input type="email" class="form-control" placeholder="Nhập email, yêu cầu email chưa đăng ký tài khoản." name="email" value="{{($user!=null)?$user->email:''}}" require>
        </div>
        <div class="form-group">
            <label for="">Số điện thoại:</label>
            <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="phonenumber" value="{{($user!=null)?$user->phonenumber:''}}">
        </div>
        <div class="form-group">
            <label for="">Địa chỉ:</label>
            <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address" value="{{($user!=null)?$user->address:''}}">
        </div>
        <div class="form-group">
            <label for="">Nhập mật khẩu:</label>
            <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password" value="" min="6">
        </div>
        <div class="form-group">
            <label for="">Nhập lại mật khẩu:</label>
            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="conf_password" value="" min="6">
        </div>
        <div class="form-group">
            <label for="">Role (quyền truy cập):</label>
            <select name="role_id" id="" class="form-control">
                <option value=""> -- Chọn -- </option>
                @foreach($roleList as $roleItem)
                    @if ($user!=null && $user->role_id == $roleItem->id)
                        <option selected value="{{$roleItem->id}}"> {{$roleItem->name}} </option>
                    @else
                        <option value="{{$roleItem->id}}"> {{$roleItem->name}} </option>
                    @endif
                
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <a href="{{route('user_index')}}">Quay lại.</a>
            <button type="submit" class="btn btn-primary" style='background-color: #1a9bfc;margin-right: 0px '>Lưu</button>
        </div>
    </form>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(function(){
        $('#myForm').submit(function(){
            if ($('[name=password]').val() != $('[name=conf_password]').val()){
                alert('Mật khẩu không trùng khớp.')
                return false
            }
            return true
        })
    })
</script>
@stop