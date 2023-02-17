<?php
session_start();
include_once('config.php');


try {
     $connect = new PDO("mysql:host=" . SS_DB_HOST . "; dbname=" . SS_DB_NAME . "", SS_DB_USER, SS_DB_PASSWORD);
     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     if (isset($_POST["login"])) {
          if (empty($_POST["email"]) || empty($_POST["pass"])) {
               session_destroy();
               setcookie("msg", "all", time() + 2, "/");
               header("location: /acceder");
          } else {
               $query = "SELECT * FROM usuarios WHERE email = :email AND pass = :pass";
               $statement = $connect->prepare($query);
               $statement->execute(
                    array(
                         'email'     => $_POST["email"],
                         'pass'  => $_POST["pass"],
                    )
               );
               $count = $statement->rowCount();
               if ($count > 0) {

                    //ESTABLECEMOS LA HORA IGUAL QUE EN LOS CABOS
                    date_default_timezone_set('America/Denver');
                    $fecha = date("Y-m-d H:i:s");
                    //OBTENEMOS DATOS DE USUARIO
                    $UserData =     $db->getAllRecords('usuarios', '*', ' AND email="' . ($_POST["email"]) . '"LIMIT 1 ');
                    $UserData = $UserData[0];

                    if ($UserData['verificado'] == 0) {
                         setcookie("msg", "nover", time() + 3, "/");
                         header("location: /acceder");
                         exit;
                    }

                    $_SESSION["UserId"] = $UserData['id'];
                    //ACTUALIZAMOS LA FECHA DEL ÚLTIMO LOGIN
                    $InsertData     =     array(
                         'fl' => $fecha,
                    );
                    $update     =     $db->update('usuarios', $InsertData, array('id' => ($UserData['id']))); //ACTUALIZAMOS LA CUOTA CONSUMIDA EN LA BASE DE DATOS
                    setcookie("msg", "bienvenido", time() + 2, "/");
                    header("location: /");
               } else {
                    session_destroy();
                    setcookie("msg", "inv", time() + 2, "/");
                    header("location: /acceder");
               }
          }
     }
} catch (PDOException $error) {
     $message = $error->getMessage();
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



                    <div class="main-register-holder">
                         <div class="main-register fl-wrap">
                              <h3>Acceder a <span>Cabo<strong>Conexion</strong></span></h3>

                              <div id="tabs-container">
                                   <ul class="tabs-menu">
                                        <li class="current"><a href="#tab-1">Acceder</a></li>
                                        <li><a href="#tab-2">Registrate</a></li>
                                   </ul>
                                   <div class="tab">
                                        <div id="tab-1" class="tab-content">
                                             <div class="custom-form">
                                                  <form method="post" action="/acceder/">
                                                       <label>Correo electrónico</label>
                                                       <input name="email" type="text">
                                                       <label>Contraseña</label>
                                                       <input name="pass" type="password">
                                                       <button type="submit" name="login" class="log-submit-btn"><span>Acceder</span></button>
                                                       <div class="clearfix"></div>
                                                  </form>
                                             </div>
                                        </div>
                                        <div class="tab">
                                             <div id="tab-2" class="tab-content">
                                                  <div class="custom-form">
                                                       <form method="post" action="/registrate/" class="main-register-form" id="main-register-form2">
                                                            <label>Nombre</label>
                                                            <input name="rnombre" type="text">
                                                            <label>Correo</label>
                                                            <input name="remail" type="email">
                                                            <label>Contraseña</label>
                                                            <input name="rpassword" type="password">
                                                            <button type="submit" name="register" class="log-submit-btn"><span>Registrarme</span></button>
                                                       </form>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                         </div>
                    </div>

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