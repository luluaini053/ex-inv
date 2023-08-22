<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory IT | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
    <div class="main d-flex flex-column justify-content-between">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Inventory IT</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarTogglerDemo03">
                        @if (Auth::user())
                            @if (Auth::user()->role_id == 1)
                                {{--<li>
                                    <a href="#">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#">Inventory</a>
                                </li>
                                <li>Categories</li>
                                <li>Users</li>
                                <li>Inventory Log</li>
                                <li>LogOut</li>--}}
                                <a href="/dashboard" @if(request()->route()->uri == 'dashboard') class='active' @endif>Dashboard</a>
                                <a href="/" @if(request()->route()->uri == '/') class='active' @endif>Inventory List</a>
                                <a href="/inventory" @if(request()->route()->uri == 'inventory' || request()->route()->uri == 'inv-add' || request()->route()->uri == 'inv-delete/{slug}' || request()->route()->uri == 'inv-deleted' || request()->route()->uri == 'inv-edit/{slug}') class='active' @endif>Inventory</a>
                                <a href="/categories" @if(request()->route()->uri == 'categories' || request()->route()->uri == 'category-add' || request()->route()->uri == 'category-delete/{slug}' || request()->route()->uri == 'category-deleted' || request()->route()->uri == 'category-edit/{slug}') class='active' @endif>Categories</a>
                                <a href="/users" @if(request()->route()->uri == 'users' || request()->route()->uri == 'registered-users' || request()->route()->uri == 'user-detail/{slug}' || request()->route()->uri == 'user-banned/{slug}' || request()->route()->uri == 'user-banned-list')class='active' @endif>Users</a>
                                <a href="/inventoryLog" @if(request()->route()->uri == 'inventoryLog') class='active' @endif>Inventory Log</a>
                                <a href="/inv-rent" @if(request()->route()->uri == 'inv-rent') class='active' @endif>Peminjaman Barang</a>
                                <a href="/inv-return" @if(request()->route()->uri == 'inv-return') class='active' @endif>Pengembalian Barang</a>
                                <a href="/logout" @if(request()->route()->uri == 'logout') class='active' @endif>LogOut</a>
                            @else
                                {{--<li>Profile</li>
                                <li>LogOut</li>--}}
                                <a href="/profile" @if(request()->route()->uri == 'profile') class='active' @endif>Profile</a>
                                <a href="/" @if(request()->route()->uri == '/') class='active' @endif>Inventory List</a>
                                <a href="/logout" @if(request()->route()->uri == 'logout') class='active' @endif>LogOut</a>

                            @endif

                        @else
                        <a href="/login" @if(request()->route()->uri == 'login') class='active' @endif>Login</a>
                        @endif
                </div>
                <div class=" p-5 content col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
