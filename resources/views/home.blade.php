@extends('layouts.app-landing')

@section('content')
<main>
    <section id="home" class="d-flex align-items-center position-relative vh-100 cover hero"
        style="background-image:url('{{ asset('img/wallmobility.jpg') }}');">
        <div class="container-fluid container-fluid-max">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <h1 class="text-white">MOVILIDAD BASADA EN PERSONAS</h1>
                    <div class="mt-3">
                        <a class="btn bg-red text-white mr-2 ft-s-2 p-3" href="" role="button">PROBAR EL DEMO DE
                            DRAIV</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="our-platform" class="our-platform">
        <div class="container-fluid container-fluid-max">
            <div class="row text-center py-5 ft-s-1">
                <div class="col-12 pb-4">
                    <h2 class="text-darkblue">TODA SU FLOTA A UN CLICK DE DISTANCIA</h2>
                </div>
                <div class="col-12 fira-s-regular">
                    <span>
                        La primera solución diseñada para permitir la toma de decisiones gerenciales asertivas mediante
                        la centralización, el almacenamiento, el analizar y la gestión en tiempo real los datos de sus
                        conductores y vehículos.
                    </span>
                    <p class="mt-1">Olvídese del desorden documental, aumente la velocidad de captura de datos,
                        visualice, analice y extraiga información para poder tomar de decisiones acertivas. DRAIV es un
                        sistema de validación y verificación de datos que le permitirá tener el control en tiempo real
                        en cuanto a los estados y riesgos de sus conductores.</p>
                    <p class="mt-1">Nuestro compromiso va más allá de la gestión de información, por eso ofrecemos
                        soluciones relacionadas a mejorar y profesionalizar sus conductores, detectando fortalezas y
                        debilidades por medio de un programa de certificación, el cual asegura una reducción de
                        accidentalidad de hasta el 90%. Con nuestros servicios de nivel empresarial tendrá el poder de
                        tomar decisiones para administrar y prevenir riesgos en su negocio.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="solutions" class="solutions bg-lightgrey">
        <div class="container-fluid container-fluid-max">
            <div class="row text-center py-5 ft-s-1">
                <div class="col-12">
                    <h1>Pricing Table</h1>
                    <p>Curabitur blandit tempus porttitor. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et.</p>
                </div>
                <div class="col-12">
                    <table id="price_table">

                        <colgroup></colgroup>
                        <colgroup></colgroup>
                        <colgroup></colgroup>
                        <colgroup></colgroup>

                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>
                                    <h2>Premium</h2>
                                    <p>$ 89.95</p>
                                </th>
                                <th>
                                    <h2>Plus</h2>
                                    <p>$ 49.95</p>
                                    <p class="promo">Our most valuable package!</p>
                                </th>
                                <th>
                                    <h2>Basic</h2>
                                    <p>$ 19.95</p>
                                </th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <td><a href="#">Start a free trial</a></td>
                                <td><a href="#">Start a free trial</a></td>
                                <td><a href="#">Start a free trial</a></td>
                            </tr>
                        </tfoot>

                        <tbody>
                            <tr>
                                <th>Feature "Cras mattis" <span>Cras mattis consectetur purus sit amet fermentum.
                                        Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</span>
                                </th>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>Lorem ipsum dolor sit amet</td>
                            </tr>
                            <tr>
                                <th>Feature "Donec ullamcorper" <span>Donec ullamcorper nulla non metus auctor
                                        fringilla. Etiam porta sem malesuada magna mollis euismod.</span></th>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>Lorem ipsum dolor sit amet</td>
                            </tr>
                            <tr>
                                <th>Feature "Lorem ipsum" <span>Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt.</span></th>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>&mdash;</td>
                            </tr>
                            <tr>
                                <th>Feature "Lorem ipsum" <span>Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                </th>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>&mdash;</td>
                            </tr>
                            <tr>
                                <th>Feature "Lorem ipsum" <span>Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                </th>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>&mdash;</td>
                                <td>&mdash;</td>
                            </tr>
                            <tr>
                                <th>Feature "Lorem ipsum" <span>Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                </th>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td>&mdash;</td>
                                <td>&mdash;</td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about py-5">
        <div class="container-fluid container-fluid-max">
            <div class="row">
                <div class="col-12">
                    <h2 class="pb-3 text-red">Popular Destinations</h2>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="" class="text-white">
                        <figure class="position-relative overflow-hidden">
                            <img class="img-fluid" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/Vienna.jpg"
                                alt="Vienna">
                            <figcaption class="d-flex align-items-center justify-content-center position-absolute">
                                <h3>Vienna</h3>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="" class="text-white">
                        <figure class="position-relative overflow-hidden">
                            <img class="img-fluid"
                                src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/Edinburgh.jpg" alt="Edinburgh">
                            <figcaption class="d-flex align-items-center justify-content-center position-absolute">
                                <h3>Edinburgh</h3>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="" class="text-white">
                        <figure class="position-relative overflow-hidden">
                            <img class="img-fluid"
                                src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/new_york.jpg" alt="New York">
                            <figcaption class="d-flex align-items-center justify-content-center position-absolute">
                                <h3>New York</h3>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="" class="text-white">
                        <figure class="position-relative overflow-hidden">
                            <img class="img-fluid" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/porto.jpg"
                                alt="Porto">
                            <figcaption class="d-flex align-items-center justify-content-center position-absolute">
                                <h3>Porto</h3>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="" class="text-white">
                        <figure class="position-relative overflow-hidden">
                            <img class="img-fluid"
                                src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/manarola.jpg" alt="Manarola">
                            <figcaption class="d-flex align-items-center justify-content-center position-absolute">
                                <h3>Manarola</h3>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <a class="btn bg-red text-white" href="" role="button">More Destinations ↓</a>
                </div>
            </div>

        </div>
    </section>
    <section id="contact" class="py-5 contact bg-lightblue">
        <div class="container-fluid container-fluid-max">
            <div class="row justify-content-center">
                <div class="col-12 col-md-auto py-3 text-center">
                    <h2 class="mb-0 text-darkblue">Ready to start your next journey?</h2>
                    <p class="mb-0 h4 text-red font-weight-normal">Get in touch today!</p>
                </div>
                <div class="col-12 col-md-auto d-flex justify-content-center align-items-center">
                    <a class="btn bg-red text-white font-weight-bold" href="" role="button">
                        REQUEST A QUOTE
                        <i class="ml-1 fas fa-hand-point-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="py-5 contact bg-lightblue">
        <div class="container-fluid container-fluid-max">
            <div class="row justify-content-center">
                <div class="col-12 col-md-auto py-3 text-center">
                    <h2 class="mb-0 text-red">Ready to start your next journey?</h2>
                    <p class="mb-0 h4 text-red font-weight-normal">Get in touch today!</p>
                </div>
                <div class="col-12 col-md-auto d-flex justify-content-center align-items-center">
                    <a class="btn bg-red text-white font-weight-bold" href="" role="button">
                        REQUEST A QUOTE
                        <i class="ml-1 fas fa-hand-point-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection