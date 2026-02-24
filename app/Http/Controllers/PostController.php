<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(22);

        return view('posts.all', compact('posts'));
    }

    public function index_admin()
    {
        if (! auth()->check() || ! auth()->user()->is_admin()) {
            return redirect()->route('login');
        }

        return view('admin.posts.show', [
            'posts' => Post::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check() && auth()->user()->is_admin()) {
            $authors = Auther::all();

            return view('admin.posts.create', compact('authors'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->check() && auth()->user()->is_admin()) {
            $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'auther_id' => 'required|exists:authers,id',
            ]);
            Post::create($request->only(['title', 'body', 'auther_id']));

            return redirect()->route('admin.posts.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', '%'.$request->input('query').'%')->orWhere('body', 'like', '%'.$request->input('query').'%')
            ->paginate(10);

        return view('admin.posts.show', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (! auth()->check() || ! auth()->user()->is_admin()) {
            return redirect()->route('login');
        }
        $authors = Auther::all();

        return view('admin.posts.edit', compact('post', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (auth()->check() && auth()->user()->is_admin()) {
            $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'auther_id' => 'required|exists:authers,id',
            ]);
            $post->update($request->only(['title', 'body', 'auther_id']));

            return redirect()->route('admin.posts.index');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (auth()->check() && auth()->user()->is_admin()) {
            $post->delete();

            return redirect()->route('admin.posts.index');
        } else {
            return redirect()->route('login');
        }
    }
}
