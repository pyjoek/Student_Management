<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Top Header -->
    <header class="bg-dark text-white text-center py-3">
        <h1>@yield('header')</h1>
    </header>

    <!-- Navbar with Toggle Button for Sidebar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <!-- <a class="navbar-brand color-transparent" href="#">Zanzibar University Management System</a> -->
            <a class="navbar-brand" style="color: transparent;" href="#">Zanzibar University Management System</a>


            <!-- Sidebar Toggle Button for small screens -->
            <button class="btn btn-outline-primary d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse">
                ☰ Menu
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Add right-aligned navbar items if needed -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Layout -->
    <div class="container-fluid">
        <div class="row">

            <!-- Collapsible Sidebar -->
            <div class="collapse d-lg-block col-lg-2 bg-light border-end p-3 min-vh-100" id="sidebarCollapse">
                <aside>
                    <ul class="nav flex-column">
                        @yield('side')
                        
                    </ul>

                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100">Log out</button>
                    </form>
                </aside>
            </div>

            <!-- Main Content -->
            <main class="col-12 col-lg-10 p-4">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
