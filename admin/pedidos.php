<?php session_start();
    require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

    if (($UserData['rol'])>2) {
        header('Location: /?msg='.urlencode(encrypt("sad",$keyEN)).'');
    }


    //OBTENER RANGO POR ID
    $rol = $db->getAllRecords('roles','*',' AND id="'.($UserData['rol']).'"LIMIT 1 ');
    $rol = $rol[0];
    $rol = ($rol['nombre']);
    
    date_default_timezone_set('America/Tijuana');
    setlocale(LC_ALL, 'es_MX'); 
    

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Transportadora - Usuarios</title>
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
                <i data-feather="users"></i>
            </li>
            <li class="breadcrumb-item active">Pedidos</li>
        </ul>
         
                  
        
        
        <div class="row">
                        
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                      <h4>Todos los pedidos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tour</th>
                                        <th>Destino</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Generado</th>
                                        <th>Total</th>
                                        <th>Pago</th>
                                        <th>Estado</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $pedData = $db->getAllRecords('pedidos','*','ORDER BY fr DESC');
                                  if (count($pedData)>0){
                                      $y	=	'';
                                          foreach($pedData as $pedido){
                                              
                                              $tourSel = $db->getAllRecords('tours','*','AND id='.$pedido['tour'].'','LIMIT 1');
                                              $tourSel = $tourSel[0];
                                              
                                              $LugarTour = $db->getAllRecords('lugar','*','AND id='.$tourSel['lugar'].'','LIMIT 1');
                                              $Lugar = $LugarTour[0]['nombre'];
                                              
                                              $total = ($tourSel['preAd'])*($pedido['adultos']);
                                              $total+= ($tourSel['preNi'])*($pedido['menores']);
                                              
                                              $y++;
                                                
                                              ?>
                                              <tr>
                                                  <td><?php echo $y ?></td>
                                                  <td><?php echo $tourSel['nombre']; ?></td>
                                                  <td><?php echo $Lugar; ?></td>
                                                  <td><?php echo $pedido['nombre']; ?></td>
                                                  <td><?php echo $pedido['email']; ?></td>
                                                  <td><?php echo $pedido['telefono']; ?></td>
                                                  <td><?php echo (strftime("%d de %B del %G", strtotime($pedido['fr']))); ?></td>
                                                  <td>$<?php echo number_format($total); ?></td>
                                                  <td><?php if ($pedido['amountPaypal']=="") { echo ""; } else {  echo '$ '.number_format($pedido['amountPaypal']).''; }  ?></td>
                                                  <td class="text-center">
                                                      <div class="badge badge-<?php if ($pedido['status']==3) { echo"success";} else { echo"danger";}?> badge-shadow">
                                                          <?php if ($pedido['status']==3) { echo"Pagado";} else { echo"Cancelado";}?>
                                                      </div>
                                                  </td>
                                                  <td class="text-center">
                                                     <?php 
                                                        if ($pedido['status']==3) { ?> 
				            			                 <a target="_blank" href="/compra?tokenPed=<?php echo $pedido['codigo']; ?>" class="btn btn-icon btn-primary">ver <i class="fas fa-arrow-right"></i><i class="fas fa-file-invoice-dollar"> </i></a>
				            			             <?php } ?>
                                                     
                                                      
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