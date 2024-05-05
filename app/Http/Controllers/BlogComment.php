<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Carbon\Carbon;
use Auth;

class BlogComment extends Controller
{
    public function store(Request $request){
        $request->validate([
            'comment' => 'required',
            
        ],
        [
            'comment.required' => 'Comment text is required',
           
        ]);
        $comment =new Comment;
        $comment->comment =$request->comment;
        $comment->blog_id =$request->blog_id;
        $comment->user_id =Auth::user()->id;
        $comment->created_at = Carbon::now();
        $insert = $comment->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully Blog Uploaded');

        }
        else{
            return redirect()->back()->with('error', 'Opps! Blog Upload Fail');

        }
    }

    public function delete($id){
        $comment = Comment::findOrFail($id);
        
        $msg = $comment->delete();
        if($msg){
            return redirect()->back()->with('success', 'Comment delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Comment not delete');

        } 
}
}
