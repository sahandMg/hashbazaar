<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(){
        $posts = DB::connection('mysql2')->table('rainlab_blog_posts')->get();
        return view('blog.index',compact('posts'));

    }
    public function showPost($lang,$slug){

        $post = DB::connection('mysql2')->table('rainlab_blog_posts')->where('slug',$slug)->first();
        if(is_null($post)){
            abort(404);
        }

//        if($post->title != $post->slug){
//            $post = DB::connection('mysql2')->table('rainlab_blog_posts')->where('slug',$slug)->update(['slug'=>'title']);
//        }
        return view('blog.post',compact('post'));
    }
}
