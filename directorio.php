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
    <title>CaboConexion - Directorio Teléfonico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="/css/reset.css">
    <link type="text/css" rel="stylesheet" href="/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="/css/style.css">
    <link type="text/css" rel="stylesheet" href="/css/color.css">
    <link type="text/css" rel="stylesheet" href="/css/menu.css">

    <link type="text/css" rel="stylesheet" href="/fotorama/fotorama.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">



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


            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/nav.php");?>





                <section class="gray-section">
                    <div class="container">
                        <div class="section-title">
                            <h2>Directorio telefónico</h2>
                            <div class="section-subtitle">Directorio</div>
                            <span class="section-separator"></span>
                            <p>Ubica los negocios de tu localidad.</p>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">

                                <table id="myTable" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Categoria</th>
                                            <th>Ubicación</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Mapa</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $empData = $db->getAllRecords('empresas', '*', 'ORDER BY nombre ASC');
                                        if (count($empData) > 0) {
                                            foreach ($empData as $empresa) {

                                                $catSel = $db->getAllRecords('catEmpresa', '*', 'AND id="' . $empresa['catEmpresa'] . '" LIMIT 1')[0];
                                                $ubiSel = $db->getAllRecords('lugar', '*', 'AND id="' . $empresa['lugar'] . '" LIMIT 1')[0];

                                        ?>
                                                <tr>
                                                    <td><?php echo ($empresa['nombre']); ?></td>
                                                    <td><?php echo ($catSel['nombre']); ?></td>
                                                    <td><?php echo ($ubiSel['nombre']); ?></td>
                                                    <td><a href="mailto:<?php echo ($empresa['email']); ?>"><?php echo ($empresa['email']); ?></a></td>
                                                    <td><a href="tel:<?php echo ($empresa['telefono']); ?>"><?php echo ($empresa['telefono']); ?></a></td>
                                                    <td><a target="_blank" href="https://maps.google.com/?q=<?php echo ($empresa['lat']); ?>,<?php echo ($empresa['lon']); ?>">Ver</a></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Categoria</th>
                                            <th>Ubicación</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Mapa</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                </section>

                <?php
                require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/contador.php");
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzU-BCbU5EaT2F9q8Q7WfwA8XzQfBdK4o&libraries=places&callback=initAutocomplete"></script>

    <script type="text/javascript" src="/js/map_infobox.js"></script>
    <script type="text/javascript" src="/js/markerclusterer.js"></script>
    <script type="text/javascript" src="/js/maps.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
    <script src="/fotorama/fotorama.js"></script>





    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>