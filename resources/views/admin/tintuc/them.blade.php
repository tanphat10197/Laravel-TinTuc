@extends('admin.layout.index');

@section('content');
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm
                            <small>Tin tức</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                            </div> 
                        @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" name="slloaitin">
                                    @foreach($loaitin as $lt)
                                        <option value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="tieude" placeholder="Nhập tiêu đề...." />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="tomtat" class="ckeditor"></textarea>
                            </div>
                             <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="noidung" class="ckeditor"></textarea>
                            </div>
                             <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="hinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="1" type="radio">Có
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Thêm</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection