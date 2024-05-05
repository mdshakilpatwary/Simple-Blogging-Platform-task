<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'image',
        'text_content',
        'slug',

        
    ];
    
    function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
     }
}
