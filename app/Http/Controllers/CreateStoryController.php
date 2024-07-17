<?php

namespace App\Http\Controllers;


use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreateStoryController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->validate([
            "description" => "required|string",
            "image" => "image|mimes:png,jpg,jpeg,pdf"
        ]);

        if ($request->hasFile("image")) {
            $file = $request->image;

            $data["image"] = Storage::putFile("photo_stories", $file);
        }

        Story::create(
            [
                "description" => $request->description,
                "user_id" => auth()->id(),
                "image"=>$data["image"] ?? null,
            ]
        );

        session()->flash("success", "Story Created Succesfully !");
        return redirect()->back();
    }

    
}
