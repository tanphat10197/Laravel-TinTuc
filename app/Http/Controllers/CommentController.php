<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\TinTuc;
class CommentController extends Controller
{
    //
    public function getXoa($id, $idtintuc){
    	$com = Comment::find($id);
    	$com->delete();

    	return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao', 'Xóa thành công Comment');
    }

    public function postComment($id, Request $req){
    	$idTinTuc = $id;
    	$tintuc = TinTuc::find($id);
    	$cm = new Comment;
    	$cm->idTinTuc = $idTinTuc;
    	$cm->idUser = Auth::user()->id;
    	$cm->NoiDung = $req->noidung;
    	$cm->save();

    	return redirect('tintuc/'.$id.'/'.$tintuc->TieuDeKhongDau.'.html')->with('thongbao','Viết bình luận thành công');
    }
}
