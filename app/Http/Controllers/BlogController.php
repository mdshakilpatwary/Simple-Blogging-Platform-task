<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;
use File;
use Image;
use Auth;
class BlogController extends Controller
{
    public function index(){
        return view('backend.blog.index');
    }
    // store blog controller part 
    function store(Request $request){

        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'content' => 'required',
            
        ],
        [
            'title.required' => 'Blog title is required',
            'image.required' => 'Blog image is required',
            'content.required' => 'Blog content is required',
           
        ]);
    
        $blog = New BlogPost;

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title).'_'.rand();
        $blog->text_content = $request->content;
        $blog->user_id = Auth::user()->id;
        $blog->created_at = Carbon::now();
        if($request->file('image')){
            $image = $request->file('image');
            $customname='blog_'.rand().'.'. $image->getClientOriginalExtension();
            $blog->image = 'uploads/blog/'.$customname;
            if($blog->save()){
                $image->move('uploads/blog', $customname);

            }
        }

        $insert = $blog->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully Blog Uploaded');

        }
        else{
            return redirect()->back()->with('error', 'Opps! Blog Upload Fail');

        }

    }
    public function manage(){
        $blogs = BlogPost::orderBy('id', 'DESC')->get();
        $userBlogs = BlogPost::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('backend.blog.manage',compact('blogs','userBlogs'));
    }
    // edit 
    public function edit($slug){
        $blog = BlogPost::where('slug',$slug)->first();
        return view('backend.blog.edit',compact('blog'));
    }
   
    // update blog controller part 
    function update(Request $request,$id){

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            
        ],
        [
            'title.required' => 'Blog title is required',
            'content.required' => 'Blog content is required',
           
        ]);
    
        $blog = BlogPost::findOrFail($id);
        
        $blog->title = $request->title;
        $blog->slug =Str::slug($request->title).'_'.rand();
        $blog->text_content = $request->content;
        if($request->file('image')){
            if(File::exists(public_path($blog->image))){
                File::delete(public_path($blog->image));
            }
            $image = $request->file('image');
            $customname='blog_'.rand().'.'. $image->getClientOriginalExtension();
            $blog->image = 'uploads/blog/'.$customname;
            if($blog->update()){
                $image->move('uploads/blog', $customname);

            }
        }

        $insert = $blog->update();
        if($insert){
            return redirect('/manage/blog')->with('success', 'Successfully Blog Updated');

        }
        else{
            return back()->with('error', 'Opps! Blog Update Fail');

        }

    }
    public function delete($id){
        $blog = BlogPost::findOrFail($id);
        if(File::exists(public_path($blog->image))){
            File::delete(public_path($blog->image));
        }
        $msg = $blog->delete();
        if($msg){
            return redirect()->back()->with('success', 'Blog delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Blog not delete');

        } 
    }
}
