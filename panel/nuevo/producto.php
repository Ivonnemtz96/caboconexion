<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/sesion.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/include/funciones.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


date_default_timezone_set('America/Denver');
$fecha = date("Y-m-d H:i:s");

setlocale(LC_ALL, 'es_MX');
$mesr = strftime("%m");
$anor = strftime("%Y");


if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
    extract($_REQUEST);
    if (($nombre == "") & ($subCategoria == "") & ($telefono == "") & ($email == "") & ($descripcion == "")) {
        setcookie("msg", "all", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else if ($nombre == "") {
        setcookie("msg", "nombre", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else if ($subCategoria == "") {
        setcookie("msg", "cat", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else if ($telefono == "") {
        setcookie("msg", "tel", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else if ($email == "") {
        setcookie("msg", "email", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else if (!isEmail($email)) {
        setcookie("msg", "noemail", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else if (($_FILES['thumb']['tmp_name']) == "") {
        setcookie("msg", "nofoto", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else if ($descripcion == "") {
        setcookie("msg", "desc", time() + 2, "/");
        header('location:/panel/nuevo/producto');
        exit;
    } else {



        if (!empty($_FILES['thumb']['tmp_name'])) {

            $thumb = $_FILES['thumb']['tmp_name']; //DEFINIMOS LA VARIABLE THUMB YA SABEMOS QUE SI SE CARGÓ UNA FOTO

            if ($_FILES['thumb']['type'] !== 'image/jpeg') {
                setcookie("msg", "fnv", time() + 2, "/");
                header('location:/panel/nuevo/producto');
                exit;
            }

            if (($_FILES['thumb']['size']) > 1000000) {
                setcookie("msg", "fnvz", time() + 2, "/");
                header('location:/panel/nuevo/producto');
                exit;
            }

            $codigo = GeraHash(10); //LO USAMOS PARA EL NOMBRE DE LA FOTO
            $ruta = '../../upload/productos/' . $anor . '/' . $mesr . '';


            //SI LA CARPETA NO EXISTE LA CREAMOS
            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            //SUBIMOS LA FOTO EN LA CARPETA EXISTENTE O LA CREADA
            $archivo_subido = '' . $ruta . '/' . $codigo . '.jpg';
            move_uploaded_file($thumb, $archivo_subido);
        }


        $catSel = $db->getAllRecords('catSubProd','*','AND id="'.$subCategoria.'" LIMIT 1')[0];


        $casasCount    =    $db->getQueryCount('productos', 'id');
        if ($casasCount[0]['total'] < 10000) {
            $data    =    array(
                'nombre' => $nombre,
                'email' => $email,
                'telefono' => $telefono,
                'fr' => $fecha,
                'descripcion' => $descripcion,
                'fPortada' => $codigo,
                'CatProducto' => $catSel['categoria'],
                'SubCatProducto' => $catSel['id'],
                'lugar' => $lugar,
                'usuario' => ($UserData['id']),
            );
            $insert    =    $db->insert('productos', $data);

            if ($insert) {

                //SUMAMOS +1 A LAS EMPRESAS DE ESTE USUARIO
                $Suma = (($UserData['serCount']) + 1);

                $InsertData    =    array(
                    'serCount' => $Suma,
                );
                $update    =    $db->update('usuarios', $InsertData, array('id' => ($UserData['id']))); //SUMAMOS 1 A SU EXPERIENCIA

                setcookie("msg", "empok", time() + 2, "/");
                header('location:/panel/mis-productos'); //exito
                exit;
            } else {

                setcookie("msg", "ups", time() + 2, "/");
                header('location:/panel/mis-productos'); //sin cambios
                exit;
            }
        } else {

            setcookie("msg", "lim", time() + 2, "/");
            header('location:/panel/mis-productos'); //limite
            exit;
        }
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
            <!--content -->
            <div class="content">
                <!--section -->
                <section>
                    <!-- container -->
                    <div class="container">
                        <!-- profile-edit-wrap -->
                        <div class="profile-edit-wrap">
                            <div class="profile-edit-page-header">
                                <h2><i class="fa fa-plus-circle"></i> Nuevo Producto</h2>
                                <div class="breadcrumbs"><a href="/">Inicio</a><a href="/panel">Panel</a><span>Agregar nuevo producto</span></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/modulos/userMenu.php"); ?>
                                </div>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="col-md-9">
                                        <!-- profile-edit-container-->
                                        <div class="profile-edit-container add-list-container">
                                            <div class="profile-edit-header fl-wrap">
                                                <h4>Información básica.</h4>
                                            </div>
                                            <div class="custom-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Producto <i class="fa fa-briefcase"></i></label>
                                                        <input name="nombre" type="text" placeholder="Nombre para el servicio" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Lugar</label>
                                                        <select name="lugar" data-placeholder="Seleccionar..." class="chosen-select">
                                                            <option value="">Seleccionar</option>
                                                            <?php
                                                            $OptionData = $db->getAllRecords('lugar', '*', 'ORDER BY nombre ASC');
                                                            if (count($OptionData) > 0) {
                                                                foreach ($OptionData as $lugar) { ?>
                                                                    <option value="<?php echo ($lugar['id']); ?>"><?php echo ($lugar['nombre']); ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Tipo de producto</label>
                                                        <select name="subCategoria" data-placeholder="Seleccionar..." class="chosen-select">
                                                            <option value="">Seleccionar</option>

                                                            <?php
                                                            $OptionData = $db->getAllRecords('catSubProd', '*', 'ORDER BY nombre ASC');
                                                            if (count($OptionData) > 0) {
                                                                foreach ($OptionData as $empresa) { ?>
                                                                    <option value="<?php echo ($empresa['id']); ?>"><?php echo ($empresa['nombre']); ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                    <div style="margin-top: 20px;">
                                                        <div class="add-list-media-wrap">
                                                            <span style="margin-right: 25px;">Craga una fotografía deportada.</span>
                                                            <input name="thumb" type="file" class="upload">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Descripción</label>
                                                        <textarea name="descripcion" cols="40" rows="3" placeholder=""></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-edit-container add-list-container">
                                            <div class="profile-edit-header fl-wrap">
                                                <h4>Información de contacto.</h4>
                                            </div>
                                            <div class="custom-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Número de teléfono <i class="fa fa-phone"></i></label>
                                                        <input name="telefono" type="text" placeholder="(624) 100 8090" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Correo electrónico <i class="fa fa-envelope"></i></label>
                                                        <input name="email" type="text" placeholder="info@minegocio.com" />
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>


                                        <div class="profile-edit-container">
                                            <div class="custom-form">
                                                <button type="submit" name="submit" value="submit" class="btn  big-btn  color-bg flat-btn">Enviar<i class="fa fa-angle-right"></i></button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
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
    <script type="text/javascript" src="/js/map-add.js"></script>
</body>

</html>