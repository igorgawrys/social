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
class posts2 extends Controller
{
  public function __construct()
  {
$this->middleware('auth',['except' => 'show']);
  }
  public function store(Srequest $request)
  {
        // posts::create($request->all());
        //echo "cebyl";
        $content = $request->input('content');
        $date = date("Y-m-d H:i:s");
        DB::table('posts')->insert(['content' => $content, 'ower_id' => Auth::user()->id,'created_at' => $date,'updated_at' => null]);
            return redirect()->back();
  }
  public function edit($id)
  {
    if(Auth::user()->role==1)
    {
    }
    else {
    if(DB::table('posts')->where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
    {
  return view('notpermision');
  exit();
    }
  }
        $post = DB::table('posts')->where('id',$id)->get();
      return view('posts.edit',compact('post'));
  }
  public function destroy($id)
  {
    if(Auth::user()->role==1)
    {
    }
    else {
    if(DB::table('posts')->where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
    {
  return view('notpermision');
  exit();
    }
  }
    DB::delete('delete from posts where id='.$id);
      DB::delete('delete from comments where post_id='.$id);
      return redirect()->back();
  }
  public function update(Usrequest $request, $id)
  {
    if(Auth::user()->role==1)
    {
    }
    else {
    if(DB::table('posts')->where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
    {
  return view('notpermision');
  exit();
    }
  }
      $content = $request->input('content');
          $date = date("Y-m-d H:i:s");
      DB::table('posts')->where('id',$id)->update(['content' => $content,'updated_at' => $date]);
          return redirect()->back();
  }
  public function show($id)
  {
    if(DB::table('posts')->where('id',$id)->count()==0)
    {
  return view('notfound');
    }
    else {
      $posts = DB::table('posts')->where('id',$id)->get();
    return view('posts.show',compact('posts'));
    }
  }
}
