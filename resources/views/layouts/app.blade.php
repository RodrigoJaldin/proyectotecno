<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Burger Match</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.5.1/css/bootstrap.min.css">

    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.5.1/js/bootstrap.min.js"></script>



    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    @yield('css')
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Bienvenid@! {{ auth()->user()->name }}</h3>

            </div>
            <div align="center">
                    @if (!empty(auth()->user()->foto_user))
                        <img src="{{ auth()->user()->foto_user }}" alt="Foto de perfil" class="rounded-circle" style="width: 120px; height: 120px;">
                    @else
                        <i class="fas fa-user-circle" style="font-size: 120px;"></i>
                    @endif
                </div>
            @if (auth()->user()->rol->tipo_rol === 'Gerente')
                <ul class="list-unstyled components">
                    <p></p>
                    <li class="active">
                        <a href="sucursal"><i class="fas fa-building"></i> Sucursales</a>
                        <a href="rol"><i class="fas fa-user-cog"></i> Roles</a>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-users"></i> Usuarios
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="{{ route('gerente') }}"><i class="fas fa-user-tie"></i> Gerente</a>
                            </li>
                            <li>
                                <a href="{{ route('jefesCocina') }}"><i class="fas fa-chef"></i> Jefes de Cocina</a>
                            </li>
                            <li>
                                <a href="{{ route('jefesCaja') }}"><i class="fas fa-cash-register"></i> Jefes de Caja</a>
                            </li>
                            <li>
                                <a href="{{ route('jefesAlmacen') }}"><i class="fas fa-warehouse"></i> Jefes de Almacén</a>
                            </li>
                            <li>
                                <a href="{{ route('encargadosPlancha') }}"><i class="fas fa-user-hard-hat"></i> Encargados de Plancha</a>
                            </li>
                            <li>
                                <a href="{{ route('auxiliaresCocina') }}"><i class="fas fa-user-check"></i> Auxiliar de Cocina</a>
                            </li>
                            <li>
                                <a href="{{ route('cajeros') }}"><i class="fas fa-cash-register"></i> Cajero</a>
                            </li>
                            <li>
                                <a href="{{ route('limpieza') }}"><i class="fas fa-broom"></i> Limpieza</a>
                            </li>
                        </ul>

                        <li>
                            <a href="asistencia"><i class="far fa-calendar-check"></i> Asistencias</a>
                            <a href="horario"><i class="far fa-clock"></i> Horarios</a>
                            <a href="documento"><i class="far fa-file-alt"></i> Documentos</a>
                            <a href="licencia"><i class="far fa-id-card"></i> Licencias</a>
                        </li>
                        <li class="">
                            <a  id="link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                </ul>
                @else
                <ul class="list-unstyled components">
                    <li>
                        <a href="asistencia"><i class="far fa-calendar-check"></i> Asistencias</a>
                        <a href="documento"><i class="far fa-file-alt"></i> Documentos</a>

                    </li>
                    {{-- <li>
                        <a href="licencia">Licencias</a>
                    </li> --}}
                    <li class="">
                        <a id="link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif

            </ul>
            </ul>


        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" id="modo-normal-btn">Modo Normal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="nodo-nino-btn">Nodo Niñ@</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Modo Joven</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Modo adulto</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                @yield('content')
            </div>

        </div>
    </div>
    @yield('js')

    <script src={{{ asset('js/darkmode.js') }}}></script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

<script src={{{ asset('js/thememodes.js') }}}></script>




</body>

</html>
