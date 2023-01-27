<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    {{-- bootstrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <!-- As a heading -->
    <nav class="navbar bg-body-tertiary shadow fixed-top">
        <div class="container">
            <a href="/" class="navbar-brand">
                <span class="navbar-brand mb-0 h1">Navbar</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    @auth
                        <a class="nav-link active" href="/logout">
                            <i class="bi bi-box-arrow-left me-1"></i>
                            Keluar
                        </a>
                    @endauth
                    @guest
                        <a class="nav-link active" href="/login">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Masuk
                        </a>
                    @endguest
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row d-flex text-center justify-content-center vh-100 align-items-center">
            <form style="max-width: 25rem" method="POST">
                @if (session('errors'))
                    <div class="alert alert-danger" role="alert">
                        Login gagal, username atau password salah
                    </div>
                @endif
                @csrf
                <h1 class="h3 mb-3 fw-normal">Silahkan Masuk</h1>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Username"
                        name="username">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                        name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
            </form>

        </div>
    </div>

    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
