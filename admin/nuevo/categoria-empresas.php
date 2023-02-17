<?php session_start();
    require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

    if (($UserData['rol'])>2) {
        setcookie("msg","sad",time() + 2, "/");
        header('Location: /');
    }


    //OBTENER RANGO POR ID
    $rol = $db->getAllRecords('roles','*',' AND id="'.($UserData['rol']).'"LIMIT 1 ');
    $rol = $rol[0];
    $rol = ($rol['nombre']);

    
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($nombre==""){
        setcookie("msg","all",time() + 2, "/");
		header('location:/admin/nuevo/categoria-empresas');
		exit;
	}else{
        
		$caractCount	=	$db->getQueryCount('catEmpresa','id');
		if($caractCount[0]['total']<10000){
			$data	=	array(
							'nombre'=>($nombre),
                            
						);
			$insert	=	$db->insert('catEmpresa',$data);
			if($insert){
                setcookie("msg","catok",time() + 2, "/");
				header('location:/admin/nuevo/categoria-empresas');//exito
				exit;
			}else{
                setcookie("msg","ups",time() + 2, "/");
				header('location:/admin/nuevo/categoria-empresas');//sin cambios
				exit;
			}
		} else{
            setcookie("msg","lim",time() + 2, "/");
			header('location:/admin/nuevo/categoria-empresas'); //limite
			exit;
		}
	}
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>CaboConexion - Nueva - Categoría</title>
   <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/css/app.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/jquery-selectric/selectric.css">
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
                <i data-feather="check-circle"></i>
            </li>
            <li class="breadcrumb-item active">Agregar una nueva categoría</li>
        </ul>
         
        
              
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-8">
                <form method="post">
                <div class="card">
                    <div class="card-header">
                        <h4>Agregar una categoría nueva</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input name="nombre" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            
          
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-8">
                <div class="card">
                    <div class="card-header">
                      <h4>Todas las categorías actuales</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>
                                          #
                                        </th>
                                        <th>Nombre</th>
                                        <th class="text-rigth">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $categoriaData = $db->getAllRecords('catEmpresa','*','ORDER BY id DESC');
                                  if (count($categoriaData)>0){
                                      $y	=	'';
                                          foreach($categoriaData as $categoria){
                                              $y++;
                                              ?>
                                              <tr>
                                                  <td><?php echo $y ?></td>
                                                  <td><?php echo $categoria['nombre']; ?></td>
                                                  <td class="text-rigth">
                                                      <a href="/admin/editar/categoria-empresas?editId=<?php echo $categoria['id']; ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                      <a href="/admin/borrar/categoria-empresas?delId=<?php echo $categoria['id']; ?>" onClick="return confirm('Estás seguro? Esto no se puede deshacer');" class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></a>
                                                  </td>
                                              </tr>
						                      
                                          <?php     
                                          }
                                      }
                                  ?>
                                    
                                </tbody>
                            </table>
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
  <script src="/admin/assets/bundles/datatables/datatables.min.js"></script>
  <script src="/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="/admin/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="/admin/assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="/admin/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="/admin/assets/js/custom.js"></script>
  <script src="/admin/assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  
 
    
</body>

</html>