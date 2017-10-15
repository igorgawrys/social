<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Prequest;
use App\comments;
class comments2 extends Controller
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
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prequest $request)
    {
      $content = $request->input('content2');
      $id =  $request->input('post_id');
      if(DB::table('posts')->where('id',$id)->count()==0)
      {
          return view('notfound');
      }
      else {
        $date = date("Y-m-d H:i:s");
        DB::table('comments')->insert(['content' => $content, 'ower_id' => Auth::user()->id,'post_id' => $id,'created_at' => $date,'updated_at' => null]);
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if(DB::table('comments')->where('id',$id)->count()==0)
      {
        return view('notfound');
      }
      else {
        $comments = comments::where('id',$id)->get();
        return view('comments.show',compact('comments'));
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
      if(comments::where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
      {
         return view('notpermision');
      }
      else {
        $comment = comments::where('id',$id)->where('ower_id',Auth::user()->id)->get();
        return view('comments.edit',compact('comment'));
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Prequest $request, $id)
    {
      if(DB::table('comments')->where('id',$id)->where('ower_id',Auth::user()->id)->count()==0)
      {
    return view('notpermision');
      }
      else {
        $content2 = $request->input('content2');
            $date = date("Y-m-d H:i:s");
        DB::table('comments')->where('id',$id)->update(['content' => $content2,'updated_at' => $date]);
            return redirect()->route('social_start.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
