<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <section class="py-5">
        <div class="container">
            <a href="/" id="">Home</a>
            <h1>Edit Post</h1>
            <div class="card mb-4">
                <div class="card-header">Edit Post</div>
                <div class="card-body">
                    <form action="/edit-post/{{ $post->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Post title</label>
                            <input type="text" name="title" id="postTitle" class="form-control"
                                placeholder="Enter post title" required value="{{ $post->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="postBody" class="form-label">Post body</label>
                            <textarea name="body" id="postBody" class="form-control" rows="5" placeholder="Write your post" required>{{ $post->body }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Post</button>

                    </form>
                </div>
            </div>

        </div>
    </section>

</body>

</html>
