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

$busqueda = 0;

//CONDICION PARA REALIZAR LA BUSQUEDA
$condition    =    '';
if (isset($_REQUEST['lug']) and $_REQUEST['lug'] != "") {
    $condition    .=    ' AND lugar LIKE "%' . $_REQUEST['lug'] . '%" ';
}
if (isset($_REQUEST['cat']) and $_REQUEST['cat'] != "") {
    $condition    .=    ' AND catEmpresa ="' . $_REQUEST['cat'] . '" ';
}
if (isset($_REQUEST['subcat']) and $_REQUEST['subcat'] != "") {
    $condition    .=    ' AND catSubEmpresa ="' . $_REQUEST['subcat'] . '" ';
}
if (isset($_REQUEST['nomb']) and $_REQUEST['nomb'] != "") {
    $condition    .=    ' AND nombre LIKE "%' . $_REQUEST['nomb'] . '%" ';
}


if ((isset($_REQUEST['lug']) and $_REQUEST['lug'] != "") or (isset($_REQUEST['cat']) and $_REQUEST['cat'] != "") or (isset($_REQUEST['subcat']) and $_REQUEST['subcat'] != "") or (isset($_REQUEST['nomb']) and $_REQUEST['nomb'] != "")) {

    $busqueda = 1;
    //REESCRIBO $PostData PARA USAR EN EL RESULTADO DE BUSQUEDA
    $PostData    =    $db->getAllRecords('empresas', '*', $condition, 'ORDER BY fr DESC');

    $PostDataCount = (count($PostData));
}



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


                <?php

                if ($busqueda == 0) {

                ?>

                    <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>Ubicar Negocios</h2>
                                <span class="section-separator"></span>
                                <p>Ubica los negocios de tu localidad.</p>
                            </div>
                        </div>
                        <div class="container">

                            <div class="list-single-main-item fl-wrap">

                                <?php $categoriaData = $db->getAllRecords('catEmpresa', '*', 'ORDER BY id DESC');
                                if (count($categoriaData) > 0) {
                                    $y    =    '';
                                    foreach ($categoriaData as $categoria) {
                                        $y++;


                                ?>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3><?php echo $categoria['nombre']; ?></h3>
                                        </div>
                                        <div class="listing-features fl-wrap">
                                            <ul>
                                                <?php $categoriaDataSub = $db->getAllRecords('catSubEmpresa', '*', 'AND categoria="' . ($categoria['id']) . '" ORDER BY id DESC');
                                                if (count($categoriaDataSub) > 0) {
                                                    $y    =    '';
                                                    foreach ($categoriaDataSub as $categoriaSub) {
                                                        //Contadores
                                                        $serviciosCount   =  $db->getQueryCount('empresas', 'id', 'AND catSubEmpresa="' . ($categoriaSub['id']) . '"');
                                                        $serviciosCount   = ($serviciosCount[0]['total']);
                                                        $y++;

                                                ?>

                                                        <li><a href="/empresas?subcat=<?php echo $categoriaSub['id']; ?>"><?php echo $categoriaSub['nombre']; ?></a> (<?php echo $serviciosCount; ?>)</li>

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

                <?php
                } else {
                ?>
                    <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>Tu busqueda en negocios</h2>
                                <span class="section-separator"></span>
                                <p>Encontramos: <?php echo $PostDataCount; ?> resultados.</p>
                            </div>
                        </div>





















                        <div class="container">


                            <div class="list-main-wrap fl-wrap card-listing">

                                <?php if (count($PostData) > 0) {
                                    $y    =    '';
                                    foreach ($PostData as $empresa) {
                                        $y++;

                                        $fav        =    $db->getQueryCount('empFavoritos', 'id', 'AND empresa=' . ($empresa['id']) . '');

                                        $catEmpresa = $db->getAllRecords('catSubEmpresa', '*', 'AND id=' . ($empresa['catSubEmpresa']) . ' LIMIT 1');
                                        $catEmpresa = $catEmpresa[0];

                                        $userEmp    = $db->getAllRecords('usuarios', '*', 'AND id=' . ($empresa['usuario']) . ' LIMIT 1');
                                        $userEmp    = $userEmp[0];

                                        $lugEmp     = $db->getAllRecords('lugar', '*', 'AND id=' . ($empresa['lugar']) . ' LIMIT 1');
                                        $lugEmp     = $lugEmp[0];

                                        if ($userEmp['fPerfil']) {
                                            $fotUserEmp = '/upload/usuarios/' . (strftime("%Y", strtotime(($userEmp['fr'])))) . '/' . (strftime("%m", strtotime(($userEmp['fr'])))) . '/' . ($userEmp['fPerfil']) . '.jpg';
                                        } else {
                                            $fotUserEmp = '/upload/usuarios/default.jpg';
                                        }

                                ?>
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    <img src="/upload/empresas/<?php echo (strftime("%Y/%m", strtotime(($empresa['fr'])))); ?>/<?php echo ($empresa['fPortada']) ?>.jpg" alt="">
                                                    <div class="overlay"></div>
                                                    <div class="list-post-counter"><span><?php echo ($fav[0]['total']); ?></span><a href="/panel/nuevo/favorito?addId=<?php echo $empresa['id']; ?>"><i class="fa fa-heart"></i></a></div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <a class="listing-geodir-category" href="/empresas?subcat=<?php echo $catEmpresa['id']; ?>"><?php echo $catEmpresa['nombre']; ?></a>
                                                    <div class="listing-avatar"><a href="/perfil/<?php echo ($userEmp['id']) ?>"><img src="<?php echo $fotUserEmp; ?>" alt=""></a>
                                                        <span class="avatar-tooltip">Enviado por <strong><?php echo ($userEmp['nombre']) ?></strong></span>
                                                    </div>
                                                    <h3><a href="/empresa/<?php echo ($empresa['id']) ?>"><?php echo $empresa['nombre']; ?></a></h3>
                                                    <p><?php echo (substr(($empresa['descripcion']), 0, 150)); ?>...</p>
                                                    <div class="geodir-category-options fl-wrap">
                                                       
                                                        <div class="geodir-category-location"><a href="/empresas?lug=<?php echo ($lugEmp['id']) ?>" class="map-item scroll-top-map"><i class="fa fa-map-marker"></i> <?php echo ($lugEmp['nombre']) ?></a></div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                <?php

                                    }
                                } else {
                                    echo "<h2>Sin resultados</h2>";
                                }
                                ?>
                            </div>
                        </div>

                    </section>
                <?php
                }
                ?>

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