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
                            <small>Slide</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Hình</th>
                                <th>Nội dung</th>
                                <th>Link</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $sl)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $sl->id }}</td>
                                    <td>{{ $sl->Ten }}</td>
                                    <td><img src="public/img/slide/{{ $sl->Hinh }}" width="300px"></td>
                                    <td>{{ $sl->NoiDung }}</td>
                                    <td>{{ $sl->link }}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{ $sl->id }}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{ $sl->id }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-10" align="center">
                            {!! $slide->links() !!}
                        </div>
                    </div>
                </div>
                    
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection