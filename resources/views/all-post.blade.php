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
                    <x-post-card :post="$post" />
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
