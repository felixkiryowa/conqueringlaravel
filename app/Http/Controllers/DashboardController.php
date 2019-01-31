<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use \APP\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =  Auth::user()->id;
        //$user = User::find($user_id);
        $posts = DB::select('SELECT * FROM posts WHERE 	user_id = ?',[$user_id]);
        return view('dashboard')->with('posts',$posts);
        //
        //return $post;
            //('dashboard')->with('posts',$post);
    }
}
