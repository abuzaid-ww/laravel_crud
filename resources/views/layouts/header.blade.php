<header class="position-sticky top-0 z-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">

            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="/">Navbar</a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Menu -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarMenu" aria-labelledby="navbarMenuLabel">

                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarMenuLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">

                    <!-- Navigation Links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="{{route('all-post')}}">All Post</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('products.index') ?>">Products</a>
                        </li>


                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Menu
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else</a></li>
                            </ul>
                        </li>


                    </ul>

                    <!-- Search Form -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

                        <button class="btn btn-outline-primary" type="submit">
                            Search
                        </button>
                    </form>

                    @auth
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-subtle text-primary rounded-circle p-2 ms-5 me-1 d-flex align-items-center justify-content-center"
                                style="width: 40px;height: 40px">
                                <i class="fw-bold">
                                    {{strtoupper(substr(auth()->user()->name, 0,1))}}
                                </i>
                            </div>
                            <span class="text-primary">
                                {{ auth()->user()->name }}
                            </span>
                        </div>
                        <form action="/logout" method="POST" class="ms-5">
                            @csrf
                            <button class="btn btn-danger" type="submit">Log Out</button>
                        </form>
                    @endauth

                </div>
            </div>
        </div>
    </nav>
</header>
