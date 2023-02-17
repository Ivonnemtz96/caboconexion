<?php
session_start();
include_once('config.php');

if (isset($_SESSION["UserId"])) {
    $UserData =    $db->getAllRecords('usuarios', '*', ' AND id="' . ($_SESSION["UserId"]) . '"LIMIT 1 ');
    $UserData = $UserData[0];
    //($UserData['nombres'])
    if ($UserData['fPerfil']) {
        $fPerfil = '/upload/usuarios/' . (strftime("%Y", strtotime(($UserData['fr'])))) . '/' . (strftime("%m", strtotime(($UserData['fr'])))) . '/' . ($UserData['fPerfil']) . '.jpg';
    } else {
        $fPerfil = '/upload/usuarios/default.jpg';
    }
}

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

    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">


    <style>
        .group:focus .group-focus\:flex {
            display: flex;
        }

        .bg-precio {
            background-color: #4DB7FE;
            color: #fff;
        }

        .color-link-precio {
            color: #4DB7FE;
        }
    </style>

    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">
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
        <!-- header-->
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/header.php");

        if (isset($_COOKIE['msg'])) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/msg.php");
        }
        ?>



        <!-- wrapper -->
        <div>
            <!-- Content-->
            <div class="content">

                <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/nav.php"); ?>



                <div class="flex flex-col w-screen min-h-screen bg-gray-100 text-gray-800">

                    <section class="gray-section p-10 ">
                        <div class="container">
                            <div class="section-title">
                                <h2>Todos los productos</h2>
                                <span class="section-separator"></span>
                                <p>1-16 de 148 Productos</p>
                            </div>



                            <div class="grid 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-x-6 gap-y-12 w-full mt-6">
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                                <!-- Product Tile Start -->
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
                                    <div class="flex items-center justify-between mt-3">
                                        <div>
                                            <a href="#" class="font-medium">Nombre de producto</a>
                                            <a class="flex items-center" href="#">
                                                <span class="text-xs font-medium text-gray-600">por</span>
                                                <span class="text-xs font-medium ml-1 color-link-precio">Usuario</span>
                                            </a>
                                        </div>
                                        <span class="flex items-center h-8 bg-precio text-indigo-600 text-sm px-2 rounded">$3,400</span>
                                    </div>
                                </div>
                                <!-- Product Tile End -->
                            </div>
                            <div class="flex justify-center mt-10 space-x-1">
                                <button class="flex items-center justify-center h-8 w-8 rounded text-gray-400">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="flex items-center justify-center h-8 px-2 rounded text-sm font-medium text-gray-400" disabled>
                                    Anterior
                                </button>
                                <button class="flex items-center justify-center h-8 w-8 rounded bg-precio text-sm font-medium text-indigo-600" disabled>
                                    1
                                </button>
                                <button class="flex items-center justify-center h-8 w-8 rounded hover:bg-precio text-sm font-medium text-gray-600 hover:text-indigo-600">
                                    2
                                </button>
                                <button class="flex items-center justify-center h-8 w-8 rounded hover:bg-precio text-sm font-medium text-gray-600 hover:text-indigo-600">
                                    3
                                </button>
                                <button class="flex items-center justify-center h-8 px-2 rounded hover:bg-precio text-sm font-medium text-gray-600 hover:text-indigo-600">
                                    Siguiente
                                </button>
                                <button class="flex items-center justify-center h-8 w-8 rounded hover:bg-precio text-gray-600 hover:text-indigo-600">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </section>

                </div>
                <!-- Component End  -->



            </div>
            <!-- Content end -->
        </div>
        <!-- wrapper end -->

        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/footer.php"); ?>


        <!--register form end -->
        <a class="to-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/plugins.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script> <!-- Google maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzU-BCbU5EaT2F9q8Q7WfwA8XzQfBdK4o"></script>

    <script type="text/javascript" src="/js/markerclusterer.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>




    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>

    <script>
        /* Mapa */
        jQuery(function() {
            $(document).ready(function() {
                "use strict";

                //Google Map

                var mapCanvas = document.getElementById("map-canvas");
                var mapOptions = {
                    zoom: 11,
                    scrollwheel: true,
                    center: new google.maps.LatLng(23.053170, -109.701440),
                    // How you would like to style the map.
                    styles: [{
                            featureType: "administrative",
                            elementType: "all",
                            stylers: [{
                                    visibility: "on"
                                },
                                {
                                    saturation: -100
                                },
                                {
                                    lightness: 20
                                },
                            ],
                        },
                        {
                            featureType: "road",
                            elementType: "all",
                            stylers: [{
                                    visibility: "on"
                                },
                                {
                                    saturation: -100
                                },
                                {
                                    lightness: 40
                                },
                            ],
                        },
                        {
                            featureType: "water",
                            elementType: "all",
                            stylers: [{
                                    visibility: "on"
                                },
                                {
                                    saturation: -10
                                },
                                {
                                    lightness: 30
                                },
                            ],
                        },
                        {
                            featureType: "landscape.man_made",
                            elementType: "all",
                            stylers: [{
                                    visibility: "simplified"
                                },
                                {
                                    saturation: -60
                                },
                                {
                                    lightness: 10
                                },
                            ],
                        },
                        {
                            featureType: "landscape.natural",
                            elementType: "all",
                            stylers: [{
                                    visibility: "simplified"
                                },
                                {
                                    saturation: -60
                                },
                                {
                                    lightness: 60
                                },
                            ],
                        },
                        {
                            featureType: "poi",
                            elementType: "all",
                            stylers: [{
                                    visibility: "off"
                                },
                                {
                                    saturation: -100
                                },
                                {
                                    lightness: 60
                                },
                            ],
                        },
                        {
                            featureType: "transit",
                            elementType: "all",
                            stylers: [{
                                    visibility: "off"
                                },
                                {
                                    saturation: -100
                                },
                                {
                                    lightness: 60
                                },
                            ],
                        },
                    ],
                };
                var map = new google.maps.Map(mapCanvas, mapOptions);

                <?php $empData = $db->getAllRecords('empresas', '*', 'ORDER BY id');
                if (count($empData) > 0) {
                    $y    =    '';
                    foreach ($empData as $empresa) {
                        $y++;


                        $catEmpresa = $db->getAllRecords('catEmpresa', '*', 'AND id=' . ($empresa['catEmpresa']) . ' LIMIT 1');
                        $catEmpresa = $catEmpresa[0];

                ?>

                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(<?php echo $empresa['lat']; ?>, <?php echo $empresa['lon']; ?>), //Dr. Berzunza
                            icon: "/map/belleza.png",
                            map: map,
                            title: "<?php echo $empresa['nombre']; ?>",
                        });



                <?php
                    }
                }
                ?>


            });
        });
    </script>
</body>

</html>