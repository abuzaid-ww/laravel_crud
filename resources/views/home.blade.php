@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            @auth

                <h3 class="my-4">Add Post</h3>
                <!-- Add post -->
                <div class="card mb-4">
                    <div class="card-header">Post</div>
                    <div class="card-body">
                        <form id="postForm" action="/create-post" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="postTitle" class="form-label">Post title</label>
                                <input type="text" name="title" id="postTitle" class="form-control"
                                    placeholder="Enter post title" required>
                            </div>

                            <div class="mb-3">
                                <label for="postBody" class="form-label">Post body</label>
                                <textarea name="body" id="postBody" class="form-control" rows="5" placeholder="Write your post" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Post</button>
                        </form>
                    </div>
                </div>

                {{-- redner all the post --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">All Your Posts</h2>
                        <p class="text-muted mb-0">Explore the latest posts</p>
                    </div>
                    <span class="badge bg-primary rounded-pill px-3 py-2">
                        {{ count($posts) }} Posts
                    </span>
                </div>

                <div class="row g-4">
                    @foreach ($posts as $post)
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
            @else
                <div class="container py-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">Welcome!</h2>
                        <p class="text-muted">Create an account or log in to continue.</p>
                    </div>

                    <div class="row justify-content-center g-4">

                        <!-- Register -->
                        <div class="col-lg-5 col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 p-md-5">

                                    <div class="text-center mb-4">
                                        <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width: 60px; height: 60px;">
                                            <i class="bi bi-person-plus fs-3"></i>
                                        </div>
                                        <h4 class="fw-bold">Create Account</h4>
                                        <p class="text-muted small">Join us! It only takes a minute.</p>
                                    </div>

                                    <form id="userForm" action="/register" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-semibold">Full Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control form-control-lg fs-6" placeholder="John Doe" required
                                                autocomplete="name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-semibold">Email Address</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control form-control-lg fs-6" placeholder="you@example.com" required
                                                autocomplete="new-email">
                                        </div>

                                        <div class="mb-4">
                                            <label for="password" class="form-label fw-semibold">Password</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-lg fs-6" placeholder="Create a password"
                                                required autocomplete="new-password">
                                        </div>

                                        <button type="submit" id="submitBtn"
                                            class="btn btn-primary btn-lg w-100 fs-6 fw-semibold">
                                            Create Account <i class="bi bi-arrow-right ms-1"></i>
                                        </button>

                                        <button type="reset" class="btn btn-light w-100 mt-2 text-muted">
                                            Clear Form
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- Login -->
                        <div class="col-lg-5 col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 p-md-5">

                                    <div class="text-center mb-4">
                                        <div class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width: 60px; height: 60px;">
                                            <i class="bi bi-box-arrow-in-right fs-3"></i>
                                        </div>
                                        <h4 class="fw-bold">Welcome Back</h4>
                                        <p class="text-muted small">Log in to access your account.</p>
                                    </div>

                                    <form id="loginForm" action="/login" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="loginName" class="form-label fw-semibold">Name</label>
                                            <input type="text" name="loginName" id="loginName"
                                                class="form-control form-control-lg fs-6" placeholder="Enter your name"
                                                required autocomplete="name">
                                        </div>

                                        <div class="mb-4">
                                            <label for="loginPassword" class="form-label fw-semibold">Password</label>
                                            <input type="password" name="loginPassword" id="loginPassword"
                                                class="form-control form-control-lg fs-6" placeholder="Enter your password"
                                                required autocomplete="new-password">
                                        </div>

                                        <button type="submit" class="btn btn-success btn-lg w-100 fs-6 fw-semibold">
                                            Login <i class="bi bi-box-arrow-in-right ms-1"></i>
                                        </button>
                                    </form>

                                    <div class="text-center mt-4">
                                        <small class="text-muted">
                                            Don't have an account? Create one using the form on the left.
                                        </small>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @push('styles')
                    <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                @endpush
            @endauth

        </div>
    </section>
@endsection
