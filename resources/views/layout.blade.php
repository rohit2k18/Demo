<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Trezix Product" />
    <meta name="keywords" content="Trezix Product">

    <title>Trezix Products</title>
    <link rel="shortcut icon" href="/storage/app/public/image/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" integrity="sha512-ZbehZMIlGA8CTIOtdE+M81uj3mrcgyrh6ZFeG33A4FHECakGrOsTPlPQ8ijjLkxgImrdmSVUHn1j+ApjodYZow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white !important;
        }
    </style>
</head>

<body class="lightbody" id="body">

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                <li class="active">
                    <a href="{{route('dashboard')}}" class="dashboard"><span class="fa-stack fa-lg pull-left me-3"><i class="fa-solid fa-house"></i></span><span class="menu_text">Dashboard</span></a>
                </li>
                <li class="active">
                    <a href="{{route('products.index')}}" class="products"><span class="fa-stack fa-lg pull-left me-3"><i class="fa-solid fa-box"></i></span><span class="menu_text">Products</span></a>
                </li>
                @can('isAdmin')
                <li class="active">
                    <a href="{{route('users.index')}}" class="users"><span class="fa-stack fa-lg pull-left me-3"><i class="fa-solid fa-user"></i></span><span class="menu_text">Users</span></a>
                </li>
                @endcan

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-default no-margin shadow lightnav fixed-top" id="navs">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand">

                    <a class="navbar-brand" href="#"><img src="/storage/image/logo4.png" style="width:75%" height="35" alt="Dummy Logo"></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle">
                        <i class="fa-solid fa-minimize"></i>
                    </button>
                </div>
                <!-- navbar-header-->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                            </button>
                        </li>
                    </ul>
                </div>
                <!-- bs-example-navbar-collapse-1 -->

                <div class="toptitle mt-2">
                    <h5 id="toptitle"></h5>
                </div>
                <div class=" align-items-end pe-3">
                    <span class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="/storage/image/user.png" alt="User" height="25" class="rounded-circle"> <span id="usrname" class="ms-2">{{Auth::user()->name}}</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('logout')}}">Logout <i class="fa-solid fa-arrow-right"></i></a></li>
                        </ul>
                    </span>
                </div>

            </nav>
            <div class="container-fluid xyz">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <footer class="footer lightnav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 footer-copyright d-flex flex-wrap align-items-center justify-content-end">
                    <p class="mb-0 f-w-600">Copyright {{date("Y")}} &copy; Trezix Product </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- /#wrapper -->
    <!-- jQuery -->

    <script src="{{asset('js/lazysizes.min.js')}}" async=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Latest compiled JavaScript -->
    <script src="{{asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js" integrity="sha512-lVkQNgKabKsM1DA/qbhJRFQU8TuwkLF2vSN3iU/c7+iayKs08Y8GXqfFxxTZr1IcpMovXnf2N/ZZoMgmZep1YQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script>
        if (window.innerWidth < 768) {
            $('.smallphone').addClass('d-flex');
            $('.smallphone').show();
            $('.bigphone').removeClass('d-flex');
            $('.bigphone').hide();
        } else {
            $('.bigphone').addClass('d-flex');
            $('.smallphone').removeClass('d-flex');
            $('.smallphone').hide();
            $('.bigphone').show();
        }
        if (window.innerWidth < 425) {
            $('.ndiv').removeClass('ps-4');
            $('.ndiv').removeClass('pe-4');

        }
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        $("#menu-toggle-2").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled-2");
            $('#menu ul').hide();
        });

        function initMenu() {
            $('#menu ul').hide();
            $('#menu ul').children('.current').parent().show();
            //$('#menu ul:first').show();
            $('#menu li a').click(
                function() {
                    var checkElement = $(this).next();
                    if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        $('#menu ul:visible').slideDown('normal');
                        checkElement.slideUp('normal');
                        return false;
                    }
                    if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#menu ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                        return false;
                    }
                }
            );
        }
        $(document).ready(function() {
            initMenu();
        });
    </script>
</body>

</html>