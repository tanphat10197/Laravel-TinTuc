<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\LoaiTin;
use DB;
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

    public function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinlienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->where('id', '<>' ,$tintuc->id)->take(4)->get();
        $tinnoibat = TinTuc::where('NoiBat',1)->where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
        DB::table('tintuc')->where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]);

        return view('page.tintuc', ['tintuc'=>$tintuc, 'tinlienquan'=>$tinlienquan,'tinnoibat'=>$tinnoibat]);
    }
}
