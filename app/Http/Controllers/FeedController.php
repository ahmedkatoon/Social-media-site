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
       $friends = Auth::user()->friends()->pluck('users.id')->toArray(); // استرداد معرفات الأصدقاء الحاليين
       $users = Auth::user();
        $user = User::where("id",$id)->first();
        $posts = Post::where("user_id",$id)->latest()->get();
        $stories = Story::where("user_id",$id)->latest()->get();
        $peoples_may_know = User::where("id","!=",$id)->whereNotIn('id', $friends)->get();
        $friends_request = $user->friendRequests()->get();
        // dd($freinds_request);
        return view("feed",compact("user","posts","stories","peoples_may_know","friends_request"));
    }
}
