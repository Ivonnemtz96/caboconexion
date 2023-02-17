<?php session_start();
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/modulos/sesion.php");

    if (($UserData['rol'])>2) {
        setcookie("msg","sad",time() + 1, "/");
        header('Location: /');
    }

    //Contadores
    $userCount   =  $db->getQueryCount('usuarios','id');
    $tUsuarios   = ($userCount[0]['total']);

    $pedCount	 =	$db->getQueryCount('pedidos','*','AND status="3" ');
    $tPedidos   = ($pedCount[0]['total']);

  
    //OBTENER RANGO POR ID
    $rol = $db->getAllRecords('roles','*',' AND id="'.($UserData['rol']).'"LIMIT 1 ');
    $rol = $rol[0];
    $rol = ($rol['nombre']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Transportadora - Administrador</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/admin/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/css/components.css">
  <link rel="stylesheet" href="/admin/assets/bundles/jqvmap/dist/jqvmap.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/admin/assets/css/custom.css">
  
        
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        
      
        <?php
        require_once($_SERVER["DOCUMENT_ROOT"]."/admin/modulos/navUser.php");
        require_once($_SERVER["DOCUMENT_ROOT"]."/admin/modulos/menu-principal.php");
                
        if(isset($_COOKIE['msg'])) {
            require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/msg.php");
            } ?>
     
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
         
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
                <a href="/admin"><h4 class="page-title m-b-0">Panel de control</h4></a>
            </li>
            <li class="breadcrumb-item">
                <i data-feather="home"></i>
            </li>
            <li class="breadcrumb-item active">Mensajes de status</li>
        </ul>
        
                  
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-statistic-5">
                        <div class="info-box7-block">
                            <div class="row ">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <h6 class="m-b-20 text-right">Total de usuarios</h6>
                                    <h4 class="text-right"><span><?php echo $tUsuarios; ?></span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-statistic-5">
                        <div class="info-box7-block">
                            <div class="row ">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <h6 class="m-b-20 text-right">Total de tours vendidos</h6>
                                    <h4 class="text-right"><span><?php echo $tPedidos; ?></span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Line Chart</h4>
                    </div>
                    <div class="card-body">
                        <div id="line_chart" class="graph"></div>
                    </div>
                </div>
            </div>
        </div>
            
        </section>
        
        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/admin/modulos/settings.php"); ?>
          
      </div>
       
        <footer class="main-footer">
            <div class="footer-left">Copyright &copy; 2020 <div class="bullet"></div> Creado por <a target="_blank" href="http://bananagroup.mx">Banana Group</a></div>
            <div class="footer-right"></div>
        </footer>
        
    </div>
</div>

      <!-- General JS Scripts -->
      <script src="/admin/assets/js/app.min.js"></script>
      <!-- JS Libraies -->
      <script src="/admin/assets/bundles/morris/morris.min.js"></script>
      <script src="/admin/assets/bundles/morris/raphael-min.js"></script>
      <!-- Template JS File -->
      <script src="/admin/assets/js/scripts.js"></script>
      <!-- Custom JS File -->
      <script src="/admin/assets/js/custom.js"></script>
  
      <script>
    
        "use strict";
$(function () {
  getMorris("line", "line_chart");
});

function getMorris(type, element) {
  if (type === "line") {
    Morris.Line({
      element: element,
      data: [
        {
          period: "2008",
          iphone: 35,
          ipad: 67,
          itouch: 15,
        },
        {
          period: "2009",
          iphone: 140,
          ipad: 189,
          itouch: 67,
        },
        {
          period: "2010",
          iphone: 50,
          ipad: 80,
          itouch: 22,
        },
        {
          period: "2011",
          iphone: 180,
          ipad: 220,
          itouch: 76,
        },
        {
          period: "2012",
          iphone: 130,
          ipad: 110,
          itouch: 82,
        },
        {
          period: "2013",
          iphone: 80,
          ipad: 60,
          itouch: 85,
        },
        {
          period: "2014",
          iphone: 78,
          ipad: 205,
          itouch: 135,
        },
        {
          period: "2015",
          iphone: 180,
          ipad: 124,
          itouch: 140,
        },
        {
          period: "2016",
          iphone: 105,
          ipad: 100,
          itouch: 85,
        },
        {
          period: "2017",
          iphone: 210,
          ipad: 180,
          itouch: 120,
        },
      ],
      xkey: "period",
      ykeys: ["iphone", "ipad", "itouch"],
      labels: ["iPhone", "iPad", "iPod Touch"],
      pointSize: 3,
      fillOpacity: 0,
      pointStrokeColors: ["#222222", "#cccccc", "#f96332"],
      behaveLikeLine: true,
      gridLineColor: "#e0e0e0",
      lineWidth: 2,
      hideHover: "auto",
      lineColors: ["#222222", "#20B2AA", "#f96332"],
      resize: true,
    });
  }  
}

        
    </script>
    
   
    
</body>

</html>