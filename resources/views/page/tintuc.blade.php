@extends('layout.index')

@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $tintuc->TieuDe }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin-TanPhat</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="public/img/tintuc/{{ $tintuc->Hinh }}" alt="{{ $tintuc->TieuDe }}" width="50%">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $tintuc->created_at }}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                    {!! $tintuc->NoiDung !!}

                </p>

                 @if(Auth::check())
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                             {{ session('thongbao') }}
                        </div>
                    @endif
                    <div class="well">
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form action="comment/{{ $tintuc->id }}" method="post" role="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="noidung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                
                <hr>
                @endif

                <!-- Posted Comments -->

                <!-- Comment -->
                <h4><b>Danh sách commet</b></h4>
                @foreach($tintuc->comment as $cm)
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">{{ $cm->users->name}}
                                <small>{{ $cm->created_at }}</small> 
                            </h4>
                            {{ $cm->NoiDung }}
                        </div>
                    </div>
                @endforeach
                <!-- Comment -->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach($tinlienquan as $tlq)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{ $tlq->id }}/{{ $tlq->TieuDeKhongDau }}.html">
                                        <img class="img-responsive" src="public/img/tintuc/{{ $tlq->Hinh }}" alt="{{ $tlq->TieuDe }}">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{ $tlq->id }}/{{ $tlq->TieuDeKhongDau }}.html"><b>{{ $tlq->TieuDe }}</b></a>
                                </div>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        @foreach($tinnoibat as $tnb)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{ $tnb->id }}/{{ $tnb->TieuDeKhongDau }}.html">
                                        <img class="img-responsive" src="public/img/tintuc/{{ $tnb->Hinh }}" alt="{{ $tnb->TieuDe }}">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{ $tnb->id }}/{{ $tnb->TieuDeKhongDau }}.html"><b>{{ $tnb->TieuDe }}</b></a>
                                </div>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
<!-- end Page Content -->
@endsection