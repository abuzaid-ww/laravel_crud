<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class PostController extends Controller
{
    public function allPost(Post $post)
    {
        // $post = Post::all();
        $post = Post::latest()->get();
        return view('all-post', ['posts' => $post]);
    }

    public function deletePost(Post $post, Request $request)
    {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
        }

        return redirect('/');
    }

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
}
