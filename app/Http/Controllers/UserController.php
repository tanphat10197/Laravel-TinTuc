<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    //
    public function getDanhSach(){
    	$user = User::paginate(10);
    	return view('admin.user.danhsach', ['user'=>$user]);
    }

    public function getThem(){
    	return view('admin.user.them');
    }

    public function postThem(Request $req){
    	$this->validate($req,[
    		'ten'=>'required|min:3',
    		'email'=>'required|unique:User,email',
    		'pass'=>'required|min:6|max:32', 
    		'repass'=>'required|same:pass'
    	],
    	[
    		'ten.required'=>'Bạn chưa nhập tên,',
    		'ten.min'=>'Tên không được dưới 3 ký tự,',
    		'email.required'=>'Bạn chưa nhập email,',
    		'email.unique'=>'Email này đã tồn tại,',
    		'pass.required'=>'Bạn chưa nhập password,',
    		'pass.min'=>'Password phải trong khoản từ 6 đến 32 ký tự,',
    		'pass.max'=>'Password phải trong khoản từ 6 đến 32 ký tự,',
    		'repass.required'=>'Bạn chưa nhập lại password,',
    		'repass.same'=>'2 password không trùng nhau,'
    	]);

    	$user = new User;
    	$user->ten = $req->ten;
    	$user->email = $req->email;
    	$user->password = bcrypt($req->password); //mã hóa password
    	$user->quyen = $req->rdoquyen;

    	$user->save();

    	return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }
}
