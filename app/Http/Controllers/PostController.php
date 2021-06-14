<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Events\NewPostCreated;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user:name,id')->latest()->paginate(7);
        return Inertia::render('Post/Index',[
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
            'status' => 'required|numeric',
            'images' => 'image',
        ]);

        $inputs['user_id'] = \Auth::id();

        if($request->images){
            $image = $request->images;
            $filename = time();
            $extension = $image->getClientOriginalExtension();
            
            $image = Image::make($image)->save(public_path('storage/uploads/'.$filename.'.'.$extension));

            $image->resize(400,500, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('storage/uploads/'.$filename.'._thumbnail.'.$extension));
            
            $inputs['image'] = $filename.'.'.$extension;
        }

        $request->merge($inputs);

        $post = Post::create($request->only(['title', 'body', 'excerpt', 'image', 'status', 'user_id']));

        // event(new NewPostCreated($post));
        return redirect()->route('post')->with('message', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
            'status' => 'required|numeric',
        ]);   

        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('post')->with('message', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();            
        return redirect()->back()->with('message', 'Post deleted succesfully.');
    }
}
