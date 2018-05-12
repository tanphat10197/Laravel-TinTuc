@extends('layout.index')

@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('page.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{ $loaitin->Ten }}</b></h4>
                    </div>
                    @foreach($tintuc as $tt)
                        <div class="row-item row">
                            <div class="col-md-3">

                                <a href="detail.html">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="public/img/tintuc/{{ $tt->Hinh }}" alt="{{ $tt->TieuDe }}">
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3>{{ $tt->TieuDe }}</h3>
                                <p>{{ $tt->TomTat }}</p>
                                <a class="btn btn-primary" href="detail.html">Chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    @endforeach

                </div>
            </div> 

        </div>

        <div style="text-align: center;">
             {!! $tintuc->links() !!}
        </div>

    </div>
    <!-- end Page Content -->
@endsection