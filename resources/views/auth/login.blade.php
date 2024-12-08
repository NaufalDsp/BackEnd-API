<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} </title>
    @vite('resources/css/app.css')

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">


    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

</head>

<body class="hold-transition login-page">

    @include('sweetalert::alert')
    <div class="absolute left-44 ">
        <div class="text-6xl font-bold">
            <span class="text-orange-500 ">S</span><span class="text-gray-800">lice</span><span class="text-orange-500">B</span><span class="text-gray-800">akery</span>
        </div>
    </div>

    <div class="login-box ml-80">

        <div class="card card-outline">
            <div class="card-header text-center font-bold">
                <span class="text-orange-500 text-4xl">S</span><span class="text-gray-800 text-2xl">lice</span><span class="text-orange-500 text-4xl">B</span><span class="text-gray-800 text-2xl">akery</span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Semangat bekerja..</p>
                <form class="needs-validation" novalidate action="/login" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary text-sm">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-7">
                            <button type="submit" class="bg-orange-500 text-white font-bold py-1 w-80 rounded">Sign In</button>
                        </div>
                        <p class="mb-0">
                            <a href="/register" class="text-center pl-2 text-sm bg-white">Belum punya akun? <span class="text-orange-500">daftar</span></a>
                        </p>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <script src="/assets/plugins/jquery/jquery.min.js"></script>

    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>
