<?php session_start();
        include_once('config.php');
        require_once($_SERVER["DOCUMENT_ROOT"]."/include/funciones.php");

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        
        if (isset($_SESSION["UserId"])) {
            $UserData =	$db->getAllRecords('usuarios','*',' AND id="'.($_SESSION["UserId"]).'"LIMIT 1 ');
            $UserData = $UserData[0];
            //($UserData['nombres'])
            if ($UserData['fPerfil']){
                $fPerfil = '/upload/usuarios/'.(strftime("%Y", strtotime(($UserData['fr'])))).'/'.(strftime("%m", strtotime(($UserData['fr'])))).'/'.($UserData['fPerfil']).'.jpg';
                } else {$fPerfil = '/upload/usuarios/default.jpg';}
        } 

        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!isset($_REQUEST['id'])) {
         
        echo "ERROR 10";
        exit();
        } 
        
        $servData =	$db->getAllRecords('servicios','*',' AND id="'.$_REQUEST['id'].'"LIMIT 1 ');
        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!($servData)) {
        echo "ERROR 20";
        exit();
        }

        $servData = $servData[0];
        
        //SUMAMOS +1 A LAS IMPRECIONES DEL ANUNCIO
        $SumImpreciones = (($servData['visitas'])+1);
    
        $InsertData	=	array(
            'visitas'=> $SumImpreciones,
        );
        $update	 =  $db->update('servicios',$InsertData,array('id'=>($servData['id'])));//ACTUALIZAMOS LAS IMPRECIONES


    
    
  
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

                <section id="sec1">
                    <div class="container">
                        <div class="row justify-content-center">

                            <div class="col-md-2"></div>

                            <div class="col-md-8">
                                <div class="list-single-main-item fl-wrap">
                                    <div class="list-single-main-item-title fl-wrap">
                                        <h3>Servicio: <span><?php echo $servData['nombre'] ?> </span></h3>
                                    </div>
                                    <div class="list-single-main-media fl-wrap">
                                        <img src="/upload/servicios/<?php echo (strftime("%Y", strtotime(($servData['fr']))));?>/<?php echo (strftime("%m", strtotime(($servData['fr']))));?>/<?php echo ($servData['fPortada']) ?>.jpg" class="respimg" alt="">
                                    </div>
                                    <p><?php echo $servData['descripcion'] ?> </p>
                                    <div class="list-author-widget-contacts">
                                        <ul>
                                            <li><span><i class="fa fa-phone"></i>Teléfono :</span> <a href="tel:<?php echo $servData['telefono'] ?>"><?php echo $servData['telefono'] ?> </a></li>
                                            <li><span><i class="fa fa-envelope-o"></i>Correo elestrónico :</span> <a href="mailto:<?php echo $servData['email'] ?>"><?php echo $servData['email'] ?> </a></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="list-single-main-item-title fl-wrap mt-4">
                                        <h3 class="mt-4">Enviar mensaje al anunciante</h3>
                                    </div>
                                    
                                    <div id="contact-form">
                                        <div id="message"></div>
                                        <form class="custom-form" action="" name="contactform" id="contactform">
                                            <fieldset>
                                                <label><i class="fa fa-user-o"></i></label>
                                                <input type="text" name="name" id="name" placeholder="Tu nombre *" value="<?php echo $UserData['nombre'] ?>" />
                                                <div class="clearfix"></div>
                                                <label><i class="fa fa-phone"></i> </label>
                                                <input type="text" name="phone" id="phone" placeholder="Teléfono *" value="" />
                                                <textarea name="comments" id="comments" onClick="this.select()">Por favor redacta aquí el mesnaje</textarea>
                                                
                                            </fieldset>
                                            <button class="btn  big-btn  color-bg flat-btn" id="submit">Enviar<i class="fa fa-angle-right"></i></button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-2"></div>
                            
                        </div>
                    </div>
                </section>

                
                <section class="gray-section">
                    <div class="container">
                        <div class="section-title">
                            <h2>Contrata otros servicios</h2>
                            <span class="section-separator"></span>
                            <p>Servicios a domicilio cerca de ti.</p>
                        </div>
                    </div>
                    <div class="container">

                        <div class="list-single-main-item fl-wrap">

                            <?php $categoriaData = $db->getAllRecords('catServicios', '*', 'ORDER BY id DESC');
                            if (count($categoriaData) > 0) {

                                foreach ($categoriaData as $categoria) {



                            ?>

                                    <div class="list-single-main-item-title fl-wrap">
                                        <h3><?php echo $categoria['nombre']; ?></h3>
                                    </div>
                                    <div class="listing-features fl-wrap">
                                        <ul>
                                            <?php $categoriaDataSub = $db->getAllRecords('catSubServicios', '*', 'AND categoria="' . ($categoria['id']) . '" ORDER BY id DESC');
                                            if (count($categoriaDataSub) > 0) {

                                                foreach ($categoriaDataSub as $categoriaSub) {
                                                    //Contadores
                                                    $serviciosCount   =  $db->getQueryCount('servicios', 'id', 'AND catSubServicio="' . ($categoriaSub['id']) . '"');
                                                    $serviciosCount   = ($serviciosCount[0]['total']);

                                            ?>

                                                    <li><?php echo $categoriaSub['nombre']; ?> (<?php echo $serviciosCount; ?>)</li>

                                            <?php
                                                }
                                            }
                                            ?>


                                        </ul>
                                    </div>
                                    <span class="fw-separator"></span>



                            <?php
                                }
                            }
                            ?>



                        </div>

                    </div>
                </section>

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

                <?php $servData = $db->getAllRecords('empresas', '*', 'ORDER BY id');
                if (count($servData) > 0) {
                    $y    =    '';
                    foreach ($servData as $empresa) {
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