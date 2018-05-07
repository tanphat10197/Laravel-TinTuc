@extends('admin.layout.index');

@section('content');
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm
                            <small>User</small>
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
                        <form action="admin/user/them" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="ten" placeholder="Nhập tên....." />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" placeholder="Nhập email......" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="pass" type="password" placeholder="Nhập password...." />
                            </div>
                             <div class="form-group">
                                <label>Nhập lại Password</label>
                                <input class="form-control" name="repass" type="password" placeholder="Nhập lại password...." />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="rdoquyen" value="0" checked="" type="radio">Đọc giả
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoquyen" value="1" type="radio">Admin
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