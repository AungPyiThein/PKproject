<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use DB;
class PostsController extends Controller
{
   
  


	   public function detailPost(Request $request)
       {
     //   		$validator = validator(request()->all(), [

	    //    	'id' => 'required'
	    // ]);
      
        
     

          $post = Post::find(request()->id);



            if($post == null){
                 return response()->json([
                    'result'=> $post,
                    'status'=> 0,
                    'message'=>"fail, no record"]);
                }
            else{
                 return response()->json([
                    'result'=> $post,
                    'status'=> 1,
                    'message'=>"detail"
                ]);
            }

        
    }


    public function store(Request $request)
    {	// return response()->json('here');
    	$validator = validator(request()->all(), [
         'title' => 'required',
    	
        'body' => 'required', 
        'cover_image' => 'image|nullable|max:1999'
        ]);
            
        if($validator->fails()) {
            $error_text="";

            foreach($validator->errors()->all() as $error){
                $error_text .= $error;
            }
        
            return response()->json([
                'result'=> null,
                'status'=> 0,
                'message'=>"fail, " . $error_text
            ]);
          
        }

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
        $post->user_id = 12;
        $post->cover_image = $fileNameToStore;
        $post->visit_count = $post->visit_count+1;
        $post->save();


        return response()->json([
        'result'=> $post,
         'stauts'=>1,
         'message'=>"success"


     				]);
    }


    public function update(Request $request)
       {
     //   	$validator = validator(request()->all(), [

	    //    	'id' => 'required',
	    //    	'title' => 'required',
	    //     'body' => 'required', 
	    //     'cover_image' => 'image|nullable|max:1999'
	    // ]);
      
        
        
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

        // $post = Post::find($request->id);
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');
        // if($request->hasFile('cover_image')){
        //     $post->cover_image = $fileNameToStore;
        // }
        
        // $post->save();

        //update
        Post::where('id',$request->id)->update(['title'=>$request->title,'body'=>$request->body]);

	       return response()->json([
	                'result'=> null,
	                'status'=> 0,
	                'message'=>"succcessfully updated, "
	            ]);
    }



     public function destroy(Request $request)
    {
    	$validator = validator(request()->all(), [

	       	'id' => 'required'
	    ]);

        $post = Post::find($request->id);

     //  if(auth()->user()->id !== $post->user_id){
     //  return redirect('/posts')->with('error','Unauthorized page.');
     // }

     // if($post->cover_image != 'noimage.jpg'){
     //    Storage::delete('public/cover_images/'.$post->cover_image);
     // }

        $post->delete();

        return response()->json([
	                'result'=> $post,
	                'status'=> 1,
	                'message'=>"delete"
	            ]);
    }

    public function addViewCount(Request $request)
    {
    	$validator = validator(request()->all(), [

	       	'id' => 'required'
	    ]);

       $post = Post::find($request->id);
        $post->visit_count = $post->visit_count+1;
        $post->save();

        return response()->json([
	                'result'=> $post,
	                'status'=> 1,
	                'message'=>"addViewCount"
	            ]);
    }

     public function mostView(Request $request)
    {
        $posts = DB::select('SELECT * FROM posts');
         $posts = DB::table('posts')->orderBy('visit_count', 'desc')->paginate(1);

         return response()->json([
	                'result'=> $posts,
	                'status'=> 1,
	                'message'=>"Most View"
	            ]);
    }


     public function search(Request $request)
    {
     //   $validator = validator(request()->all(), [

	    //    	'title' => 'required'
	    // ]);

		 // $search = Post::find($request->title);
        // $posts = DB::table('posts')->where('title', 'like', '%' .$search.'%')->paginate(2);

		 $search = $request->get('title');
          $posts = DB::table('posts')->where('title', 'like', '%' .$search.'%')->paginate(2);
       

        return response()->json([
	                'result'=> $posts,
	                'status'=> 1,
	                'message'=>"Searched"
	            ]);
    }
    
}
