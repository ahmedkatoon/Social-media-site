<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreatePotsController extends Controller
{

    public function store(Request $request)
    {

        $data = $request->validate([
            "description" => "required|string",
            "image" => "image|mimes:png,jpg,jpeg,pdf"
        ]);

        if ($request->hasFile("image")) {
            $file = $request->image;

            $data["image"] = Storage::putFile("photo_posts", $file);
        }

        Post::create(
            [
                "description" => $request->description,
                "user_id" => auth()->id(),
                "image"=>$data["image"] ?? null,
            ]
        );

        session()->flash("success", "Post Created Succesfully !");
        return redirect()->back();
    }
}
