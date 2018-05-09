<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Comment;
class UserController extends Controller
{
    //
    public function getDanhSach(){
    	$user = Users::paginate(10);
    	return view('admin.user.danhsach', ['user'=>$user]);
    }

    public function getThem(){
    	return view('admin.user.them');
    }

    public function postThem(Request $req){
    	$this->validate($req,[
    		'ten'=>'required|min:3',
    		'email'=>'required|unique:users,email',
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

    	$user = new Users;
    	$user->name = $req->ten;	
    	$user->email = $req->email;
    	$user->password = bcrypt($req->password); //mã hóa password
    	$user->quyen = $req->rdoquyen;

    	$user->save();

    	return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
    	$user = Users::find($id);
    	return view('admin.user.sua',['user'=>$user]);
    }

    public function getXoa($id){
    	$user = Users::find($id);
    	$comment = Comment::where('idUser',$id);
      	$comment->delete(); 
    	$user->delete();
    	return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công');
    }
}
