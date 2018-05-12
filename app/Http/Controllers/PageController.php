<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\LoaiTin;
class PageController extends Controller
{
    //
    public function __construct(){
    	$theloai = TheLoai::all();
        $slide = Slide::all();
    	view()->share('theloai',$theloai);
        view()->share('slide',$slide);
    }
    public function trangchu(){    	
    	return view('page.trangchu');
    }
    public function lienhe(){    	
    	return view('page.lienhe');
    }

    public function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('page.loaitin',['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }
}
