@extends('admin.layout.index');

@section('content');

 <div id="page-wrapper">
            <div class="container-fluid">
                 @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                            </div> 
                        @endif
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách
                            <small>Tin Tức</small>
                        </h1>
                    </div>

                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Tóm tắt </th>
                                <th>Hình</th>
                                <th>Lượt xem</th>
                                <th>Loại tin</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $tt->id }}</td>
                                    <td>{{ $tt->TieuDe }}</td>
                                    <td>{{ $tt->TomTat }}</td>
                                    <td><img src="public/img/tintuc/{{ $tt->Hinh }}" width="50px"></td>
                                    <td>{{ $tt->SoLuotXem }}</td>
                                    <td>{{ $tt->LoaiTin->Ten }}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{ $tt->id }}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{ $tt->id }}">Edit</a></td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-10" align="center">
                            {!! $tintuc->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection