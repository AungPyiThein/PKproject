<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
       // $posts = Post::orderBy('title', 'asc')->get();
        $posts = DB::select('SELECT * FROM posts');
        $posts = DB::table('posts')->latest()->paginate(2);
        return view('posts.index')->with('posts', $posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

      public function search(Request $request)
    {
        $search = $request->get('search');
        $posts = DB::table('posts')->where('title', 'like', '%' .$search.'%')->paginate(3);
        return view('posts.index', ['posts' => $posts]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title' => 'required',
         'body' => 'required', 
            'cover_image' => 'image|nullable|max:1999']);
        //handle the file upload
        if($request->hasFile('cover_image')){
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->visit_count = $post->visit_count+1;
        $post->save();

        return redirect('/posts')->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
       
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $post = Post::find($id);
         if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized page.');
         }

        return view('posts.edit')->with('post', $post);
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
        $this->validate($request,['title' => 'required',
         'body' => 'required', 
            'cover_image' => 'image|nullable|max:1999']);
        //handle the file upload
        if($request->hasFile('cover_image')){
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        
        $post->save();

        return redirect('/posts')->with('success', 'Post updated.');
    }

    public function addViewCount($id)
    {
       $post = Post::find($id);
        $post->visit_count = $post->visit_count+1;
        $post->save();

        return view('posts.show')->with('post', $post);
    }


    public function mostView()
    {
        $posts = DB::select('SELECT * FROM posts');
         $posts = DB::table('posts')->orderBy('visit_count', 'desc')->paginate(2);
         return view('posts.index')->with('posts', $posts);
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

      if(auth()->user()->id !== $post->user_id){
      return redirect('/posts')->with('error','Unauthorized page.');
     }

     if($post->cover_image != 'noimage.jpg'){
        Storage::delete('public/cover_images/'.$post->cover_image);
     }

        $post->delete();
        return redirect('/posts')->with('success','Post removed.');
    }
}
