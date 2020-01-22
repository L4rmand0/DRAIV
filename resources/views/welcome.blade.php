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
  <div class="row mt-5">
    <div class="col-md-12">
      <h1 class="my-4 mt-5 text-center" style="font-size: 4em;">Soluciones</h1>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-md-12" style="text-align: justify;">
      <p style="font-size: 1.42em; color: #7D7D7D;">DRAIV desarrolla soluciones tecnológicas específicamente diseñadas
        para centralizar, almacenar, analizar y gestionar los datos de conductores-vehículos. Con DRAIV olvídese del
        desorden documental, aumente la velocidad de captura de datos, visualice, analice y extraiga información para la
        correcta toma de decisiones. DRAIV le ofrece un sistema de validación y verificación de datos que le permitirá
        tener el control en cuanto a los estados y riesgos de sus conductores. Nuestro compromiso va más haya de la
        gestión de información, por ello DRAIV ofrece soluciones relacionadas a mejorar y profesionalizar sus
        conductores, detectando fortalezas y debilidades por medio de un programa de certificación, el cual asegura una
        reducción de accidentalidad de hasta el 90%. Con nuestros servicios de nivel empresarial tendrá el poder de
        tomar decisiones para administrar y prevenir riesgos en su negocio.</p>
    </div>
  </div>
  <h1 class="my-4 mt-5">Productos</h1>
  <div class="row">
    <div class="col-lg-12">
      <p style="font-size: 1.12em; color: #7D7D7D;">Nuestra plataforma web permite capturar y ordenar información relacionada a conductor-vehiculo de forma
        eficiente, permitiendo visualizar y analizar la data de forma sencilla, permitiendo que nuestros usuarios
        visualicen y prevengan problemas, favoreciendo la correcta toma de decisiones orientada a evitar riesgos en el
        negocio.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/dashboard.png') }}"
            style="padding-bottom: 1em;padding-top: 3em;padding-left: 8em;padding-right: 8em;" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Tablero de administración</a>
          </h4>
          <p class="card-text mt-2" style="color: #7D7D7D;">Centralice y gestione la información de sus
            conductores-vehículos-documentos de forma rapida y ordenada.</p>
          <a class="text-primary" style="text-decoration: underline; text-align: right;" type="button">Ver mas</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/cloud.png') }}"
            style="padding-bottom: 1em;padding-top: 1em;padding-left: 7em;padding-right: 7em;" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Almacenamiento de documentos digitales</a>
          </h4>
          <p class="card-text" style="color: #7D7D7D;">Asegure su información digital documental en la nube (Imágenes de
            identificación de conductor, licencias, Afiliaciones de salud ...).</p>
          <a class="text-primary" style="text-decoration: underline; text-align: right;" type="button">Ver mas</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/eye.png') }}"
            style="padding-left: 7.2em;padding-right: 7.2em;padding-top: 1em;padding-bottom: 1em;" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Visualización y analisis de datos</a>
          </h4>
          <p class="card-text" style="color: #7D7D7D;">Analice sus datos por empresa o persona, permitiendo prevenir
            riesgos en el negocio.</p>
          <a class="text-primary" style="text-decoration: underline; text-align: right;" type="button">Ver mas</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/extractdata.png') }}"
            style="padding-bottom: 1em;padding-top: 3em;padding-left: 8em;padding-right: 8em;" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Extracción / validación de datos</a>
          </h4>
          <p class="card-text mt-2" style="color: #7D7D7D;">Valide y/o almacene información proveniente de documentación digital.</p>
          <a class="text-primary" style="text-decoration: underline; text-align: right;" type="button">Ver mas</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/bell.png') }}"
            style="padding-bottom: 1em;padding-top: 1em;padding-left: 6em;padding-right: 8em;" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Notificación de alertas</a>
          </h4>
          <p class="card-text" style="color: #7D7D7D;">Alertas automáticas y periódicas para el vencimiento de documentación vehicular.</p>
          <a class="text-primary" style="text-decoration: underline; text-align: right;" type="button">Ver mas</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/tercerosbases.png') }}"
            style="padding-left: 7.2em;padding-right: 7.2em;padding-top: 1em;padding-bottom: 1em;" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Consulta de información a terceros</a>
          </h4>
          <p class="card-text" style="color: #7D7D7D;">Consulte información de terceros en tiempo real  ( Estados de licencia de conducción, otros).</p>
          <a class="text-primary" style="text-decoration: underline; text-align: right;" type="button">Ver mas</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ asset('img/certificate.png') }}"
            style="padding-bottom: 1em;padding-top: 3em;padding-left: 8em;padding-right: 8em;" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#" style="color: #3f454d">Certificación de conductores</a>
          </h4>
          <p class="card-text mt-2" style="color: #7D7D7D;">Profesionalización y certificación de conductores.</p>
          <a class="text-primary" style="text-decoration: underline; text-align: right;" type="button">Ver mas</a>
        </div>
      </div>
    </div>
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