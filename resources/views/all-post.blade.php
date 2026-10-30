@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            {{-- redner all the post --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">All Posts</h2>
                    <p class="text-muted mb-0">Explore the latest posts</p>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    {{ count($posts) }} Posts
                </span>
            </div>

            <div class="row g-4">
                @foreach ($posts as $post)
                    {{-- {{dd($post) }} --}}
                    {{-- {{dump($posts);}} --}}

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4">
                            <div class="card-body p-4 d-flex flex-column">

                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">

                                        <div class="bg-primary-subtle text-primary rounded-3 p-2 me-3">
                                            <i class="fw-bold">P</i>
                                        </div>
                                        <span class="text-muted small">Post</span>
                                    </div>
                                    <div>
                                        By <span class="text-primary">
                                            {{ $post->user->name }}
                                        </span>
                                    </div>
                                </div>

                                <h5 class="card-title fw-bold mb-3">
                                    {{ $post['title'] }}
                                </h5>

                                <p class="card-text text-secondary mb-4" style="white-space: pre-line;">
                                    {{ $post['body'] }}
                                </p>

                                <div class="mt-auto pt-3 border-top">
                                    <span class="text-muted small">
                                        <span class="text-primary">●</span>
                                        Published post
                                    </span>
                                </div>
                                @if (auth()->check() && auth()->user()->id == $post['user_id'])
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="/edit-post/{{ $post->id }}"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                            <i class="me-1">✎</i> Edit Post
                                        </a>

                                        <form action="/delete-post/{{ $post->id }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this post?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4">
                                                <i class="me-1">🗑</i> Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (count($posts) === 0)
                <div class="text-center py-5">
                    <h5 class="text-muted">No posts yet</h5>
                    <p class="text-secondary mb-0">
                        Create your first post to see it here.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
