<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRUD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Register User</h2>

            @auth
                <p>Congrats you are logged in</p>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Log Out</button>
                </form>

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
                        <h2 class="fw-bold mb-1">All Posts</h2>
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
                <!-- Create / Update Form -->
                <div class="card mb-4">
                    <div class="card-header">Add User</div>
                    <div class="card-body">
                        <form id="userForm" action="/register" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter name" required autocomplete="name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter email" required autocomplete="new-email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter password" required autocomplete="new-password">
                            </div>

                            <button type="submit" id="submitBtn" class="btn btn-primary">Save User</button>
                            <button type="reset" class="btn btn-secondary" onclick="resetForm()">Clear</button>
                        </form>
                    </div>
                </div>

                <h2 class="mb-4">Login User</h2>
                <!-- Login -->
                <div class="card mb-4">
                    <div class="card-header">Login User</div>
                    <div class="card-body">
                        <form id="loginForm" action="/login" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="loginName" class="form-label">Name</label>
                                <input type="text" name="loginName" id="loginName" class="form-control"
                                    placeholder="Enter name" required autocomplete="name">
                            </div>

                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" name="loginPassword" id="loginPassword" class="form-control"
                                    placeholder="Enter password" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            @endauth


            <!-- Read Table -->
            {{-- <div class="card">
                <div class="card-header">User List</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="userTable"></tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>


    {{-- <script>
        let users = [];
        let nextId = 1;

        const form = document.getElementById('userForm');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('userId').value;
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();

            if (id) {
                users = users.map(user =>
                    user.id === Number(id) ? {
                        id: Number(id),
                        name,
                        email,
                        phone
                    } :
                    user
                );
            } else {
                users.push({
                    id: nextId++,
                    name,
                    email,
                    phone
                });
            }

            renderUsers();
            resetForm();
        });

        function renderUsers() {
            const table = document.getElementById('userTable');
            table.replaceChildren();

            users.forEach(user => {
                const row = document.createElement('tr');

                [user.id, user.name, user.email, user.phone].forEach(value => {
                    const cell = document.createElement('td');
                    cell.textContent = value;
                    row.appendChild(cell);
                });

                const actions = document.createElement('td');

                const editBtn = document.createElement('button');
                editBtn.className = 'btn btn-warning btn-sm me-2';
                editBtn.textContent = 'Edit';
                editBtn.addEventListener('click', () => editUser(user.id));

                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'btn btn-danger btn-sm';
                deleteBtn.textContent = 'Delete';
                deleteBtn.addEventListener('click', () => deleteUser(user.id));

                actions.append(editBtn, deleteBtn);
                row.appendChild(actions);
                table.appendChild(row);
            });
        }

        function editUser(id) {
            const user = users.find(user => user.id === id);
            if (!user) return;

            document.getElementById('userId').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('phone').value = user.phone;
            document.getElementById('submitBtn').textContent = 'Update User';

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function deleteUser(id) {
            if (!confirm('Are you sure you want to delete this user?')) return;

            users = users.filter(user => user.id !== id);
            renderUsers();
            resetForm();
        }

        function resetForm() {
            form.reset();
            document.getElementById('userId').value = '';
            document.getElementById('submitBtn').textContent = 'Save User';
        }
    </script> --}}

</body>

</html>
