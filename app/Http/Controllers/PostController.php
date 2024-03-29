<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct() 
    {
        // $this->authorizeResource(Post::class, 'post');まとめて制限をかける場合  
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 新しい投稿順↓
        $posts = Post::orderBy('created_at','desc')->get();
        // $posts = Post::inRandomOrder()->get(); //←ランダム順表示で表示したい場合
        $user = auth()->user();
        $plans = Plan::all();
        return view('post.index', compact('posts', 'user', 'plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('admin'); Contollerでadmin以外操作できなくする記述→この場合は投稿できなくなる
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required|max:1000',
            'image' => 'image|max:1024'
        ]);
        $post = new Post();
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->user_id = auth()->user()->id;
        if(request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }
        $post->save();
        return redirect()->route('post.create')->with('message', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $inputs = $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required|max:1000',
            'image' => 'image|max:1024'
        ]);

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        if(request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }
        $post->save();
        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('post.index')->with('message','投稿を削除しました。');
    }

    public function mypost()
    {
        $user=auth()->user()->id;
        $posts=Post::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('post.mypost' ,compact('posts'));
    }

    public function mycomment()
    {
        $user=auth()->user()->id;
        $comments=Comment::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('post.mycomment' ,compact('comments'));
    }
}
