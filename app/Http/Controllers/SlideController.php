<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
    	$slide = Slide::paginate(5);
    	return view('admin.slide.danhsach', ['slide'=>$slide]);
    }

    public function getThem(){
    	return view('admin.slide.them');
    }

    public function postThem(Request $req){
    	$this->validate($req,
    		[
    			'ten'=>'required|min:3|max:100|unique:Slide,Ten',
    			'noidung'=>'required',
    		],
    		[
    			'ten.required'=>'Bạn chưa nhập tên slide,',
    			'ten.min'=>'Tên slide phải có độ dài từ 3 đến 100,',
    			'ten.max'=>'Tên slide phải có độ dài từ 3 đến 100,',
    			'ten.unique' => 'Tên slide đã tồn tại,',
    			'noidung.required'=>'Bạn chưa nhập nội dung,',
    		]);

    		$slide = new Slide;
    		$slide->Ten = $req->ten;
    		$slide->NoiDung = $req->noidung;
    		$slide->link = $req->link;

    		if($req->hasFile('hinh')){
	    		$file = $req->file('hinh');

	    		$name = $file->getClientOriginalName();
	    		$duoi = $file->getClientOriginalExtension();

	    		//echo $duoi;

	    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
	    			return redirect('admin/slide/them')->with('thongbao','Chỉ được upload hình có đuôi jpg, png, jpeg');
	    		}

	    		$Hinh = str_random(4).'_'.$name; //chổ này để random ra các ký tự phía trước để hình k trùng tên với nhau
	    		while(file_exists("public/img/slide/".$Hinh)){
	    			$Hinh = str_random(4).'_'.$name; //cho chạy vòng lặp kiểm tra coi có trùng k
	    		}
	    		//echo $duoi;
				$file->move("public/img/slide",$Hinh);
	    		$slide->Hinh = $Hinh;
	    	}
	    	else{
	    		$slide->Hinh="";
	    	}


    	$slide->save();
    	return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
    	$slide = Slide::find($id);
    	return view('admin.slide.sua', ['slide'=>$slide]);
    }

    public function postSua(Request $req, $id){
    	$slide = Slide::find($id);

    	$this->validate($req,
    		[
    			'ten'=>'required|min:3|max:100',
    			'noidung'=>'required',
    		],
    		[
    			'ten.min'=>'Tên slide phải có độ dài từ 3 đến 100,',
    			'ten.max'=>'Tên slide phải có độ dài từ 3 đến 100,',
    			'noidung.required'=>'Bạn chưa nhập nội dung,',
    		]);

    		$slide->Ten = $req->ten;
    		$slide->NoiDung = $req->noidung;
    		$slide->link = $req->link;

    		if($req->hasFile('hinh')){
	    		$file = $req->file('hinh');

	    		$name = $file->getClientOriginalName();
	    		$duoi = $file->getClientOriginalExtension();

	    		//echo $duoi;

	    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
	    			return redirect('admin/slide/sua/'.$id)->with('thongbao','Chỉ được upload hình có đuôi jpg, png, jpeg');
	    		}

	    		$Hinh = str_random(4).'_'.$name; //chổ này để random ra các ký tự phía trước để hình k trùng tên với nhau
	    		while(file_exists("public/img/slide/".$Hinh)){
	    			$Hinh = str_random(4).'_'.$name; //cho chạy vòng lặp kiểm tra coi có trùng k
	    		}
	    		//echo $duoi;
				$file->move("public/img/slide",$Hinh);
	    		$slide->Hinh = $Hinh;
	    	}
	    	else{
	    		$slide->Hinh="";
	    	}


    	$slide->save();
    	return redirect('admin/slide/sua'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$slide = Slide::find($id);

    	$slide->delete();

    	return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');
    }
}
