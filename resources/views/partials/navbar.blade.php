<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}"> <img src="{{ asset('img/logo.png') }}"
                style="width:124px" alt="Logo Draiv" class="align-self-center"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown" id="products">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownSolutions" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Productos
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownSolutions">
                        <a class="dropdown-item" href="{{ route('admin','dashboard') }}">Dashboard Enterprise</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Soluciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Partner</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('news') }}" id="navbarDropdownBlog"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Noticias
                    </a>
                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                        <a class="dropdown-item" href="{{ route('news') }}">Draiv</a>
                    <a class="dropdown-item" href="{{ route('news') }}">Conductores</a>
                    <a class="dropdown-item" href="{{ route('news') }}">Tecnología</a>
        </div> --}}
        </li>
        <li class="nav-item" id="drivers">
            <a class="nav-link" href="{{ route('dataconductores') }}">Conductores</a>
        </li>
        <li class="nav-item" id="about">
            <a class="nav-link" href="{{ route('about') }}">Nosotros</a>
        </li>
        <li class="nav-item" id="contact_us">
            <button class="btn nav-link"
                style="color: #fff; border-radius: 3em;border: 0.8px solid #343a40; padding: 0.7em; background: linear-gradient(90deg, #57C6D7, #687F8B );"
                data-toggle="modal" data-target="#modal_contact_us">Contáctanos</button>
            {{-- <a class="nav-link btn btn-primary" href="{{ route('about') }}">Contáctenos</a> --}}
        </li>

        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
        </ul>
        </li>
    </div>
    </div>
</nav>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    id="modal_contact_us">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header"> --}}
                <div class="row mr-2 mt-3">
                    <div class="col-lg-11">
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 1.4em;">&times;</span>
                        </button>
                    </div>
                </div>
            {{-- </div> --}}
            <div class="row mb-5 mr-4 ml-4">
                <div class="col-lg-4 mt-2">
                    <h5 class="">¿Cómo podemos ayudarte?</h5>
                    <p class="mt-3" style="text-align: justify;">Si deseas obtener información sobre los productos de
                        DRAIV ponte en contaćto con nosotros.</p>
                </div>
                <div class="col-lg-8 mt-2">
                    <div class="container">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="name">Nombre*</label>
                                    <input class="form-control" type="text" name="name" id="name">
                                </div>
                                <div class="col-lg-6">
                                    <label for="lastname">Apellido*</label>
                                    <input class="form-control" type="text" name="lastname" id="lastname">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <label for="name">Compañía*</label>
                                    <input class="form-control" type="text" name="name" id="name">
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label for="lastname">Correo*</label>
                                    <input class="form-control" type="text" name="lastname" id="lastname">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-2">
                                    <label for="name">Mensaje*</label>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="form-control" name="" id="" cols="40" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 mt-4">
                                    <input class="btn" type="submit" value="Enviar" id="btn_contact_us"
                                        style="border-radius: 3em; border: gray 0.8px solid; width: 100%;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>