<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");


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
                                    <h2><i class="fa fa-building"></i> Mis servicios</h2>
                                    <div class="breadcrumbs"><a href="/">Inicio</a><a href="/panel">Panel</a><span>Mis servicios</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/userMenu.php");?>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="dashboard-list-box fl-wrap">
                                            
                                            
                                            <?php 
                
                                            //VERIFICAMOS SI YA TIENE CASAS REGISTRADAS PARA LLAMAR A ESTE MODULO, SI NO, NO XD
                                            if (($UserData['serCount'])>0) { 
                                                require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/userListaServicios.php");
                                            } else { echo '<div class="dashboard-header fl-wrap">
                                                <h3>Aún no haz registrado servicios.</h3>
                                            </div>'; }
                                            ?>
                                            
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