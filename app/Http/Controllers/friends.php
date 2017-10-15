<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class friends extends Controller
{
    public function index()
    {
        $users = User::paginate(4);
        return view('friends.index',compact('users'));
    }

    public function show($id)
    {
      $profiles2 = User::where('id',$id)->get();
        return view('friends.show',compact('profiles2'));
    }
}
