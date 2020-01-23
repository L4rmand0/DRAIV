@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-group col-lg-12" style="margin-top:90px;">
        <div class="card" id="card_login_register">
            <div id="login_card">
                <h2 class="ml-5 mt-5" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
                    Iniciar sesión en su Cuenta DRAIV</h2>

                <div class="card-body">
                    <label class="text-center mb-2 mt-2 ml-5"
                        style="color: #979797; font-size: 1.2em; font-family: 'Fira Sans', sans-serif;" for="">¿No tiene
                        una cuenta DRAIV? <a
                            style="color:#1A8ED1; cursor: pointer; font-size: 1em; font-family: 'Fira Sans', sans-serif;"
                            id="btn_call_register" class="btn btn-link"> {{ __('Registrarse') }}
                        </a></label>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row ml-4">
                            <label for="email"
                                class="col-md-8 col-form-label text-md-left">{{ __('Correo Electrónico') }}</label>
                        </div>
                        <div class="row ml-4 mr-4">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2 ml-4">
                            <label for="password"
                                class="col-md-8 col-form-label text-md-left">{{ __('Contraseña') }}</label>
                        </div>
                        <div class="row ml-4 mr-4">
                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3 ml-4">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ml-3">
                            <div class="col-md-12">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidó su contaseña?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div id="register_card" hidden>
                <h2 class="ml-5 mt-5" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
                    Regístrese para una Cuenta DRAIV</h2>
                <div class="card-body">
                    <label class="text-center mb-3 mt-2 ml-5"
                        style="color: #979797; font-size: 1.2em; font-family: 'Fira Sans', sans-serif;" for="">¿Ya tiene
                        una cuenta DRAIV? <a
                            style="color:#1A8ED1; cursor: pointer; font-size: 1em; font-family: 'Fira Sans', sans-serif;"
                            id="btn_call_login" class="btn btn-link">
                            {{ __('Iniciar Sesión') }}
                        </a></label>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="Company_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('Compañía') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="Company_id" id="Company_id">
                                <option value="9013380301">DRAIV</option>
                                <option value="9013380302">Smart</option>
                            </select>
                            @error('Company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div> --}}
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div>
                    <div class="custom-control custom-checkbox col-4 col-md-6" style="margin-top: 17px;">
                        <input type="checkbox" name="checkdata"
                            class="custom-control-input @error('checkdata') is-invalid @enderror" id="defaultChecked2">
                        @error('checkdata')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label class="custom-control-label" for="defaultChecked2">Aceptar Términos y
                            condiciones</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div>
                    <a class="" data-toggle="modal" data-target="#data_agree"
                        style="cursor: pointer; text-decoration: underline">Ver política de datos</a>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>

                </form>
            </div>
        </div>

    </div>
    <div class="card col-lg-5" style="background: #EDE6DD;">
        <h2 class="mt-5 text-center" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
            Seleccione
            su plan</h2>
        <div class="card ml-4 mr-4 mt-4 mb-5 border-0">
            {{-- <div class="card-header">c --}}
            <ul class="nav nav-tabs border-0" style="background:#EDE6DD;">
                <li class="nav-item">
                    <a class="nav-link active" id="btn_free_plan"
                        style="color: #4F4F4F; font-weight: 400 !important; background: #fff; cursor: pointer; ">Gratis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_medium_plan"
                        style="color: #4F4F4F; font-weight: 400; background: #EDE6DD; cursor: pointer;">Intermedio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_all_plan"
                        style="color: #4F4F4F; font-weight: 400; background: #EDE6DD; cursor: pointer;">Completo</a>
                </li>
            </ul>
            {{-- </div> --}}
            <div class="card-body" id="free_plan">
                <p class="mt-5 text-center"
                    style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 5em;">
                    0
                    <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong> </p>
                <p class="card-text mt-5" style="text-align: justify;">Gestione y centralice su información. Visualice
                    dato de conductores,
                    vehículos y licencias de conducción.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración
                    de
                    flotas</p>
                <hr class="mt-0">
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 50 Transacciones
                    (Registro
                    Conductores) por mes.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 usuario
                    activo por mes
                </p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis
                    de
                    datos
                    básico. Análisis por persona y empresa.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                <hr class="mt-0">
                <p class="mb-5"> Asistencia para controles básicos: agregar, editar y eliminar información.</p>
            </div>
            <div class="card-body" id="medium_plan" hidden>
                <p class="mt-5 text-center"
                    style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 4.5em;">
                    150.000 <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong>
                </p>
                <p class="card-text mt-5" style="text-align: justify;">Gestione y centralice su información. Visualice
                    datos de conductores, vehículos, licencias de conducción, almacene información documental, valide
                    datos de sus bases de datos vs informacion extraída de sus documentos digilates.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración
                    de
                    flotas</p>
                <hr class="mt-0">
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 100 Transacciones
                    (Registro
                    Conductores) por mes</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 2 usuarios y 5 editores
                </p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis
                    de
                    datos
                    <strong>intermedio</strong> . Análisis por persona y empresa.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 20GB en
                    almacenamientos,
                    carga y descarga de documentos digitales en la nube.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1000 validaciones de
                    documentos digitales
                    contra su base de datos por mes</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> Pague solo por
                    transacción
                    y
                    validación de datos adicional (Registro de conductores)</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                <hr class="mt-0">
                <p> Asistencia para conductores básicos: agrega, editar y eliminar información.</p>
                <p class="mb-5"> Asistencia para agregar y editar permisos: solución de problemas</p>
            </div>
            <div class="card-body" id="all_plan" hidden>
                <p class="mt-5 text-center"
                    style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 4.5em;">
                    210.000 <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong>
                </p>
                <p class="card-text mt-5" style="text-align: justify;">Gestione y centralice su información. Visualice
                    datos de conductores, vehículos, licencias de conducción, almacene información documental, valide
                    datos de sus bases de datos vs información extraída de sus documentos digilates. Consulte datos de
                    terceros en tiempo real (Multas, antecedentes penales).</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración
                    de
                    flotas</p>
                <hr class="mt-0">
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1000 Transacciones
                    (Registro
                    Conductores) por mes.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 5 usuarios
                    administrador y 15 editores
                </p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis
                    de
                    datos
                    <strong>avanzado</strong>  Análisis por persona y empresa.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 300GB de almacenamiento, carga y descarga de documentos digitales en la nube
                </p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 300 validaciones de documentos digitales contra su base de datos
                </p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 300 consultas de información a bases de terceros (multas, antecendentes penales)
                </p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> Pague solo por
                    transacción
                    y
                    validación de datos adicional (Registro de conductores)</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                <hr class="mt-0">
                <p class="mb-5"> Asistencia completa</p>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="data_agree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Política de Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>TÉRMINOS DE SERVICIO</h3>

                <p>----</p>

                <h5>INFORMACIÓN GENERAL</h5>

                <p> Este sitio web es operado por DRAIV. En todo el sitio, los términos “nosotros”, “nos” y “nuestro” se
                    refieren a DRAIV. DRAIV ofrece este sitio web, incluyendo toda la información, herramientas y
                    servicios disponibles para ti en este sitio, el usuario, está condicionado a la aceptación de todos
                    los términos, condiciones, políticas y notificaciones aquí establecidos.</p>

                <p>Al visitar nuestro sitio y/o comprar algo de nosotros, paticipas en nuestro “Servicio” y aceptas los
                    siguientes términos y condiciones (“Términos de Servicio”, “Términos”), incluídos todos los términos
                    y condiciones adicionales y las polítias a las que se hace referencia en el presente documento y/o
                    disponible a través de hipervínculos. Estas Condiciones de Servicio se aplican a todos los usuarios
                    del sitio, incluyendo si limitación a usuarios que sean navegadores, proveedores, clientes,
                    comerciantes, y/o colaboradores de contenido.</p>

                <p>Por favor, lee estos Términos de Servicio cuidadosamente antes de acceder o utilizar nuestro sitio
                    web. Al acceder o utilizar cualquier parte del sitio, estás aceptando los Términos de Servicio. Si
                    no estás de acuerdo con todos los términos y condiciones de este acuerdo, entonces no deberías
                    acceder a la página web o usar cualquiera de los servicios. Si las Términos de Servicio son
                    considerados una oferta, la aceptación está expresamente limitada a estos Términos de Servicio.</p>

                <p>Cualquier función nueva o herramienta que se añadan a la tienda actual, también estarán sujetas a los
                    Términos de Servicio. Puedes revisar la versión actualizada de los Términos de Servicio, en
                    cualquier momento en esta página. Nos reservamos el derecho de actualizar, cambiar o reemplazar
                    cualquier parte de los Términos de Servicio mediante la publicación de actualizaciones y/o cambios
                    en nuestro sitio web. Es tu responsabilidad chequear esta página periódicamente para verificar
                    cambios. Tu uso contínuo o el acceso al sitio web después de la publicación de cualquier cambio
                    constituye la aceptación de dichos cambios.</p>

                <p>Nuestra tienda se encuentra alojada en Shopify Inc. Ellos nos proporcionan la plataforma de comercio
                    electrónico en línea, que nos permite venderte nuestros productos y servicios.</p>

                <h5>SECCIÓN 1 - TÉRMINOS DE CAPTURA DE DATOS EN LINEA</h5>

                <p>Al utilizar este sitio, declaras que tienes al menos la mayoría de edad en tu estado o provincia de
                    residencia, o que tienes la mayoría de edad en tu estado o provincia de residencia y que nos has
                    dado tu consentimiento para permitir que cualquiera de tus dependientes menores use este sitio. </p>

                <p>No puedes usar nuestros productos con ningún propósito ilegal o no autorizado tampoco puedes, en el
                    uso del Servicio, violar cualquier ley en tu jurisdicción (incluyendo pero no limitado a las leyes
                    de derecho de autor).</p>

                <p>No debes transmitir gusanos, virus o cualquier código de naturaleza destructiva.</p>

                <p>El incumplimiento o violación de cualquiera de estos Términos darán lugar al cese inmediato de tus
                    Servicios.</p>

                <h5>SECCIÓN 2 - CONDICIONES GENERALES</h5>

                <p> Nos reservamos el derecho de rechazar la prestación de servicio a cualquier persona, por cualquier
                    motivo y en cualquier momento. </p>

                <p>Entiendes que tu contenido (sin incluir la información de tu tarjeta de crédito), puede ser
                    transferida sin encriptar e involucrar (a) transmisiones a través de varias redes; y (b) cambios
                    para ajustarse o adaptarse a los requisitos técnicosde conexión de redes o dispositivos. La
                    información de tarjetas de crédito está siempre encriptada durante la transferencia a través de las
                    redes.</p>

                <p>Estás de acuerdo con no reproducir, duplicar, copiar, vender, revender o explotar cualquier parte del
                    Servicio, usp del Servicio, o acceso al Servicio o cualquier contacto en el sitio web a través del
                    cual se presta el servicio, sin el expreso permiso por escrito de nuestra parte.</p>

                <p>Los títulos utilizados en este acuerdo se icluyen solo por conveniencia y no limita o afecta a estos
                    Términos.</p>

                <h5>SECCIÓN 3 - EXACTITUD, EXHAUSTVIDAD Y ACTUALIDAD DE LA INFORMACIÓN</h5>

                <p>No nos hacemos responsables si la información disponible en este sitio no es exacta, completa o
                    actual. El material en este sitio es provisto solo para información general y no debe confiarse en
                    ella o utilizarse como la única base para la toma de decisiones sin consultar primeramente,
                    información más precisa, completa u oportuna. Cualquier dependencia en el materia de este sitio es
                    bajo su propio riesgo.</p>

                <p>Este sitio puede contener cierta información histórica. La información histórica, no es necesriamente
                    actual y es provista únicamente para tu referencia. Nos reservamos el derecho de modificar los
                    contenidos de este sitio en cualquier momento, pero no tenemos obligación de actualizar cualquier
                    información en nuestro sitio. Aceptas que es tu responsabilidad de monitorear los cambios en nuestro
                    sitio.</p>

                <h5>SECTION 4 - MODIFICACIONES AL SERVICIO Y PRECIOS</h5>

                <p>Los precios de nuestros productos están sujetos a cambio sin aviso.</p>

                <p>Nos reservamos el derecho de modificar o discontinuar el Servicio (o cualquier parte del contenido)
                    en cualquier momento sin aviso previo.</p>

                <p>No seremos responsables ante ti o alguna tercera parte por cualquier modificación, cambio de precio,
                    suspensión o discontinuidad del Servicio.</p>

                <h5>SECCIÓN 5 - PRODUCTOS O SERVICIOS (si aplicable)</h5>

                <p>Ciertos productos o servicios puedene star disponibles exclusivamente en línea a través del sitio
                    web. Estos productos o servicios pueden tener cantidades limitadas y estar sujetas a devolución o
                    cambio de acuerdo a nuestra política de devolución solamente.</p>

                <p>Hemos hecho el esfuerzo de mostrar los colores y las imágenes de nuestros productos, en la tienda,
                    con la mayor precisión de colores posible. No podemos garantizar que el monitor de tu computadora
                    muestre los colores de manera exacta.</p>

                <p>Nos reservamos el derecho, pero no estamos obligados, para limitar las ventas de nuestros productos o
                    servicios a cualquier persona, región geográfica o jurisdicción. Podemos ejercer este derecho
                    basados en cada caso. Nos reservamos el derecho de limitar las cantidades de los productos o
                    servicios que ofrecemos. Todas las descripciones de productos o precios de los productos están
                    sujetos a cambios en cualquier momento sin previo aviso, a nuestra sola discreción. Nos reservamos
                    el derecho de discontinuar cualquier producto en cualquier momento. Cualquier oferta de producto o
                    servicio hecho en este sitio es nulo donde esté prohibido.</p>

                <p>No garantizamos que la calidad de los productos, servicios, información u otro material comprado u
                    obtenido por ti cumpla con tus expectativas, o que cualquier error en el Servicio será corregido.
                </p>

                <h5>SECCIÓN 6 - EXACTITUD DE FACTURACIÓN E INFORMACIÓN DE CUENTA</h5>

                <p>Nos reservamos el derecho de rechazar cualquier pedido que realice con nosotros. Podemos, a nuestra
                    discreción, limitar o cancelar las cantidades compradas por persona, por hogar o por pedido. Estas
                    restricciones pueden incluir pedidos realizados por o bajo la misma cuenta de cliente, la misma
                    tarjeta de crédito, y/o pedidos que utilizan la misma facturación y/o dirección de envío.</p>

                <p>En el caso de que hagamos un cambio o cancelemos una orden, podemos intentar notificarte poniéndonos
                    en contacto vía correo electrónico y/o dirección de facturación / número de teléfono proporcionado
                    en el momento que se hizo pedido. Nos reservamos el derecho de limitar o prohibir las órdenes que, a
                    nuestro juicio, parecen ser colocado por los concesionarios, revendedores o distribuidores.</p>

                <p>Te comprometes a proporcionar información actual, completa y precisa de la compra y cuenta utilizada
                    para todas las compras realizadasen nuestra tienda. Te comprometes a ctualizar rápidamente tu cuenta
                    y otra información, incluyendo tu dirección de correo electrónico y números de tarjetas de crédito y
                    fechas de vencimiento, para que podamos completar tus transacciones y contactarte cuando sea
                    necesario.</p>

                <p>Para más detalles, por favor revisa nuestra Política de Devoluciones.</p>

                <h5>SECCIÓN 7 - HERRAMIENTAS OPCIONALES</h5>

                <p>Es posible que te proporcionemos acceso a herramientas de terceros a los cuales no monitoreamos y
                    sobre los que no tenemos control ni entrada.</p>

                <p>Reconoces y aceptas que proporcionamos acceso a este tipo de herramientas "tal cual" y "según
                    disponibilidad" sin garantías, representaciones o condiciones de ningún tipo y sin ningún respaldo.
                    No tendremos responsabilidad alguna derivada de o relacionada con tu uso de herramientas
                    proporcionadas por terceras partes.</p>

                <p>Cualquier uso que hagas de las herramientas opcionales que se ofrecen a través del sitio bajo tu
                    propio riesgo y discreción y debes asegurarte de estar familiarizado y aprobar los términos bajo los
                    cuales estas herramientas son proporcionadas por el o los proveedores de terceros.</p>

                <p>También es posible que, en el futuro, te ofrezcamos nuevos servicios y/o características a través del
                    sitio web (incluyendo el lanzamiento de nuevas herramientas y recursos). Estas nuevas caraterísticas
                    y/o servicios tambien estarán sujetos a estos Términos de Servicio.</p>

                <h5>SECCIÓN 8 - ENLACES DE TERCERAS PARTES</h5>

                <p>Cierto contenido, productos y servicios disponibles vía nuestro Servicio puede incluír material de
                    terceras partes.</p>

                <p>Enlaces de terceras partes en este sitio pueden direccionarte a sitios web de terceras partes que no
                    están afiliadas con nosotros. No nos responsabilizamos de examinar o evaluar el contenido o
                    exactitud y no garantizamos ni tendremos ninguna obligación o responsabilidad por cualquier material
                    de terceros o sitios web, o de cualquier material, productos o servicios de terceros.</p>

                <p>No nos hacemos responsables de cualquier daño o daños relacionados con la adquisición o utilización
                    de bienes, servicios, recursos, contenidos, o cualquier otra transacción realizadas en conexión con
                    sitios web de terceros. Por favor revisa cuidadosamente las políticas y prácticas de terceros y
                    asegúrate de entenderlas antes de participar en cualquier transacción. Quejas, reclamos, inquietudes
                    o preguntas con respecto a productos de terceros deben ser dirigidas a la tercera parte.</p>

                <h5>SECCIÓN 9 - COMENTARIOS DE USUARIO, CAPTACIÓN Y OTROS ENVÍOS</h5>

                <p>Si, a pedido nuestro, envías ciertas presentaciones específicas (por ejemplo, la participación en
                    concursos) o sin un pedido de nuestra parte envías ideas creativas, sugerencias, proposiciones,
                    planes, u otros materiales, ya sea en línea, por email, por correo postal, o de otra manera
                    (colectivamente, 'comentarios'), aceptas que podamos, en cualquier momento, sin restricción, editar,
                    copiar, publicar, distribuír, traducir o utilizar por cualquier medio comentarios que nos hayas
                    enviado. No tenemos ni tendremos ninguna obligación (1) de mantener ningún comentario
                    confidencialmente; (2) de pagar compensación por comentarios; o (3) de responder a comentarios.</p>

                <p>Nosotros podemos, pero no tenemos obligación de, monitorear, editar o remover contenido que
                    consideremos sea ilegítimo, ofensivo, amenazante, calumnioso, difamatorio, pornográfico, obsceno u
                    objetable o viole la propiedad intelectual de cualquiera de las partes o los Términos de Servicio.
                </p>

                <p>Aceptas que tus comentarios no violarán los derechos de terceras partes, incluyendo derechos de
                    autor, marca, privacidad, personalidad u otro derechos personal o de propiedad. Asimismo, aceptas
                    que tus comentarios no contienen material difamatorio o ilegal, abusivo u obsceno, o contienen virus
                    informáticos u otro malware que pudiera, de alguna manera, afectar el funcionamiento del Srvicio o
                    de cualquier sitio web relacionado. No puedes utilizar una dirección de correo electrónico falsa,
                    usar otra identidad que no sea legítima, o engañar a terceras partes o a nosotros en cuanto al
                    origen de tus comentarios. Tu eres el único responsable por los comentarios que haces y su
                    precisión. No nos hacemos responsables y no asumimos ninguna obligación con respecto a los
                    comentarios publicados por ti o cualquier tercer parte.</p>

                <h5>SECCIÓN 10 - INFORMACIÓN PERSONAL</h5>

                <p>Tu presentación de información personal a través del sitio se rige por nuestra Política de
                    Privacidad. Para ver nuestra Política de Privacidad.</p>

                <h5>SECCIÓN 11 - ERRORES, INEXACTITUDES Y OMISIONES</h5>

                <p>De vez en cuando puede haber información en nuestro sitio o en el Servicio que contiene errores
                    tipográficos, inexactitudes u omisiones que puedan estar relacionadas con las descripciones de
                    productos, precios, promociones, ofertas, gastos de envío del producto, el tiempo de tránsito y la
                    disponibilidad. Nos reservamos el derecho de corregir los errores, inexactitudes u omisiones y de
                    cambiar o actualizar la información o cancelar pedidos si alguna información en el Servicio o en
                    cualquier sitio web relacionado es inexacta en cualquier momento sin previo aviso (incluso después
                    de que hayas enviado tu orden).</p>

                <p>No asumimos ninguna obligación de actualizar, corregir o aclarar la información en el Servicio o en
                    cualquier sitio web relacionado, incluyendo, sin limitación, la información de precios, excepto
                    cuando sea requerido por la ley. Ninguna especificación actualizada o fecha de actualización
                    aplicada en el Servicio o en cualquier sitio web relacionado, debe ser tomada para indicar que toda
                    la información en el Servicio o en cualquier sitio web relacionado ha sido modificado o actualizado.
                </p>

                <h5>SECCIÓN 12 - USOS PROHIBIDOS</h5>

                <p>En adición a otras prohibiciones como se establece en los Términos de Servicio, se prohibe el uso del
                    sitio o su contenido: (a) para ningún propósito ilegal; (b) para pedirle a otros que realicen o
                    partiicpen en actos ilícitos; (c) para violar cualquier regulación, reglas, leyes internacionales,
                    federales, provinciales o estatales, u ordenanzas locales; (d) para infringir o violar el derecho de
                    propiedad intelectual nuestro o de terceras partes; (e) para acosar, abusar, insultar, dañar,
                    difamar, calumniar, desprestigiar, intimidar o discriminar por razones de género, orientación
                    sexual, religión, tnia, raza, edad, nacionalidad o discapacidad; (f) para presentar información
                    falsa o engañosa; (g) para cargar o transmitir virus o cualquier otro tipo de código malicioso que
                    sea o pueda ser utilizado en cualquier forma que pueda comprometer la funcionalidad o el
                    funcionamientodel Servicio o de cualquier sitio web relacionado, otros sitios o Internet; (h) para
                    recopilar o rastrear información personal de otros; (i) para generar spam, phish, pharm, pretext,
                    spider, crawl, or scrape; (j) para cualquier propósito obsceno o inmoral; o (k) para interferir con
                    o burlar los elementos de seguridad del Servicio o cualquier sitio web relacionado¿ otros sitios o
                    Internet. Nos reservamos el derecho de suspender el uso del Servicio o de cualquier sitio web
                    relacionado por violar cualquiera de los ítems de los usos prohibidos.</p>

                <h5>SECCIÓN 13 - EXCLUSIÓN DE GARANTÍAS; LIMITACIÓN DE RESPONSABILIDAD</h5>

                <p>No garantizamos ni aseguramos que el uso de nuestro servicio será ininterrumpido, puntual, seguro o
                    libre de errores.</p>

                <p>No garantizamos que los resultados que se puedan obtener del uso del servicio serán exactos o
                    confiables.</p>

                <p>Aceptas que de vez en cuando podemos quitar el servicio por períodos de tiempo indefinidos o cancelar
                    el servicio en cualquier momento sin previo aviso.</p>

                <p>Aceptas expresamenteque el uso de, o la posibilidad de utilizar, el servicio es bajo tu propio
                    riesgo. El servicio y todos los productos y servicios proporcionados a través del servicio son
                    (salvo lo expresamente manifestado por nosotros) proporcionados "tal cual" y "según esté disponible"
                    para su uso, sin ningún tipo de representación, garantías o condiciones de ningún tipo, ya sea
                    expresa o implícita, incluídas todas las garantías o condiciones implícitas de comercialización,
                    calidad comercializable, la aptitud para un propósito particular, durabilidad, título y no
                    infracción.</p>

                <p>En ningún caso DRAIV, nuestros directores, funcionarios, empleados, afiliados, agentes, contratistas,
                    internos, proveedores, prestadores de servicios o licenciantes serán responsables por cualquier
                    daño, pérdida, reclamo, o daños directos, indirectos, incidentales, punitivos, especiales o
                    consecuentes de cualquier tipo, incluyendo, sin limitación, pérdida de beneficios, pérdida de
                    igresos, pérdida de ahorros, pérdida de datos, costos de reemplazo, o cualquier daño similar, ya sea
                    basado en contrato, agravio (incluyendo negligencia), responsabilidad estricta o de otra manera,
                    como consecuencia del uso de cualquiera de los servicios o productos adquiridos mediante el
                    servicio, o por cualquier otro reclamo relacionado de alguna manera con el uso del servicio o
                    cualquier producto, incluyendo pero no limitado, a cualquier error u omisión en cualquier contenido,
                    o cualquier pérdida o daño de cualquier tipo incurridos como resultados de la utilización del
                    servicio o cualquier contenido (o producto) publicado, transmitido, o que se pongan a disposición a
                    través del servicio, incluso si se avisa de su posibilidad. Debido a que algunos estados o
                    jurisdicciones no permiten la exclusión o la limitación de responsabilidad por daños consecuenciales
                    o incidentales, en tales estados o jurisdicciones, nuestra responsabilidad se limitará en la medida
                    máxima permitida por la ley.</p>

                <h5>SECCIÓN 14 - INDEMNIZACIÓN</h5>

                <p>Aceptas indemnizar, defender y mantener indemne DRAIV y nuestras matrices, subsidiarias, afiliados,
                    socios, funcionarios, directores, agentes, contratistas, concesionarios, proveedores de servicios,
                    subcontratistas, proveedores, internos y empleados, de cualquier reclamo o demanda, incluyendo
                    honorarios razonables de abogados, hechos por cualquier tercero a causa o como resultado de tu
                    incumplimiento de las Condiciones de Servicio o de los documentos que incorporan como referencia, o
                    la violación de cualquier ley o de los derechos de u tercero.</p>

                <h5>SECCIÓN 15 - DIVISIBILIDAD</h5>

                <p>En el caso de que se determine que cualquier disposición de estas Condiciones de Servicio sea ilegal,
                    nula o inejecutable, dicha disposición será, no obstante, efectiva a obtener la máxima medida
                    permitida por la ley aplicable, y la parte no exigible se considerará separada de estos Términos de
                    Servicio, dicha determinación no afectará la validez de aplicabilidad de las demás disposiciones
                    restantes.</p>

                <h5>SECCIÓN 16 - RESCISIÓN</h5>

                <p>Las obligaciones y responsabilidades de las partes que hayan incurrido con anterioridad a la fecha de
                    terminación sobrevivirán a la terminación de este acuerdo a todos los efectos.</p>

                <p>Estas Condiciones de servicio son efectivos a menos que y hasta que sea terminado por ti o nosotros.
                    Puedes terminar estos Términos de Servicio en cualquier momento por avisarnos que ya no deseas
                    utilizar nuestros servicios, o cuando dejes de usar nuestro sitio.</p>

                <p>Si a nuestro juicio, fallas, o se sospecha que haz fallado, en el cumplimiento de cualquier término o
                    disposición de estas Condiciones de Servicio, tambien podemos terminar este acuerdo en cualquier
                    momento sin previo aviso, y seguirás siendo responsable de todos los montos adeudados hasta incluída
                    la fecha de terminación; y/o en consecuencia podemos negarte el acceso a nuestros servicios (o
                    cualquier parte del mismo).</p>

                <h5>SECCIÓN 17 - ACUERDO COMPLETO</h5>

                <p>Nuestra falla para ejercer o hacer valer cualquier derecho o disposiciôn de estas Condiciones de
                    Servicio no constituirá una renucia a tal derecho o disposición.</p>

                <p>Estas Condiciones del servicio y las políticas o reglas de operación publicadas por nosotros en este
                    sitio o con respecto al servicio constituyen el acuerdo completo y el entendimiento entre tu y
                    nosotros y rigen el uso del Servicio y reemplaza cualquier acuerdo, comunicaciones y propuestas
                    anteriores o contemporáneas, ya sea oral o escrita, entre tu y nosotros (incluyendo, pero no
                    limitado a, cualquier versión previa de los Términos de Servicio).</p>

                <p>Cualquier ambigüedad en la interpretación de estas Condiciones del servicio no se interpretarán en
                    contra del grupo de redacción.</p>

                <h5>SECCIÓN 18 - LEY</h5>

                <p>Estas Condiciones del servicio y cualquier acuerdo aparte en el que te proporcionemos servicios se
                    regirán e interpretarán en conformidad con las leyes de CARRERA 20 71 22, BOGOTA, DC, 110101,
                    Colombia.</p>

                <h5>SECCIÓN 19 - CAMBIOS EN LOS TÉRMINOS DE SERVICIO</h5>

                <p>Puedes revisar la versión más actualizada de los Términos de Servicio en cualquier momento en esta
                    página.</p>

                <p>Nos reservamos el derecho, a nuestra sola discreción, de actualizar, modificar o reemplazar cualquier
                    parte de estas Condiciones del servicio mediante la publicación de las actualizaciones y los cambios
                    en nuestro sitio web. Es tu responsabilidad revisar nuestro sitio web periódicamente para verificar
                    los cambios. El uso contínuo de o el acceso a nuestro sitio Web o el Servicio después de la
                    publicación de cualquier cambio en estas Condiciones de servicio implica la aceptación de dichos
                    cambios.</p>

                <h5>SECCIÓN 20 - INFORMACIÓN DE CONTACTO</h5>

                <p>Preguntas acerca de los Términos de Servicio deben ser enviadas juanroldan@smarttaxi.co.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/login.js') }}" defer></script>
@endsection