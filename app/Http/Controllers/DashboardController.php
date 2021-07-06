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
            'posts' => Post::where('is_public', 1)->orWhere('user_id',auth()->id())->orderBy('id', 'DESC')->paginate(2)->through(fn ($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => Str::limit(strip_tags($post->content),200).'...',
                'created_at' => $post->created_at->diffForHumans(),
                'canEdit' => $post->user_id == auth()->id(),
            ]),
        ]);
    }
}
