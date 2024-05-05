<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BlogPost;


class Comment extends Model
{
    use HasFactory;
    function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
     }
    function blog(){
        return $this->belongsTo(BlogPost::class, 'blog_id', 'id');
     }
}
