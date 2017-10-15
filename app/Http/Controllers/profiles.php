<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests\Prequest;
use Illuminate\Support\Facades\Auth;
class profiles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware('auth',['except' => ['index', 'show']]);
     }
    public function index()
    {
      $profiles = User::paginate(4);
        return view('profiles.index',compact('profiles'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if(DB::table('users')->where('id',$id)->count()==0)
      {
return view('notfound');
      }
      else
      {
      $profiles2 = User::where('id',$id)->get();
        return view('profiles.show',compact('profiles2'));
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
