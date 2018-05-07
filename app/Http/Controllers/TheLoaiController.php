<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
    	$theloai = TheLoai::paginate(10); //select * from theloai
    	return view('admin.theloai.danhsach', ['theloai'=>$theloai]);
    }

    public function getThem(){
    	return view('admin.theloai.them');
    }

    public function postThem(Request $req){
    	$this->validate($req,
    	[
    		'ten'=>'required|min:3|max:100|unique:TheLoai,Ten'
    	],
    	[
    		'ten.required'=>'Bạn chưa nhập tên thể loại',
    		'ten.min'=>'Tên thể loại phải có độ dài từ 3 đến 100',
    		'ten.max'=>'Tên thể loại phải có độ dài từ 3 đến 100',
    		'ten.unique' => 'Tên thể loại đã tồn tại',
    	]
    	);

    	$theloai = new TheLoai;
    	$theloai->Ten = $req->ten;
    	$theloai->TenKhongDau = str_slug($req->ten,'-');
    	$theloai->save();

    	return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua', ['theloai'=>$theloai]);
    }

    public function postSua(Request $req, $id){
    	$theloai = TheLoai::find($id);
    	$this->validate($req,
    	[
    		'ten'=>'required|min:3|max:100|unique:TheLoai,Ten'
    	],
    	[
    		'ten.required'=>'Bạn chưa nhập tên thể loại',
    		'ten.min'=>'Tên thể loại phải có độ dài từ 3 đến 100',
    		'ten.max'=>'Tên thể loại phải có độ dài từ 3 đến 100',
    		'ten.unique' => 'Tên thể loại đã tồn tại',
    	]
    	);
    	$theloai->Ten = $req->ten;
    	$theloai->TenKhongDau = str_slug($req->ten,'-');
    	$theloai->save();

    	return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$theloai = TheLoai::find($id);

    	$theloai->delete();

    	return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thành công');
    }
}
