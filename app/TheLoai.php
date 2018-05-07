<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "theloai";

    public function loaitin(){
    	return $this->hasMany('App\LoaiTin', 'idTheLoai', 'id');
    	//tạo liên kết: 1 thể loại sẽ có nhiều loại tin
    }

    public function tintuc(){
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
