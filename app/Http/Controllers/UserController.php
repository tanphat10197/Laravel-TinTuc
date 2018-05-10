<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
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

    	$user = new User;
    	$user->name = $req->ten;	
    	$user->email = $req->email;
        $user->password = bcrypt($req->pass); //mã hóa password
    	// $user->password = $req->password; //mã hóa password
    	$user->quyen = $req->rdoquyen;

        // echo $req->password;

    	$user->save();

    	return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
    	$user = User::find($id);
    	return view('admin.user.sua',['user'=>$user]);
    }

    public function getXoa($id){
    	$user = User::find($id);
    	$comment = Comment::where('idUser',$id);
      	$comment->delete(); 
    	$user->delete();
    	return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công');
    }

    public function getAdminDangNhap(){
        return view('admin.login');
    }

    public function postAdminDangNhap(Request $req){
        $this->validate($req,
        [
            'email'=>'required', 
            'password'=>'required'
        ],
        [
            'email.required'=>'Bạn chưa nhập email', 
            'password.required'=>'Bạn chưa nhập password'
        ]
        );
        // echo $req->email;
        // echo $req->password;

       if (Auth::attempt(['email' => $req->email, 'password' => $req->password, 'quyen'=>1])){
            return redirect('admin/theloai/danhsach');
           
        }
        else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    public function getAdminDangXuat(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
