<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\posts;
class wall extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    public function index()
    {
$posts = posts::where('ower_id',Auth::user()->id)->orderby('id','desc')->get();
return view('wall',compact('posts'));
    }

}
