<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    //
    protected $table = "loaitin";

    public function theloai(){
    	return $this->belongsTo('App\TheLoai', 'idTheLoai', 'id');
    	//1 loại tin thuộc về 1 thể loại
    }

    public function tintuc(){
    	return $this->hasMany('App\TinTuc', 'idLoaiTin','id');
    	//1 loai tin có thể có nhiều tin tức
    }
}
