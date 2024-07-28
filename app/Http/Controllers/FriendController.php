<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function sendRequest($friend_id){
        $user = Auth::user();

        if($user->friendRequests()->where("friend_id",$friend_id)->exists()){
            session()->flash("error","Friend request already sent .");
            return redirect()->back();
        }
        elseif($user->friends()->where("friend_id",$friend_id)->exists()){
            session()->flash("error","this user is already your friend .");
            return redirect()->back();
        }else{

            $user->friendRequests()->attach($friend_id,["status"=>"pending"]);
            session()->flash("success","Friend request send .");
            return redirect()->back();
        }
    }

    public function acceptRequest($user_id){
        $user=Auth::user();
        // dd($user_id);
        // $user->friends()->updateExistingPivot($user_id,["status"=>"accepted"]);
        $user->friends()->syncWithoutDetaching([$user_id => ['status' => 'accepted']]);

        session()->flash("success","Friend request accepted .");
        return redirect()->back();
    }
    public function rejectRequest($user_id){
        $user=Auth::user();
        $user->friends()->detach($user_id);

        session()->flash("success","Friend request rejected .");
        return redirect()->back();
    }


    
}
