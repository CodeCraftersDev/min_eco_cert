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
    <script src="<?=base_url('adminlte/plugins/popper/')?>popper.min.js"></script>
    <script src="<?=base_url('adminlte/plugins/bootstrap/js/')?>bootstrap.min.js"></script>
</head>

<body>
<!-- preloader Start -->
<div id="preloader">
    <div id="status"><img src="<?=base_url('assets/img/')?>preloader.gif" id="preloader_image" alt="loader">
    </div>
</div>

<!-- start wrapper -->
<div class="wrapper">
    <div class="header-menu">
        <div class="container band">
            <div class="logo">
                <img src="<?=base_url('assets/img/')?>eco_logo.png" alt="Ministerio de Ecología">
            </div>
            <ul class="menu">
                <li><a href="https://ecologia.misiones.gob.ar/">Inicio</a></li>
                <li><a href="https://ecologia.misiones.gob.ar/corredor-verde/">Corredor verde</a></li>
                <li><a href="https://ecologia.misiones.gob.ar/ecologia-te-escucha/">Ecología te escucha</a></li>
            </ul>
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
            <form action="">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">D.N.I.</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup"
                                   placeholder="Número de Documento">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-light">Enviar</button>
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
                    <li><a href="">+54 9 0376 4447593</a></li>
                    <li><a href="">prensa@ecologia.misiones.gob.ar</a></li>
                    <li>San Lorenzo 1538, Posadas, Misiones, Argentina</li>
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
                    <!-- <li class="tw">
                        <a target="_blank" href="https://twitter.com/MinEcoMisiones?lang=es">
                            <svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" focusable="false"
                                data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                </path>
                            </svg>
                        </a>
                    </li> -->
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