<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Importing the model
use App\Post;
//To use Sql
use DB;
use Auth;
class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //return Post::where('title','Post Two')->get();
        //$posts = DB::select('SELECT * FROM  posts');
        //$posts = Post::orderBy('title','desc')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(1);
        return view('posts.index')->with('posts',$posts);
    }
    
    //Authentication
  public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getcurrentUser(){
        
        $name = Auth::user()->name;
        return $name;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Performing validations
        $this->validate($request, [
           'title'  => 'required',
           'body'   => 'required'
        ]);
        //Handle File Upload
        if($request->hasFile('uploaded_file')){
            //Get file name with Extension
            $fileNameWithExt = $request->file('uploaded_file')->getClientOriginalName();
            //Get file name
             $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Extension
            $extension = $request->file('uploaded_file')->getClientOriginalExtension();
            
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            
            $path = $request->file('uploaded_file')->storeAs('public/uploads',$fileNameToStore);
            
        }else{
             //$fileNameToStore = 'noimage.jpg';
             return redirect('posts/create')->with('error' ,'No file was Choosen');
        }
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post ->user_id = Auth::user()->id;
        $post ->cover_image = $fileNameToStore;
        
        
        //saving to the database
        $post ->save();
        return redirect('/posts')->with('success' ,'Posts Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);
        return view('posts.edit')->with('post',$post);
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
         //Performing validations
        $this->validate($request, [
           'title'  => 'required',
           'body'   => 'required'
        ]);
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
        //saving to the database
        $post ->save();
        return redirect('/posts')->with('success' ,'Posts Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success' ,'Posts Removed');
    }
	
	public function try(){
		
		return view('posts.try');
	}
}
