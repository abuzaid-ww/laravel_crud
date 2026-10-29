<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRUD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">User CRUD</h2>

        @auth
        <p>Congrats you are logged in</p>
        
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-danger type="submit">Log Out</button>
        </form>
        @else
            <!-- Create / Update Form -->
            <div class="card mb-4">
                <div class="card-header">Add User</div>
                <div class="card-body">
                    <form id="userForm" action="/register" method="POST">
                        @csrf
                        <input type="hidden" id="userId">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter password" required>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-primary">Save User</button>
                        <button type="reset" class="btn btn-secondary" onclick="resetForm()">Clear</button>
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
