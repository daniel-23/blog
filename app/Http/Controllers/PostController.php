<?php

namespace App\Http\Controllers;

use App\Models\{Category, Post};
use App\Http\Requests\PostStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Posts/Index', [
            'posts' => auth()->user()->posts()->paginate(10)->through(fn ($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => Str::limit(strip_tags($post->content),100).'...',
                'created_at' => $post->created_at->diffForHumans(),
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Posts/Create', [
            'categories' => Category::select(['id', 'name'])->where('active', 1)->orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());
        $post->categories()->sync($request->categories);
        $request->session()->flash('flash', 'Post created successfully!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('categories');
        return Inertia::render('Posts/Show', [
            'post' => $post,
            'canEdit' => $post->user_id == auth()->id(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->load('categories');
        return Inertia::render('Posts/Edit', [
            'categories' => Category::select(['id', 'name'])->where('active', 1)->orderBy('name')->get(),
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        $post->update($request->validated());
        $post->categories()->sync($request->categories);
        $request->session()->flash('flash', 'Post modified successfully!');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function uploadFiles(Request $request)
    {
        
        $path = $request->file('img')->store('posts','public');

        return response()->json(['url' => url("/storage/$path")]);
    }
}
