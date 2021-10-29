<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Like;

class PostController extends Controller
{
    public function likePost(Post $post){
        $like = Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();

        if($like){
            $like->delete();
        }
        else {
            Like::create([
                'user_id' => auth()->user()->id,
                'post_id' => $post->id,
            ]);
        }
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::all();
        $posts = Post::with('category')->get();
        return view('posts.index', compact('posts', 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $cats = Category::all();
       return view('posts.create', compact('cats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'image' => 'mimes:jpg,png,jpeg,gif',
        ]);
        $imageName = "default.jpg";
        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/posts', $imageName);
        }
          Post::create([
              'title' => $request->input('title'),
              'content' => $request->input('content'),
              'category_id' => $request->input('category_id'),
              'user_id' => $request->input('user_id'),
              'image' => $imageName,
          ]);
        return redirect()->route('posts.index')->with('message', 'Added successfully');
    }

    public function show(Post $post)
    {
        $cats = Category::all();
        $comments = $post->comments;
        $likeCount = count($post->users);
        $ifliked = Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('posts.show')->with(['post' => $post, 'comments' => $comments, 'cats' => $cats,
            'likeCount' => $likeCount, 'ifliked' => $ifliked,]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $cats = Category::all();
        return view('posts.edit')->with(['post' => $post, 'cats' => $cats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)

    {
        $this->authorize('update', $post);
        $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('posts.index')->with('message', 'Post updated successfully');
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post deleted successfully');
    }
    public function categoryPosts(Category $category){
        $cats = Category::all();
        $posts = $category->posts;
        return view('posts.index', compact('posts', 'cats'));
    }
}
