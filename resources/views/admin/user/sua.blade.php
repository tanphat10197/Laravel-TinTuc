@extends('admin.layout.index');

@section('content');

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Edit</small>
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
                        <form action="admin/user/sua/{{ $user->id}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="ten" placeholder="Nhập tên....." value="{{ $user->name }}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" 
                                placeholder="Nhập email......" value=" {{ $user->email }}" readonly=""/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changePassword">
                                <label>Đổi mật khẩu</label>
                                <input class="form-control password" name="pass" type="password" placeholder="Nhập password...." disabled=""/>
                            </div>
                             <div class="form-group">
                                <label>Nhập lại Password</label>
                                <input class="form-control pass" name="repass" type="password" placeholder="Nhập lại password...." disabled=""/>
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="rdoquyen" value="0" @if($user->quyen == 0) {{ "checked" }} @endif type="radio">Đọc giả
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoquyen" value="1" @if($user->quyen == 1) {{ "checked" }} @endif type="radio">Admin
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

@section('script');
    <script>
        $(document).ready(function(){
             $("#changePassword").change(function(){
                 if($(this).is(":checked"))
                 {
                    $(".pass").removeAttr('disabled');
                 }
                 else
                 {
                    $(".pass").attr('disabled','');
                 }
             });
        });
    </script>
@endsection