<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\Comment;
class TinTucController extends Controller
{
    //
    public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')->paginate(10);//
    	//$tintuc = TinTuc::orderBy('id','DESC')->get();
    	return view('admin.tintuc.danhsach', ['tintuc'=>$tintuc]);
    }

    public function getThem(){
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['loaitin'=>$loaitin]);
    }

    public function postThem(Request $req){
    	$this->validate($req,
    		[
    			'tieude'=>'required|min:3|max:100|unique:TinTuc,TieuDe',
    			'tomtat'=>'required',
    			'noidung'=>'required', 

    		],
    		[
    			'tieude.required'=>'Bạn chưa nhập tiêu đề',
    			'tieude.min'=>'Tiêu đề phải có độ dài từ 3 đến 100',
    			'tieude.max'=>'Tiêu đề phải có độ dài từ 3 đến 100',
    			'tieude.unique' => 'Tiêu đề đã tồn tại',
    			'tomtat.required'=>'Bạn chưa nhập tóm tắt',
    			'noidung.required'=>'Bạn chưa nhập nội dung',
    		]);

    	$tintuc = new TinTuc;
    	$tintuc->TieuDe = $req->tieude;
    	$tintuc->TieuDeKhongDau = str_slug($req->tieude);
    	$tintuc->TomTat = $req->tomtat;
    	$tintuc->NoiDung = $req->noidung;
    	$tintuc->SoLuotXem = 0;
    	$tintuc->NoiBat = $req->noibat;
    	$tintuc->idLoaiTin = $req->slloaitin;
    	
        if($req->hasFile('hinh')){
            $file = $req->file('hinh');

    		$name = $file->getClientOriginalName();
    		$duoi = $file->getClientOriginalExtension();

    		//echo $duoi;

    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect('admin/tintuc/them')->with('thongbao','Chỉ được upload hình có đuôi jpg, png, jpeg');
    		}

    		$Hinh = str_random(4).'_'.$name; //chổ này để random ra các ký tự phía trước để hình k trùng tên với nhau
    		while(file_exists("public/img/tintuc/".$Hinh)){
    			$Hinh = str_random(4).'_'.$name; //cho chạy vòng lặp kiểm tra coi có trùng k
    		}
    		//echo $duoi;
			$file->move("public/img/tintuc",$Hinh);
    		$tintuc->Hinh = $Hinh;
        }else{
                $tintuc->Hinh="";
            }

    	$tintuc->save();

    	return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
    	$tintuc = TinTuc::find($id);
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.sua', ['tintuc'=>$tintuc, 'loaitin'=>$loaitin]);
    }

    public function postSua(Request $req,$id){
    	$tintuc = TinTuc::find($id);
    		$this->validate($req,
    		[
    			'tieude'=>'required|min:3|max:100',
    			'tomtat'=>'required',
    			'noidung'=>'required', 

    		],
    		[
    			'tieude.required'=>'Bạn chưa nhập tiêu đề',
    			'tieude.min'=>'Tiêu đề phải có độ dài từ 3 đến 100',
    			'tieude.max'=>'Tiêu đề phải có độ dài từ 3 đến 100',
    			'tomtat.required'=>'Bạn chưa nhập tóm tắt',
    			'noidung.required'=>'Bạn chưa nhập nội dung',
    		]);

    	//$tintuc = new TinTuc;
    	$tintuc->TieuDe = $req->tieude;
    	$tintuc->TieuDeKhongDau = str_slug($req->tieude);
    	$tintuc->TomTat = $req->tomtat;
    	$tintuc->NoiDung = $req->noidung;
    	$tintuc->NoiBat = $req->noibat;
    	$tintuc->idLoaiTin = $req->slloaitin;
    
    		$file = $req->file('hinh');

    		$name = $file->getClientOriginalName();
    		$duoi = $file->getClientOriginalExtension();

    		//echo $duoi;

    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Chỉ được upload hình có đuôi jpg, png, jpeg');
    		}

    		$Hinh = str_random(4).'_'.$name; //chổ này để random ra các ký tự phía trước để hình k trùng tên với nhau
    		while(file_exists("img/tintuc/".$Hinh)){
    			$Hinh = str_random(4).'_'.$name; //cho chạy vòng lặp kiểm tra coi có trùng k
    		}
    		//echo $duoi;
			$file->move("public/img/tintuc",$Hinh);
			unlink("public/img/tintuc/".$tintuc->Hinh); //xóa hình cũ
    		$tintuc->Hinh = $Hinh;


    	$tintuc->save();

    	return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$tintuc = TinTuc::find($id);

    	$tintuc->delete();

    	return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa Thành Công');
    }
}
