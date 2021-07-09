<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard',[
            'filters' => \Illuminate\Support\Facades\Request::all('search'),
            'posts' => Post::with('user')
                ->where('is_public', 1)
                ->orWhere('user_id',auth()->id())
                ->orderBy('id', 'DESC')
                ->filter(\Illuminate\Support\Facades\Request::only('search'))
                ->paginate(4)
                ->withQueryString()
                ->through(fn ($post) => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => Str::limit(strip_tags($post->content),200).'...',
                    'author' => $post->user->name,
                    'created_at' => $post->created_at->diffForHumans(),
                    'canEdit' => $post->user_id == auth()->id(),
                ]),
        ]);
    }
}
