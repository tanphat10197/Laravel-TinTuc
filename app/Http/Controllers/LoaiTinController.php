<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LoaiTin;
use App\Theloai;
class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
    	$loaitin = LoaiTin::paginate(10);
    	return view('admin.loaitin.danhsach', ['loaitin'=>$loaitin]);
    }

    public function getThem(){
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.them', ['theloai'=>$theloai]);
    }

    public function postThem(Request $req){
    	$this->validate($req,
    		[
    			'tenloaitin'=>'required|min:3|max:100|unique:LoaiTin,Ten'
    		],
    		[
    			'tenloaitin.required'=>'Bạn chưa nhập tên loại tin',
    			'tenloaitin.min'=>'Tên loại tin phải có độ dài từ 3 đến 100',
    			'tenloaitin.max'=>'Tên loại tin phải có độ dài từ 3 đến 100',
    			'tenloaitin.unique' => 'Tên loại tin đã tồn tại',
    		]);

    	$loaitin = new LoaiTin();
    	$loaitin->Ten = $req->tenloaitin;
    	$loaitin->TenKhongDau = str_slug($req->tenloaitin, '-');
    	$loaitin->idTheLoai = $req->slloaitin;
    	$loaitin->save();

    	return redirect('admin/loaitin/them')->with('thongbao','Thêm Thành Công');
    }

    public function getSua($id){
    	$loaitin = LoaiTin::find($id);
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.sua', ['loaitin'=>$loaitin, 'theloai'=>$theloai]);
    }

    public function postSua(Request $req, $id){
    	$loaitin = LoaiTin::find($id);
    	$this->validate($req,
    	[
    		'tenloaitin'=>'required|min:3|max:100|unique:LoaiTin,Ten'
    	],
    	[
    		'tenloaitin.required'=>'Bạn chưa nhập tên thể loại',
    		'tenloaitin.min'=>'Tên thể loại phải có độ dài từ 3 đến 100',
    		'tenloaitin.max'=>'Tên thể loại phải có độ dài từ 3 đến 100',
    		'tenloaitin.unique' => 'Tên thể loại đã tồn tại',
    	]
    	);
    	$loaitin->Ten = $req->tenloaitin;
    	$loaitin->TenKhongDau = str_slug($req->ten,'-');
    	$loaitin->idTheLoai = $req->slloaitin;
    	$loaitin->save();

    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$loaitin = LoaiTin::find($id);

    	$loaitin->delete();

    	return redirect('admin/loaitin/danhsach')->with('thongbao', 'Xóa Thành Công');
    }
}
