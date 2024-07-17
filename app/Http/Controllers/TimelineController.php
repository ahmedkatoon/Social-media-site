<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index(){
        $id = Auth::id();
        $user = User::where("id",$id)->first();
        $posts = Post::where("user_id",$id)->latest()->get();
        return view("timeline",compact("user","posts"));
    }
}
