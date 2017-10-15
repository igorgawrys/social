<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class search extends Controller
{
    public function index()
    {
      if(isset($_GET['q']))
      {
      $q = $_GET['q'];
    $search = User::where('name','LIKE','%'.$_GET['q'].'%')->paginate(4);
    $searchc = User::where('name','LIKE','%'.$_GET['q'].'%')->count();
    return view('search',compact('search','searchc','q'));
    }
    else {
      return view('notfound');
    }
    }
}
