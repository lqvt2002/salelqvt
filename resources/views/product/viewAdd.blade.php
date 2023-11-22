@php
$title='Thêm/sửa sản phẩm';
@endphp

@extends('layouts.admin')

@section('css')
        <style>
            #container {
                width: 1000px;
                margin: 20px auto;
            }
            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }
            .ck-content .image {
                /* block images */
                max-width: 80%;
                margin: 20px auto;
            }
        </style>
@stop
@section('content')
    <form action="{{route('product_add')}}" method="post" id="myForm">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" class="form-control"  name="id" value="{{($product!=null)?$product->id:''}}"  style="display: none;">
                </div>
                <div class="form-group" >
                    <label for="">Tên SP:</label>
                    <input type="text" class="form-control" placeholder="Nhập tên SP" name="title" value="{{($product!=null)?$product->title:''}}" required  >
                </div>
                <div class="form-group" >
                    <textarea name="decription">                        
                        {{($product!=null)?$product->decription:''}}  
                    </textarea>
                </div>
                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Hình ảnh:</label>
                    <!-- Thẻ input để nhập vào 1 file. Nhưng giao diện của thẻ Input không xinh nên
                    dùng thẻ Button để hiển thị nút chọn. -->
                    <button type="button" class="btn btn-primary " onclick="$('#upload_file').click()">Tải ảnh lên</button>
                    <input type="file" id="upload_file" hidden>
                    <input type="text" class="form-control" name="thumbnail" id="thumbnail" value="{{($product!=null)?$product->thumbnail:''}}" required style="margin:10px 0 10px 0"> 
                    <img src="{{($product!=null)?$product->thumbnail:''}}" alt="" style="max-height:200px"  id="thumbnail_img">
                </div>
                <div class="form-group">
                    <label for="">category (danh mục sản phẩm):</label>
                    <select name="category_id" id="" class="form-control" required>
                        <option value=""> -- Chọn -- </option>
                        @foreach($categoryList as $categoryItem)
                            @if ($product!=null && $product->category_id == $categoryItem->id)
                                <option selected value="{{$categoryItem->id}}"> {{$categoryItem->name}} </option>
                            @else
                                <option value="{{$categoryItem->id}}"> {{$categoryItem->name}} </option>
                            @endif
                        
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Giá tiền:</label>
                    <input type="number" class="form-control" placeholder="Nhập giá tiền sản phẩm" name="price" value="{{($product!=null)?$product->price:''}}" required>
                </div>
                <div class="form-group">
                    <label for="">Giảm giá:</label>
                    <input type="number" class="form-control" placeholder="Nhập tiền đã giảm" name="discount" value="{{($product!=null)?$product->discount:''}}"required>
                </div>
            </div>
        </div>
        <div class="form-group" style="margin-top:20px;">
            <a href="{{route('product_index')}}">Quay lại.</a>
            <button type="submit" class="btn btn-primary" style='background-color: #1a9bfc;margin-right: 0px '>Lưu</button>
        </div>
    </form>
@endsection

@section('js')
<script type="text/javascript">
    $(function(){
        CKEDITOR.replace( 'decription' );    

        //HIển thị hỉnh ảnh sau khi được chọn.
        $('[name=thumbnail]').change(function() {
            $('#thumbnail_img').attr('src',$(this).val())
        })

        //Sự kiện click chọn ảnh,
        $('#upload_file').change(function(e) {
            uploadFile(e,'thumbnail') //Up nội dung này lên server  và gán cái url ảnh cho thumbnail. hàm uploadFile nằm trong thư mục Public/JS/UploadFile.js
        })
        })
</script>

@stop
