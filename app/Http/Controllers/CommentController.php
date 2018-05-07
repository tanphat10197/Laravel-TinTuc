<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    //
    public function getXoa($id, $idtintuc){
    	$com = Comment::find($id);
    	$com->delete();

    	return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao', 'Xóa thành công Comment');
    }
}
