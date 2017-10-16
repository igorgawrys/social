<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Srequest;
use App\Http\Requests\Usrequest;
use App\posts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;
use App\friends;
class social_start extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
$this->middleware('auth');
     }
    public function index()
    {
      $friends = friends::where('one_friends_id',Auth::user()->id)->orwhere('two_friends_id',Auth::user()->id)->where('status','success')->get();
      $friendc = friends::where('one_friends_id',Auth::user()->id)->orwhere('two_friends_id',Auth::user()->id)->where('status','success')->count();
  return view('social_start.index',compact('friends','friendc'));
    }

}
