<?php session_start();
include_once('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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



//PARA EL CONTADOR GLOBAL
$tUsu    =    $db->getQueryCount('usuarios', 'id');
$tEmp    =    $db->getQueryCount('empresas', 'id');
$tPro    =    $db->getQueryCount('productos', 'id');
$tSer    =    $db->getQueryCount('servicios', 'id');


//CONDICION PARA REALIZAR LA BUSQUEDA
$condition    =    '';
if (isset($_REQUEST['lug']) and $_REQUEST['lug'] != "") {
  $condition    .=    ' AND lugar LIKE "%' . $_REQUEST['lug'] . '%" ';
}
if (isset($_REQUEST['cat']) and $_REQUEST['cat'] != "") {
  $condition    .=    ' AND catEmpresa LIKE "%' . $_REQUEST['cat'] . '%" ';
}
if (isset($_REQUEST['subcat']) and $_REQUEST['subcat'] != "") {
  $condition    .=    ' AND catSubEmpresa LIKE "%' . $_REQUEST['subcat'] . '%" ';
}
if (isset($_REQUEST['nomb']) and $_REQUEST['nomb'] != "") {
  $condition    .=    ' AND nombre LIKE "%' . $_REQUEST['nomb'] . '%" ';
}


//REESCRIBO $PostData PARA USAR EN EL RESULTADO DE BUSQUEDA
$PostData    =    $db->getAllRecords('empresas', '*', $condition, 'ORDER BY fr DESC');



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

  <link type="text/css" rel="stylesheet" href="/fotorama/fotorama.css">



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
    <div id="wrapper">
      <!-- Content-->
      <div class="content">

        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/nav.php"); ?>

        <div class="div-desktop">
          <div class="fotorama" data-width="100%" data-max-width="100%" data-transition="crossfade" data-click="false" data-swipe="false" data-fit="cover" data-autoplay="3000" data-allowfullscreen="true" data-loop="true" data-nav="true">

            <img src="/images/bg/slider/01.jpg" alt="" title="">
            <img src="/images/bg/slider/02.jpg" alt="" title="">
            <img src="/images/bg/slider/03.jpg" alt="" title="">
          </div>
        </div>

        <div class="div-mobile">
          <div class="fotorama" data-width="100%" data-max-width="100%" data-transition="crossfade" data-click="false" data-swipe="false" data-fit="cover" data-autoplay="3000" data-allowfullscreen="true" data-loop="true" data-nav="false">

            <img src="/images/bg/slider/mobile/01.jpg" alt="" title="">
            <img src="/images/bg/slider/mobile/02.jpg" alt="" title="">
            <img src="/images/bg/slider/mobile/03.jpg" alt="" title="">
          </div>
        </div>



        <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/listaEmpresas.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/listaServicios.php");
        ?>

        <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/contador.php");
        ?>

        <style>
          #map-canvas {
            max-width: 80%;
            height: 400px;
            margin: 0 auto;
          }
        </style>

        <section class="gray-section">
          <div class="container">
            <div class="section-title">
              <h2>Ubica los negocios</h2>
              <span class="section-separator"></span>
              <p>Encuentra miles de negocios en <b>CaboConexion</b></p>
            </div>
          </div>

          <div id="map-canvas"></div>
        </section>
      </div>
      <!-- Content end -->
    </div>
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
  <script type="text/javascript" src="/js/scripts.js"></script> <!-- Google maps -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzU-BCbU5EaT2F9q8Q7WfwA8XzQfBdK4o"></script>

  <script type="text/javascript" src="/js/markerclusterer.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
  <script src="/fotorama/fotorama.js"></script>




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