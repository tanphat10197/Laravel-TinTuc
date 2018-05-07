@extends('admin.layout.index');

@section('content');

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa
                            <small>{{ $tintuc->TieuDe }}</small>
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
                        <form action="admin/tintuc/sua/{{ $tintuc->id }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" name="slloaitin">
                                    @foreach($loaitin as $lt)
                                        <option 
                                            @if($lt->id == $tintuc->idLoaiTin)
                                                {{ "selected" }}
                                            @endif
                                             value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="tieude" placeholder="Nhập tiêu đề...." value="{{ $tintuc->TieuDe }}" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="tomtat" class="ckeditor">{{ $tintuc->TomTat }}</textarea>
                            </div>
                             <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="noidung" class="ckeditor">{{ $tintuc->NoiDung }}</textarea>
                            </div>
                             <div class="form-group">
                                <label>Hình ảnh</label><br/>
                                <img src="public/img/tintuc/{{ $tintuc->Hinh }}" width="100px">
                                <input type="file" name="hinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0" @if($tintuc->NoiBat == 0) {{ "checked"}} @endif type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="1" type="radio" @if($tintuc->NoiBat == 1) {{ "checked"}} @endif>Có
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Sửa</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách
                            <small>Commnet của tin {{ $tintuc->TieuDe }}</small>
                        </h1>
                    </div>

                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Ngày tạo</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $cm->id }}</td>
                                    <td>{{ $cm->user->name }}</td>
                                    <td>{{ $cm->NoiDung }}</td>
                                    <td>{{ $cm->created_at }}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{ $cm->id }}/{{ $tintuc->id }}"> Delete</a></td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

        
@endsection