<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;

class FeedController extends Controller
{
    public function index(Request $request){
    	$data = Post::with('user:name,id,profile_photo_path')->latest()->paginate(1);

    	if($request->wantsJson()){
    		return $data;
    	}
        return Inertia::render('Feed/Index', ['data' => $data]);
    }
}
