<div class="col-12 col-md-6 col-lg-4" id="post-container-{{ $post->id }}">
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

            <div class="card-text mb-4">
                {!! $post['body'] !!}
            </div>

            <div class="mt-auto pt-3 border-top">
                <span class="text-muted small">
                    <span class="text-primary">●</span>
                    Published post
                </span>
            </div>
            <div class="d-flex gap-2 mt-3">
                <a href="/edit-post/{{ $post->id }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                    <i class="me-1">✎</i> Edit Post
                </a>

                <button type="button" onclick="deletePost({{ $post->id }})"
                    class="btn btn-outline-danger btn-sm rounded-pill px-4" id="delete-btn-{{ $post->id }}">
                    <i class="me-1">🗑</i> Delete
                </button>
            </div>

            <a href="{{ route('post.show', $post->slug ?? $post->id) }}"
                class="btn btn-primary btn-sm rounded-pill px-4 py-2 shadow-sm mt-3">
                Read More <i class="ms-1">→</i>
            </a>
        </div>
    </div>
</div>
