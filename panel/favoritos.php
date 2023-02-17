<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Denver');   
$fecha = date("Y-m-d H:i:s");


$favData = $db->getAllRecords('empFavoritos','*','AND usuario='.($UserData['id']).'');

?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>CaboConexion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
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
            
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/header.php");
            
            if(isset($_COOKIE ['msg'])) {
                require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/msg.php");
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
                                    <h2><i class="fa fa-building"></i> Mis Empresas</h2>
                                    <div class="breadcrumbs"><a href="/">Inicio</a><a href="/panel">Panel</a><span>Mis empresas</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/userMenu.php");?>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="dashboard-list-box fl-wrap">
                                            <div class="dashboard-header fl-wrap">
                                                <h3>Estás son tus favoritos:</h3>
                                            </div>
                                            
                                            
                                            <?php
                        if (count($favData)>0){
                                
                            foreach ($favData as $favorito) {
                                $empSel = $db->getAllRecords('empresas','*','AND id='.($favorito['empresa']).'','LIMIT 1');
                                $empSel = $empSel[0];
                                ?>
                                <!-- dashboard-list end-->    
                                    <div class="dashboard-list">
                                        <div class="dashboard-message">
                                            <div class="dashboard-listing-table-image">
                                                <a href="#"><img src="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empSel['fr']))));?>/<?php echo (strftime("%m", strtotime(($empSel['fr']))));?>/<?php echo ($empSel['fPortada']) ?>.jpg" alt=""></a>
                                            </div>
                                            <div class="dashboard-listing-table-text">
                                                <h4><a href="#"><?php echo ($empSel['nombre']) ?></a></h4>
                                                <p><?php echo (substr(($empSel['descripcion']), 0, 250));?>...</p>
                                                <ul class="dashboard-listing-table-opt  fl-wrap">
                                                    <li><a href="/empresa/<?php echo ($empSel['id']) ?>">Ver <i class="fa fa-globe"></i></a></li>
                                                    <li><a href="/panel/quitar/favorito?delId=<?php echo ($favorito['id']) ?>" class="del-btn">Eliminar <i class="fa fa-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
        
                                <?php  
                            } 
                        } else { ?> <h2>Aún no tienes favoritos</h2> <?php } ?>
                                            
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
            
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/footer.php");?>
            
            
            <!--footer end  -->
            <!--register form -->
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/login.php");?>
            
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