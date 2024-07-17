<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index(){

       $id = Auth::id();
        $user = User::where("id",$id)->first();
        $posts = Post::where("user_id",$id)->latest()->get();
        $stories = Story::where("user_id",$id)->latest()->get();
        return view("feed",compact("user","posts","stories"));
    }
}
