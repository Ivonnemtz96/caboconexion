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
    <title>Negocios - CaboConexion</title>
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
            <!-- Content-->

            <div class="content">

                <section class="gray-section">
                    <div class="container">
                        <div class="section-title">
                            <h2>Contrata servicios</h2>
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
    <script type="text/javascript" src="/js/markerclusterer.js"></script>



</body>

</html>