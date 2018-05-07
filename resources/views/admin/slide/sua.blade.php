@extends('admin.layout.index');

@section('content');

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa slide
                            <small>{{ $slide->Ten }}</small>
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
                        <form action="admin/slide/sua/{{$slide->id }}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên slide</label>
                                <input class="form-control" name="ten" placeholder="Nhập tên slide...." value="{{ $slide->Ten }}" />
                            </div>                            
                             <div class="form-group">
                                <label>Hình ảnh</label>
                                <img src="public/img/slide/{{ $slide->Hinh }}" width="200px">
                                <input type="file" name="hinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="noidung" class="ckeditor">{{ $slide->NoiDung }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" placeholder="Nhập tên slide...." value="{{ $slide->link }}" />
                            </div> 
                            <button type="submit" class="btn btn-default">Sửa</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection