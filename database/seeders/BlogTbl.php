<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogPost;
use Hash;
class BlogTbl extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogPost = BlogPost::insert([
            // admin login data
        [
            'Title' => 'Test Name',
            'slug' => 'test_name_112',
            'user_id' =>1,
            'image' =>'https://cdn.pixabay.com/photo/2015/08/23/09/22/banner-902589_640.jpg',
            'text_content' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        ]
        ]);
    }
}
