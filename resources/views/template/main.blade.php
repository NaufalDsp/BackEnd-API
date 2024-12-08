<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    @vite('resources/css/app.css')

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">

    @include('sweetalert::alert')

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link flex items-center pt-3 bg-white" data-toggle="dropdown" href="#">
                        <i class="far fa-bell fa-lg pt-2"></i>
                        <span class="badge badge-warning navbar-badge size-4">15</span>
                    </a>
                </li>
                <li class="sidebar">
                    <div class="user-panel pt-2 pb-1 d-flex">
                        <div class="image">
                            <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block text-black font-semibold"
                                style="color: black;">{{ auth()->user()->name }}</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar ">
            <a href="/dashboard" class=" block text-xl pl-3 font-semibold pt-1 pb-1">
                <span class="text-orange-500 text-4xl">S</span><span class="text-gray-800">lice</span><span class="text-orange-500 text-4xl">B</span><span class="text-gray-800">akery</span>
            </a>

            <div class="sidebar w-48 ">
                <nav class="mt-4">
                    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fa-solid fa-gauge-high"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/barang" class="nav-link">
                                <i class="nav-icon fa-solid fa-box"></i>
                                <p>
                                    Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link">
                                <i class="nav-icon fa-solid fa-box"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tag" class="nav-link">
                                <i class="nav-icon fa-solid fa-box"></i>
                                <p>
                                    Tag
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="log-out ml-3 bg-white" href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-power-off pt-2" style="color: red;"></i>
                                Logout
                                <form action="/logout" method="POST" id="logging-out">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')

        <script src="/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="/assets/dist/js/adminlte.min.js"></script>
        @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(function() {
                var url = window.location;
                // for single sidebar menu
                $('ul.nav-sidebar a').filter(function() {
                    return this.href == url;
                }).addClass('active');

                // for sidebar menu and treeview
                $('ul.nav-treeview a').filter(function() {
                        return this.href == url;
                    }).parentsUntil(".nav-sidebar > .nav-treeview")
                    .css({
                        'display': 'block'
                    })
                    .addClass('menu-open').prev('a')
                    .addClass('active');
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#example1').DataTable({
                    responsive: true
                });

            });
        </script>

        <script type="text/javascript">
            $(document).on('click', '#btn-delete', function(e) {
                e.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will not be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7367f0',
                    cancelButtonColor: '#82868b',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        </script>

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

        <script>
            $(".log-out").on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7367f0',
                    cancelButtonColor: '#82868b',
                    confirmButtonText: 'Yes, Log Out !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#logging-out').submit()
                    }
                })
            });
        </script>

</body>

</html>
