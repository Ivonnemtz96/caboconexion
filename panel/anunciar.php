<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/sesion.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/include/funciones.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


date_default_timezone_set('America/Denver');
$fecha = date("Y-m-d H:i:s");




?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>CaboConexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="/css/reset.css">
    <link type="text/css" rel="stylesheet" href="/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="/css/style.css">
    <link type="text/css" rel="stylesheet" href="/css/color.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">

    <style>
        :root {
            --background-dark: #2F3B59;
            --text-light: rgba(255, 255, 255, 0.6);
            --text-lighter: rgba(255, 255, 255, 0.9);
            --spacing-s: 8px;
            --spacing-m: 16px;
            --spacing-l: 24px;
            --spacing-xl: 32px;
            --spacing-xxl: 64px;
            --width-container: 1200px;
        }

        * {
            border: 0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
        }

        body {
            height: 100%;
        }

        .hero-section {
            align-items: flex-start;
            background-image: linear-gradient(15deg, #0f4667 0%, #2a6973 150%);
            display: flex;
            min-height: 100%;
            justify-content: center;
            padding: var(--spacing-xxl) var(--spacing-l);
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-column-gap: var(--spacing-l);
            grid-row-gap: var(--spacing-l);
            max-width: var(--width-container);
            width: 100%;
        }

        @media(min-width: 540px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(min-width: 960px) {
            .card-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .card {
            list-style: none;
            position: relative;
        }

        .card:before {
            content: '';
            display: block;
            padding-bottom: 150%;
            width: 100%;
        }

        .card__background {
            background-size: cover;
            background-position: center;
            border-radius: var(--spacing-l);
            bottom: 0;
            filter: brightness(0.75) saturate(1.2) contrast(0.85);
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            transform-origin: center;
            trsnsform: scale(1) translateZ(0);
            transition:
                filter 200ms linear,
                transform 200ms linear;
        }

        .card:hover .card__background {
            transform: scale(1.05) translateZ(0);
        }

        .card-grid:hover>.card:not(:hover) .card__background {
            filter: brightness(0.5) contrast(1.2) blur(5px);
        }

        .card__content {
            left: 0;
            padding: var(--spacing-l);
            position: absolute;
            bottom: 0;
        }

        .card__category {
            color: rgb(255 255 255);
            font-size: 0.9rem;
            margin-bottom: var(--spacing-s);
            text-transform: uppercase;
            background: #4DB7FE;
            padding: 1px;
            border-radius: 10px;
            margin-top: 5px;
        }

        .card__heading {
            color: var(--text-lighter);
            font-size: 24px;
            text-shadow: 2px 2px 20px rgb(0 0 0 / 20%);
            line-height: 1.4;
            /* word-spacing: 100vw; */
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="pin"></div>
        <div class="pulse"></div>
    </div>
    <!--loader end-->
    <!-- Main  -->
    <div id="main">

        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/header.php");

        if (isset($_COOKIE['msg'])) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/msg.php");
        }
        ?>


        <!-- wrapper -->
        <div id="wrapper">
            <!--content -->
            <div class="content">
                <!--section -->
                <section>
                    <!-- container -->
                    <div class="container">
                        <!-- profile-edit-wrap -->
                        <div class="profile-edit-wrap">
                            <div class="profile-edit-page-header">
                                <h2>Elige el tipo de anuncio</h2>
                                <div class="breadcrumbs"><a href="/">Inicio</a><a href="/panel">Panel</a><span>Editar perfil</span></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">

                                    <div class="card-grid">
                                        <a class="card" href="/panel/nueva/empresa">
                                            <div class="card__background" style="background-image: url(/images/panel/01.jpg)"></div>
                                            <div class="card__content">
                                                <h3 class="card__heading">¡Agrega tu negocio o empresa!</h3>
                                                <p class="card__category mt-2">ESTABLECIMIENTOS</p>
                                            </div>
                                        </a>
                                        <a class="card" href="/panel/nuevo/servicio">
                                            <div class="card__background" style="background-image: url(/images/panel/02.jpg)"></div>
                                            <div class="card__content">
                                                <h3 class="card__heading">Servicios del hogar y a domicilio.</h3>
                                                <p class="card__category mt-2">SERVICIOS</p>
                                            </div>
                                        </a>
                                        <a class="card" href="/panel/nuevo/producto">
                                            <div class="card__background" style="background-image: url(/images/panel/03.jpg)"></div>
                                            <div class="card__content">
                                                <h3 class="card__heading">Vende tus productos.</h3>
                                                <p class="card__category mt-2">MARKETPLACE</p>
                                            </div>
                                            </li>
                                        </a>
                                        <a class="card" href="/panel/nuevo/micro">
                                            <div class="card__background" style="background-image: url(/images/panel/04.jpg)"></div>
                                            <div class="card__content">
                                                <h3 class="card__heading">¡Publica tu producción!</h3>
                                                <p class="card__category mt-2">MICROPRODUCTORES</p>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--profile-edit-wrap end -->
                    </div>
                    <!--container end -->
                </section>
                <!-- section end -->
                <div class="limit-box fl-wrap"></div>

            </div>
        </div>
        <!-- wrapper end -->

        <!-- wrapper end -->

        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/footer.php"); ?>


        <!--footer end  -->
        <!--register form -->
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/login.php"); ?>

        <!--register form end -->
        <a class="to-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/plugins.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzU-BCbU5EaT2F9q8Q7WfwA8XzQfBdK4o&libraries=places&callback=initAutocomplete"></script>
</body>

</html>