<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function allPost(Post $post)
    {
        $post = Post::latest()->get();
        return view('all-post', ['posts' => $post]);
    }

    public function deletePost(Post $post, Request $request)
    {
        // Check if user owns the post
        if (auth()->check() && auth()->user()->id === $post->user_id) {
            $post->delete();

            // If the request came from JavaScript/AJAX, return JSON success
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Post deleted successfully']);
            }
        }

        // Fallback for regular requests
        return redirect('/');
    }

    // public function deletePost(Post $post, Request $request)
    // {
    //     if (auth()->user()->id === $post['user_id']) {
    //         $post->delete();
    //     }

    //     return redirect('/');
    // }

    public function actuallyUpdatePost(Post $post, Request $request)
    {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        // Generate unique slug for updates (excluding current post ID)
        $slug = Str::slug($incomingFields['title']);
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $incomingFields['slug'] = $slug;

        $post->update($incomingFields);

        return redirect('/');
    }

    public function showEditScreen(Post $post)
    {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);

        // Generate unique slug for new posts
        $slug = Str::slug($incomingFields['title']);
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $incomingFields['slug'] = $slug;

        $incomingFields['body'] = Purifier::clean(
            $incomingFields['body'],
            [
                'HTML.Allowed' => 'h1,h2,h3,h4,h5,h6,p,br,strong,b,i,em,u,ul,ol,li,a[href|title],div,span',
            ]
        );

        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);

        return redirect(route('all-post'));
    }

    public function show(Post $post)
    {
        return view('single-post', compact('post'));
    }
}
