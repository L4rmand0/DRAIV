<!-- Navigation -->
@extends('layouts.app')
@section('content')
<!-- Page Content -->
<div class="container">
  <!-- Intro Content -->
  <div class="row mb-2">
    <div class="col-lg-4 mt-5">
      <h5>Nuestra historia</h5>
      <h3>Administración y Análisis de Datos de Conductores</h2>
    </div>
    <div class="col-lg-8 mt-5" style="text-align: justify;">
      <p>Compañía fundada en 2019 que se enfoca en la captura, procesamiento, administración y visualización de
        datos relacionados con la profesión de conductor. Nuestro core se encuentra orientado hacia conductores en lugar
        de vehículos “como tradicionalmente se maneja en el mercado”. Por ello nuestros servicios no solo permiten que
        las empresas tengan un espacio donde puedan agregar e identificar su flota de trabajo, sino que también
        evaluamos a los conductores de tal forma que caracterizamos fortalezas y debilidades permitiendo implementar
        mejoras y corregir malos hábitos de manejo. Adicionalmente contamos con algoritmos que nos permiten realizar
        validación documental de manera automática, minimizando la incertidumbre en cuanto a la validez de los datos
        suministrados.</p>
      <p> • Las soluciones que brindamos son: Almacenamiento, análisis y visualización de datos relacionados al
        conductor. Validación documental por medio de algoritmos de aprendizaje automático.</p>
      <p> • Caracterización de conductores para el mejoramiento y dignificación de esta importante profesión.</p>
      <p> • Cursos enfocados en conductores con el fin de mejorar y dignificar l profesión del conductor.</p>
    </div>
  </div>
</div>

<div style="background-color: #f8f8f8; width: 100%;">
  <div class="container" style="background-color: #f8f8f8">
    <div class="row pt-5 mb-4 mt-1">
      <h2 class="ml-3">Nuestros líderes</h2>
    </div>
    <div class="row pb-5">
      <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="{{ asset('img/Juan2-2.png') }}" alt="" style="height: 316px;">
          <div class="card-body">
            <h4 class="card-title">Juan Roldan</h4>
            <h6 class="card-subtitle mb-2 text-muted">CEO</h6>
            <p class="card-text" style="text-align: justify;">Empresario e inversionista colombiano, CEO de Smart taxi
              con mas de 6 años de experiencia en el gremio del transporte de personas. Juan fue co-fundador de Mentez
              una empresa de desarrollo de juegos de video enfocados en redes sociales. </p>
          </div>
          {{-- <div class="card-footer">
            <a href="#">name@example.com</a>
          </div> --}}
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="{{ asset('img/German.png') }}" alt="">
          <div class="card-body">
            <h4 class="card-title">Germán Acevedo</h4>
            <h6 class="card-subtitle mb-2 text-muted">Manager</h6>
            <p class="card-text" style="text-align: justify;">Empresario colombiano, Ingeniero Naval con Maestría en
              Automática, director del centro de innovación para motociclistas, precursor del plan de seguridad vial
              nacional laboral el cual estableció un modelo de intervención que es capaz de reducir en más de un 90% los
              índices de siniestralidad (Motos) en las empresas intervenidas.</p>
          </div>
          {{-- <div class="card-footer">
            <a href="#">name@example.com</a>
          </div> --}}
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center">
          <img class="card-img-top" src="{{ asset('img/Daniel.png') }}" alt="">
          <div class="card-body">
            <h4 class="card-title">Daniel Villaveces</h4>
            <h6 class="card-subtitle mb-2 text-muted">Manager</h6>
            <p class="card-text" style="text-align: justify;">Empresario fundador de RAIDE PRO, consultor de innovación
              en movilidad segura, auditor interno ISO 39001:2012 y director de Asuntos Públicos FIM (Federación
              nacional de motociclismo) Latinoamérica. Daniel es un implementador de estrategias en seguridad vial
              enfocado en la mejora continua de conductores.</p>
          </div>
          {{-- <div class="card-footer">
            <a href="#">name@example.com</a>
          </div> --}}
        </div>
      </div>
    </div>

    <!-- /.row -->

    <!-- Our Customers -->
    {{-- <h2>Our Customers</h2>
    <div class="row">
      <div class="col-lg-2 col-sm-4 mb-4">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </div>
      <div class="col-lg-2 col-sm-4 mb-4">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </div>
      <div class="col-lg-2 col-sm-4 mb-4">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </div>
      <div class="col-lg-2 col-sm-4 mb-4">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </div>
      <div class="col-lg-2 col-sm-4 mb-4">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </div>
      <div class="col-lg-2 col-sm-4 mb-4">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </div>
    </div> --}}
    <!-- /.row -->
  </div>
</div>
<!-- /.container -->
@include('partials.footer')

<!-- Bootstrap core JavaScript -->
@endsection