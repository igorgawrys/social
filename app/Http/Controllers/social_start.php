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
$this->middleware('auth',['except' => 'show']);
     }
    public function index()
    {
      $friends = friends::where('one_friends_id',Auth::user()->id)->orwhere('two_friends_id',Auth::user()->id)->where('status','success')->get();
      $friendc = friends::where('one_friends_id',Auth::user()->id)->orwhere('two_friends_id',Auth::user()->id)->where('status','success')->count();
  return view('social_start.index',compact('friends','friendc'));
    }
    public function store(Srequest $request)
    {
          // posts::create($request->all());
          //echo "cebyl";
          $content = $request->input('content');
          $date = date("Y-m-d H:i:s");
          DB::table('posts')->insert(['content' => $content, 'ower_id' => Auth::user()->id,'created_at' => $date,'updated_at' => null]);
              return redirect()->route('social_start.index');
    }
    public function edit($id)
    {
      if(DB::table('posts')->where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
      {
    return view('notpermision');
      }
      else {
          $post = DB::table('posts')->where('id',$id)->where('ower_id',Auth::user()->id)->get();
        return view('social_start.edit',compact('post'));
      }
    }
    public function destroy($id)
    {
      if(DB::table('posts')->where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
      {
    return view('notpermision');
      }
      else {
      DB::delete('delete from posts where id='.$id.' and ower_id='.Auth::user()->id);
        DB::delete('delete from comments where post_id='.$id);
        return redirect()->route('social_start.index');
      }
    }
    public function update(Usrequest $request, $id)
    {
      if(DB::table('posts')->where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
      {
    return view('notpermision');
      }
      else {
        $content = $request->input('content');
            $date = date("Y-m-d H:i:s");
        DB::table('posts')->where('id',$id)->update(['content' => $content,'updated_at' => $date]);
            return redirect()->route('social_start.index');
      }
    }
    public function show($id)
    {
      if(DB::table('posts')->where('id',$id)->count()==0)
      {
    return view('notfound');
      }
      else {
        $posts = DB::table('posts')->where('id',$id)->get();
      return view('social_start.show',compact('posts'));
      }
    }

}
