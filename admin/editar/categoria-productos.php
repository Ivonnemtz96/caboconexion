<?php session_start();
    require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

    if (($UserData['rol'])>2) {
        setcookie("msg","sad",time() + 2, "/");
        header('Location: /');
    }

    //Contadores
    $userCount   =  $db->getQueryCount('usuarios','id');
    $tUsuarios   = ($userCount[0]['total']);

    //OBTENER RANGO POR ID
    $rol = $db->getAllRecords('roles','*',' AND id="'.($UserData['rol']).'"LIMIT 1 ');
    $rol = $rol[0];
    $rol = ($rol['nombre']);



    
if (isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$categoria  =  $db->getAllRecords('catProducto','*',' AND id="'.$_REQUEST['editId'].'"','LIMIT 1');
    
        if (empty($categoria)) { //SI NO EXISTE ES QUE NO HAY UN ID VALIDO Y REDIRECCIONAMOS Y LANZAMOS ERROR
            setcookie("msg","ups",time() + 2, "/");
            header('location:/admin/nuevo/categoria-productos');
            exit;
        } else {$categoria  =  $categoria [0];}
    


if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
    
	if($nombre==""){
        setcookie("msg","all",time() + 2, "/");
		header('location: ');
		exit;
	}else{


		
        if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
            extract($_REQUEST);
			$data	=	array(
							'nombre'=>($nombre),
                            
						);
	       $update	=	$db->update('catProducto',$data,array('id'=>($_REQUEST['editId'])));
    
            if($update){
                setcookie("msg","catup",time() + 2, "/");
                header('location:/admin/nuevo/categoria-productos'); //Exito en el cmabio
                exit;}
                else{
                    setcookie("msg","ups",time() + 2, "/");
                    header('location:/admin/nuevo/categoria-productos'); //sin cambios
                    exit;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>CaboConexion - Editar - Catgoría</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/css/app.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/admin/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/admin/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/admin/assets/img/favicon.ico' />
  
       
</head>

<body class="light theme-white dark-sidebar">
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        
      
        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/admin/modulos/navUser.php"); ?>
        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/admin/modulos/menu-principal.php"); ?>
     
     
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
         
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
                <a href="/admin"><h4 class="page-title m-b-0">Panel de control</h4></a>
            </li>
            <li class="breadcrumb-item">
                <i data-feather="edit"></i>
            </li>
            <li class="breadcrumb-item active">Editar una categoría</li>
        </ul>
         
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php
                //MENSAJES DE ESTATUS
                if(isset($_COOKIE["msg"])) {
                require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/msg.php");
                } ?>
            </div>
        </div>
          
        
        
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-8">
                <form method="post">
                <div class="card">
                    <div class="card-header">
                        <h4>Estás editando: <?php echo ($categoria['nombre']);?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input name="nombre" value="<?php echo ($categoria['nombre']);?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-primary" href="/admin/nuevo/categorias-productos"><i class="fas fa-angle-double-left"></i> Volver</a>
                                <button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Actualizar</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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
  <script src="/admin/assets/bundles/cleave-js/dist/cleave.min.js"></script>
  <script src="/admin/assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="/admin/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="/admin/assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="/admin/assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="/admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <script src="/admin/assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="/admin/assets/js/page/forms-advanced-forms.js"></script>
  <!-- Template JS File -->
  <script src="/admin/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="/admin/assets/js/custom.js"></script>
 
</body>

</html>