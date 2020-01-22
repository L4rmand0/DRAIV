@extends('layouts.app')
@section('content')

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    {{-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li> --}}
  </ol>
  <div class="carousel-inner" role="listbox">
    <!-- Slide One - Set the background image for this slide in the line below -->
    <div class="carousel-item active" style="background-image: url('{{ asset('img/slide1.jpg') }}')">
      <div class="carousel-caption d-none d-md-block">
        <h3>Administre</h3>
        <p>Administre los datos de conductores.</p>
      </div>
    </div>
    <!-- Slide Two - Set the background image for this slide in the line below -->
    <div class="carousel-item" style="background-image: url('{{ asset('img/logo_draiv-02.png') }}')">
      <div class="carousel-caption d-none d-md-block">
        <h3>Análisis de Datos</h3>
        <p>Tome decisiones de acuerdo al análisis de datos.</p>
      </div>
    </div>
    <!-- Slide Three - Set the background image for this slide in the line below -->
    {{-- <div class="carousel-item" style="background-image: url('{{ asset('img/stock_prueba4.jpg') }}')">
      <div class="carousel-caption d-none d-md-block">
        <h3>Third Slide</h3>
        <p>This is a description for the third slide.</p>
      </div>
    </div> --}}
    <!-- Slide Three - Set the background image for this slide in the line below -->
    {{-- <div class="carousel-item" style="background-image: url('{{ asset('img/slide-1pr.png') }}')">
      <div class="carousel-caption d-none d-md-block">
        <h3>Fourth Slide</h3>
        <p>This is a description for the third slide.</p>
      </div>
    </div> --}}
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</header>
<!-- Page Content -->
<div class="container">
  <h1 class="my-4 mt-5">Productos</h1>
  <div class="row mt-2">
    <div class="col-md-2">  
      <h4>Gestión</h4>
    </div>
    <div class="col-md-10">
      <div class="row">
        <div class="col-md-4">
          <p>Centralice y gestione la información de sus conductores-vehículos.</p>
        </div>
        <div class="col-md-4">
        2
        </div>
        <div class="col-md-4">
        3
        </div>
        {{-- <div class="col-md-2">
        4
        </div>
        <div class="col-md-2">
        5
        </div>
        <div class="col-md-2">
        6
        </div> --}}
      </div>  
    </div>
  </div>
  <h1 class="my-4 mt-5">Administración de Conductores</h1>
  <div class="row">
    <div class="col-lg-12">
      <p>Nuestra plataforma web permite capturar y ordenar información relacionada a conductor-vehiculo de forma
        eficiente, permitiendo visualizar y analizar la data de forma sencilla, permitiendo que nuestros usuarios
        visualicen y prevengan problemas, favoreciendo la correcta toma de decisiones orientada a evitar riesgos en el
        negocio.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/eye-orange.png') }}" style="padding: 4.3em;"
            alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Análisis</a>
          </h4>
          <p class="card-text">Visualice y analice sus datos favoreciendo la correcta toma de decisiones.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/board-orange.png') }}" style="padding: 4.3em;"
            alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Gestión</a>
          </h4>
          <p class="card-text">Administre información relacionada a conductores, vehiculos y documentacion de forma
            eficiente.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/Page-2.png') }}" style="padding-left: 4.3em;padding-right: 4.3em;padding-top: 2.5em;padding-bottom: 2.5em;"
            alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Validación</a>
          </h4>
          <p class="card-text">Valide información documental mediante algoritmos de reconocimiento óptico de caracteres
            OCR.</p>
        </div>
      </div>
    </div>
    {{-- <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/check-orange.png') }}" style="padding: 4.3em;"
            alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Validación</a>
          </h4>
          <p class="card-text">Valide información documental mediante algoritmos de reconocimiento óptico de caracteres
            OCR.</p>
        </div>
      </div>
    </div> --}}
  </div>
  <!-- Marketing Icons Section -->

  {{--<div class="row">
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h4 class="card-header">Gestión</h4>
        <div class="card-body">
          <p class="card-text">Administre información relacionada a conductores, vehiculos y documentacion de forma eficiente.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h4 class="card-header">Validación</h4>
        <div class="card-body">
          <p class="card-text">Valide información documental mediante algoritmos de reconocimiento óptico de caracteres OCR.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h4 class="card-header">Análisis</h4>
        <div class="card-body">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <p class="card-text">Visualice y analice sus datos favoreciendo la correcta toma de decisiones.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
  </div> --}}
  <!-- /.row -->

  <!-- Portfolio Section -->
  {{-- <h2>Portfolio Heading</h2>

  <div class="row">
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project One</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum
            quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum
            tempora ex quae? Nihil, dolorem!</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Two</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio,
            gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Three</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quisquam, error quod sed
            cumque, odio distinctio velit nostrum temporibus necessitatibus et facere atque iure perspiciatis mollitia
            recusandae vero vel quam!</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Four</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio,
            gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Five</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio,
            gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Six</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit
            ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat
            excepturi! Nemo, esse.</p>
        </div>
      </div>
    </div>
  </div> --}}
  <!-- /.row -->

  <!-- Features Section -->
  {{-- <div class="row">
    <div class="col-lg-6">
      <h2>Modern Business Features</h2>
      <p>The Modern Business template by Start Bootstrap includes:</p>
      <ul>
        <li>
          <strong>Bootstrap v4</strong>
        </li>
        <li>jQuery</li>
        <li>Font Awesome</li>
        <li>Working contact form with validation</li>
        <li>Unstyled page elements for easy customization</li>
      </ul>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit,
        quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
    </div>
    <div class="col-lg-6">
      <img class="img-fluid rounded" src="http://placehold.it/700x450" alt="">
    </div>
  </div> --}}
  <!-- /.row -->

  <hr>

  <!-- Call to Action Section -->
  {{-- <div class="row mb-4">
    <div class="col-md-8">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti
        beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
    </div>
    <div class="col-md-4">
      <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
    </div>
  </div> --}}

</div>

@include('partials.footer')
@endsection
<!-- /.container -->