@extends('admin.layout.index');

@section('content');
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm
                            <small>Loại Tin</small>
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
                        <form action="admin/loaitin/them" method="POST">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="slloaitin">
                                    @foreach($theloai as $tl)
                                        <option value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Tin</label>
                                <input class="form-control" name="tenloaitin" placeholder="Nhập tên loại tin....." />
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            {{ csrf_field() }}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection