<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!--Import Google Icon Font-->
    <link type="text/css" rel="stylesheet" href="{{ generateURL('public/css/materialize.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ generateURL('public/css/style.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ generateURL('public/css/jquery.dataTables.min.css') }}"/>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>SICOL | @yield('title')</title>
</head>
<body>
<ul id="slide-out" class="side-nav">
    <div class="tarjeta">Menú</div>
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header">
                <blockquote>REGISTROS</blockquote>
            </div>
            <div class="collapsible-body">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header">Boletines</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('boletines.verboletin') }}" class="collection-item blue-text text-darken-4">Consultar Boletin Estudiante</a>
                                <a href="{{ route('boletines.verboletinxcurso') }}" class="collection-item blue-text text-darken-4">Imprimir Boletines de Curso</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Estudiante</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('estudiante.verestudiante') }}" class="collection-item blue-text text-darken-4">Consultar Estudiante</a>
                                <a href="{{ route('estudiante.verestudiantexcurso') }}" class="collection-item blue-text text-darken-4">Estudiante. x Curso</a>
                                <a href="{{ route('estudiante.registrar_estudiante') }}" class="collection-item blue-text text-darken-4">Registrar Estudiante</a>
                                <a href="{{ route('estudiante.upload_estudiante') }}" class="collection-item blue-text text-darken-4">Subir Estudiante - Plantilla</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Notas</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('notas.vernotaestudiante') }}" class="collection-item blue-text text-darken-4">Estudiante</a>
                                <a href="{{ route('notas.vernotacurso') }}" class="collection-item blue-text text-darken-4">Curso</a>
                                <a href="{{ route('notas.ver_excel') }}" class="collection-item blue-text text-darken-4">Subir Nota</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Matricula</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('matricula.registrar_matricula') }}" class="collection-item blue-text text-darken-4">Registrar Matricula</a>
                                <a href="{{ route('matricula.upload_matricula') }}" class="collection-item blue-text text-darken-4">Subir Plantilla</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Observaciones</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('observaciones.ver_observacionesxestudiante') }}" class="collection-item blue-text text-darken-4">Ver Observaciones Academicas x Estudiante</a>
                                <a href="{{ route('observaciones.upload_observacion') }}" class="collection-item blue-text text-darken-4">Subir Plantilla</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Disciplina</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('disciplina.ver_disciplinaxestudiante') }}" class="collection-item blue-text text-darken-4">Ver Observaciones Disciplinarias x Estudiante</a>
                                <a href="{{ route('disciplina.upload_disciplina') }}" class="collection-item blue-text text-darken-4">Subir Plantilla</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Fallas</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('fallas.ver_fallasxestudiante') }}" class="collection-item blue-text text-darken-4">Ver fallas por Estudiante</a>
                                <a href="{{ route('fallas.ver_fallasxcurso') }}" class="collection-item blue-text text-darken-4">Ver fallas por Curso</a>
                                <a href="{{ route('fallas.upload_fallas') }}" class="collection-item blue-text text-darken-4">Subir Plantilla</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <blockquote>BIENESTAR</blockquote>
            </div>
            <div class="collapsible-body">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header">Consultas</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('bienestar.ver_registros') }}" class="collection-item blue-text text-darken-4">Buscar registros estudiante</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Formatos</div>
                        <div class="collapsible-body">
                            <div class="collection">
                                <a href="{{ route('bienestar.registrar_ausencia') }}" class="collection-item blue-text text-darken-4">Registrar Ausencia</a>
                                <a href="{{ route('bienestar.registrar_visita') }}" class="collection-item blue-text text-darken-4">Registrar Visita</a>
                                <a href="{{ route('bienestar.registrar_compromiso') }}" class="collection-item blue-text text-darken-4">Registrar Compromiso</a>
                                <a href="{{ route('bienestar.registrar_conflicto') }}" class="collection-item blue-text text-darken-4">Registrar Mediacion Conflicto</a>
                                <a href="{{ route('bienestar.registrar_citacion') }}" class="collection-item blue-text text-darken-4">Registrar Citación</a>
                                <a href="{{ route('bienestar.registrar_sesion') }}" class="collection-item blue-text text-darken-4">Registrar Sesión Bienestar</a>
                                <a href="{{ route('bienestar.registrar_entrevista') }}" class="collection-item blue-text text-darken-4">Registrar Entrevista</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</ul>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper" >
            <a class="brand-logo center" href="{{ route('home') }}">
                SICOL | @yield('title')
            </a>
             @if (!Auth::guest())
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="#" data-activates="slide-out" class="button-collapse">Menú</a></li>
                </ul>
                <ul id="dropdown1" class="dropdown-content">

                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </ul>
            @endif
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @if (Auth::guest())

                @else
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
                @endif
            </ul>
        </div>
    </nav>
       
        
    </div>
    <div id="content">
        @yield('contenido')
    </div>
    <br><br><br><br>

    <!--Import jQuery before materialize.js-->
    <script language="JavaScript" type="text/javascript" src="{{ generateURL('public/js/jquery-1.12.4.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ generateURL('public/js/funciones.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ generateURL('public/js/materialize.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ generateURL('public/js/jquery.dataTables.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ generateURL('public/js/xlsx.core.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ generateURL('public/js/FileSaver.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ generateURL('public/js/tableexport.js') }}"></script>

    <footer class="page-footer">
        <center>
            <p class="grey-text text-lighten-4">© 2019 Copyright - Desarollado por FullCodeSolutions</p>
        </center>
    </footer>
    
</body>
</html>