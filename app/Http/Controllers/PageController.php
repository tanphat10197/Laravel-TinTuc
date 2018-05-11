<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class PageController extends Controller
{
    //
    public function __construct(){
    	$theloai = TheLoai::all();
    	view()->share('theloai',$theloai);
    }
    public function trangchu(){    	
    	return view('page.trangchu');
    }
    public function lienhe(){    	
    	return view('page.lienhe');
    }
}
