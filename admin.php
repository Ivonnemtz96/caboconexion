<?php session_start();
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/modulos/sesion.php");

    if (($UserData['rol'])>2) {
        setcookie("msg","sad",time() + 1, "/");
        header('Location: /');
    }

    //Contadores
    $userCount   =  $db->getQueryCount('usuarios','id');
    $tUsuarios   = ($userCount[0]['total']);
    //Contadores
    $empCount   =  $db->getQueryCount('empresas','id');
    $tEmpresas   = ($empCount[0]['total']);
  
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
  <title>CaboConexion - Administrador</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/admin/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/css/components.css">
  <link rel="stylesheet" href="/admin/assets/bundles/jqvmap/dist/jqvmap.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/admin/assets/css/custom.css">
  
        
</head>

<body class="light theme-white dark-sidebar">
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
            <li class="breadcrumb-item active">Resumen general</li>
        </ul>
        
        
     
        <div class="section-body">
          
            <div class="row ">
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-blue">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-users"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Usuarios: <?php echo $tUsuarios; ?></h4>
                                <span>Total de usuarios</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-blue">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-map-marker"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Empresas: <?php echo $tEmpresas; ?></h4>
                                <span>Total de empresas</span>
                            </div>
                        </div>
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
  

    
   
    
</body>

</html>