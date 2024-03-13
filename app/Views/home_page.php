<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ministerio Ecologia - Certificado</title>
    <meta name="description" content="Página del Ministerio de Ecología">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=base_url('assets/img/')?>favicon.jpg">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?=base_url('assets/css/')?>styles.css">
    <link rel="stylesheet" href="<?=base_url('adminlte/plugins/bootstrap/css/')?>bootstrap.min.css">

    <!-- Scripts JS -->
    <script src="<?=base_url('adminlte/plugins/jquery/')?>jquery.min.js"></script>
    <script src="<?=base_url('adminlte/plugins/popper/umd/')?>popper.min.js"></script>
    <script src="<?=base_url('adminlte/plugins/bootstrap/js/')?>bootstrap.min.js"></script>
    <script src="<?=base_url('adminlte/plugins/jquery-validation/')?>jquery.validate.min.js"></script>
    <script src="<?=base_url('adminlte/plugins/jquery-validation/')?>additional-methods.js"></script>
    <script type="application/javascript">
        const base_url = '<?=base_url()?>';
    </script>
</head>

<body>
<!-- preloader Start -->
<div id="preloader">
    <div id="status"><img src="<?=base_url('assets/img/')?>preloader.gif" id="preloader_image" alt="loader">
    </div>
</div>

<!-- ajax Loader -->
<div id="ajax_loader">
    <div class="ajax_background"></div>
    <div class="ajax_img_loader">
        <svg version="1.1" id="L3"
             xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px"
             y="0px"
             viewBox="0 0 100 100"
             enable-background="new 0 0 0 0"
             xml:space="preserve"
        >
        <circle fill="none" stroke="#2ECC71" stroke-width="4" cx="50" cy="50" r="44" />
            <circle fill="#fff" stroke="#2ECC71" stroke-width="3" cx="8" cy="54" r="6" >
                <animateTransform
                        attributeName="transform"
                        dur="2s"
                        type="rotate"
                        from="0 50 48"
                        to="360 50 52"
                        repeatCount="indefinite" />

            </circle>
    </svg>
    </div>
</div>

<!-- Modals -->
<div class="modal" tabindex="-1" role="dialog" id="modal-box">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="text-body"></p>
            </div>
            <div class="modal-footer">
                <button id="ok" type="button" class="btn btn-primary">Aceptar</button>
                <button id="nook" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- start wrapper -->
<div class="wrapper">
    <div class="header-menu">
        <div class="container band">
            <nav class="navbar navbar-expand-lg">
                <div class="top-logo">
                    <div class="logo navbar-brand">
                        <a href="https://ecologia.misiones.gob.ar" target="_blank">
                            <img src="<?=base_url('assets/img/')?>eco_logo.png" alt="Ministerio de Ecología">
                        </a>
                    </div>
                    <div class="hamburger_btn">
                        <button
                                class="navbar-toggler"
                                type="button"
                                data-toggle="collapse"
                                data-target="#navbarEcoContent"
                                aria-controls="navbarEcoContent"
                                aria-expanded="false"
                                aria-label="Ecologia"
                        >
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarEcoContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://ecologia.misiones.gob.ar/autoridades/" target="_blank">Autoridades</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                Subs. de Ecología
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/biodiversidad/" target="_blank">Dirección de Biodiversidad</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/recursos-vitales/" target="_blank">Dirección de Recursos Vitales</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/areas-naturales-protegidas/" target="_blank">Dirección de Áreas Naturales Protegidas</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/impacto-ambiental/" target="_blank">Dirección de Impacto Ambiental</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/educacion-ambiental/" target="_blank">Educación Ambiental</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/parque-ecologico-el-puma/" target="_blank">Parque Ecológico EL PUMA</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/registro-de-meliponicultores-de-la-provincia/" target="_blank">Registro de Meliponicultores de la provincia</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                Subs. de Ord. Territorial
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/direccion-gral-de-planificacion-territorial/" target="_blank">Dirección Gral. de Planificación Territorial</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/direccion-gral-de-sistemas-de-informacion-geografica/" target="_blank">Dirección Gral. de Sistemas de Información Geográfica</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/direccion-gral-alerta-temprana/" target="_blank">Dirección Gral. de Alerta Temprana</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                Bosques Nativos
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="https://ecologia.misiones.gob.ar/departamento-de-promocion-de-bosques-nativos/">
                                    Departamento de Promoción de Bosques Nativos
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://ecologia.misiones.gob.ar/corredor-verde/" target="_blank">Corredor Verde</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="form-wrapper container">
        <div class="row text-eco">
            <h1>Ministerio de Ecología</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio a quia iusto quasi ullam fugiat
                eum deserunt blanditiis assumenda, dolorem aliquam numquam neque harum voluptate consequatur esse in
                laboriosam ipsum.</p>
        </div>
        <div class="row form">
            <form id="formid" action="">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Nombre</div>
                            </div>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                        </div>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Apellido</div>
                            </div>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                        </div>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">D.N.I.</div>
                            </div>
                            <input type="text" class="form-control" id="dni_number" name="dni_number" placeholder="Número de Documento" required>
                        </div>
                    </div>
                </div>
                <button type="button" id="btn-submit" class="btn btn-light">Enviar</button>
            </form>
        </div>
    </div>
</div>

<!-- start footer -->
<footer>
    <div class="fotter-center container">
        <div class="footer-top">
            <div class="footer-logo">
                <img src="<?=base_url('assets/img/')?>logo_eco_footer.png" alt="Ministerio Ecologia">
            </div>
            <div class="footer-nav">
                <h3>Navegación</h3>
                <ul>
                    <li><a href="https://ecologia.misiones.gob.ar/">Inicio</a></li>
                    <li><a href="https://ecologia.misiones.gob.ar/corredor-verde/">Corredor verde</a></li>
                    <li><a href="https://ecologia.misiones.gob.ar/ecologia-te-escucha/">Ecología te escucha</a></li>
                </ul>
            </div>
            <div class="footer-info">
                <h3>Información</h3>
                <ul>
                    <li>+54 9 0376 4447593</li>
                    <li><a href="mailto:prensa@ecologia.misiones.gob.ar">prensa@ecologia.misiones.gob.ar</a></li>
                    <li><a href="https://goo.gl/maps/QYnSQHXdaFPoZVTh6" target="_blank">San Lorenzo 1538, Posadas, Misiones, Argentina</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyrigth @2024 Todos los derechos reservados</p>
            <div class="social">
                <ul>
                    <li class="fb">
                        <a target="_blank" href="https://www.facebook.com/ministeriode.ecologia/">
                            <svg class="facebook" aria-hidden="true" focusable="false" data-prefix="fab"
                                 data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="-100 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                      d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="ig">
                        <a target="_blank" href="https://www.instagram.com/ecologiamisiones/">
                            <svg class="svg-inline--fa fa-instagram fa-w-14 icono" aria-hidden="true"
                                 focusable="false" data-prefix="fab" data-icon="instagram" role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                      d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="yt">
                        <a target="_blank" href="https://www.youtube.com/c/MEyRNRMisiones"><svg
                                    class="svg-inline--fa fa-youtube fa-w-18" aria-hidden="true" focusable="false"
                                    data-prefix="fab" data-icon="youtube" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                      d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="wa">
                        <a target="_blank" href="https://wa.me/543764883555"><svg
                                    class="svg-inline--fa fa-whatsapp fa-w-14" aria-hidden="true" focusable="false"
                                    data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                      d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                </path>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Powered <a href="https://ccdev.ar" target="_blank">Code Crafters</a></p>
        </div>
    </div>
</footer>

<!-- Main Scripts JS -->
<script src="<?=base_url('assets/js/')?>scripts.js?nocache=<?=time()?>" async defer></script>

</body>

</html>