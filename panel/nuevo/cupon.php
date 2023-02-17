<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Mexico_City');   
$fecha = date("Y-m-d H:i:s");


if (isset($_REQUEST['empId']) and $_REQUEST['empId']!=""){
	$empresa  =  $db->getAllRecords('empresas','*',' AND id="'.$_REQUEST['empId'].'" AND usuario="'.($UserData['id']).'" LIMIT 1');
}

if (empty($empresa)) { //SI NO EXISTE ES QUE NO HAY UN ID DE PROPIEDAD VÁLIDO Y REDIRECCIONAMOS Y LANZAMOS ERROR
        setcookie("msg","ups",time() + 2, "/");
        header('location:/panel/mis-empresas');
        exit;
    }

$empresa  =  $empresa [0]; //PASAMOS LOS PRIMEROS 2 FILTROS Y SI TENEMOS UNA PROPIEDAD VÁLIDA SELECCIONADA 


//GENERAR CODIGO ALEATORIO
function GeraHash($qtd){ 
$Caracteres = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
$QuantidadeCaracteres = strlen($Caracteres); 
$QuantidadeCaracteres--; 

$Hash=NULL; 
    for($x=1;$x<=$qtd;$x++){ 
        $Posicao = rand(0,$QuantidadeCaracteres); 
        $Hash .= substr($Caracteres,$Posicao,1); 
    } 

return $Hash; 
}




if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
    
	if(($_FILES['thumb']['tmp_name'])==""){
        setcookie("msg","nofoto",time() + 2, "/");
		header('location:/panel/nuevo/cupon/?empId='.($empresa['id']).'');
		exit;
	}else{
        
            if (($empresa['fotCount'])<6) {
                
         
        
            if($_FILES['thumb']['type'] !== 'image/jpeg'){ 
                setcookie("msg","fnv",time() + 2, "/");
                header('location: /panel/nuevo/cupon/?empId='.($empresa['id']).'');
		      exit;
            }
            
            if(($_FILES['thumb']['size']) > 1000000){ 
                setcookie("msg","fnvz",time() + 2, "/");
                header('location: /panel/nuevo/cupon/?empId='.($empresa['id']).'');
		      exit;
            }
        
                $thumb = $_FILES['thumb']['tmp_name']; //DEFINIMOS LA VARIABLE THUMB YA SABEMOS QUE SI SE CARGÓ Y PASÓ LOS FILTROS
            
                $codigo = GeraHash(10); //LO USAMOS PARA EL NOMBRE DE LA FOTO
            
                $ruta = '../../upload/cupones/'.(strftime("%Y/%m", strtotime(($empresa['fr'])))).'';
            
        
                //SI LA CARPETA NO EXISTE LA CREAMOS
                if(!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
	            
                //SUBIMOS LA FOTO EN LA CARPETA EXISTENTE O LA CREADA
	            $archivo_subido = ''.$ruta.'/' . $codigo . '.jpg';
	            move_uploaded_file($thumb, $archivo_subido);
        
        
        
		$FotosCount	=	$db->getQueryCount('empCupones','id');
		if($FotosCount[0]['total']<10000){
			$data	=	array(
							'codigo'=>$codigo,
							'empresa'=>($empresa['id']),
							'usuario'=>($UserData['id']),
                            
						);
			$insert	=	$db->insert('empCupones',$data);
            
            
            
			if($insert){
                
                    //SUMAMOS +1 A LAS PROPIEDADES DE ESTE USUARIO
                    $SumFotos = (($empresa['cupCount'])+1);
            
                    $InsertData	=	array(
                        'cupCount'=> $SumFotos,
                        );
                    
                    $update	=	$db->update('empresas',$InsertData,array('id'=>($empresa['id'])));//SUMAMOS 1 A SU EXPERIENCIA
                setcookie("msg","cupok",time() + 2, "/");
				header('location:/panel/nuevo/cupon/?empId='.($empresa['id']).'');//exito
				exit;
			}else{
                setcookie("msg","ups",time() + 2, "/");
				header('location:/panel/nuevo/cupon/?empId='.($empresa['id']).'');//sin cambios
				exit;
			}
		} else{
            setcookie("msg","lim",time() + 2, "/");
			header('location:/panel/nuevo/cupon/?empId='.($empresa['id']).''); //limite
			exit;
		      }
        
        } else{
            setcookie("msg","limFot",time() + 2, "/");
			header('location:/panel/nuevo/cupon/?empId='.($empresa['id']).''); //limite
			exit;
		      }
        
	}
}
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
                                    <h2><i class="fa fa-picture-o"></i> Agregar cupon</h2>
                                    <div class="breadcrumbs"><a href="/">Inicio</a><a href="/panel/mis-empresas">Mis empresas</a><span>Cupones</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/userMenu.php");?>
                                    </div>
                                    <div class="col-md-9">
                                            <div class="dashboard-header fl-wrap">
                                                <h3>Estás editando los cupones de: <?php echo ($empresa['nombre'])?></h3>
                                            </div>
                                            <div class="list-single-main-item fl-wrap" id="sec3">
                                    
                                            <!-- gallery-items   -->
                                            <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">
                                                
                                                <?php
                                    //VERIFICAMOS SI YA TIENE FOTOS EN LA GALERIA
                                    if (($empresa['cupCount'])>0) { 
                    
                                        } else { echo "<h4>Aún no haz subido fotos para este negocio.</h4>"; }
                                    ?>
                                    <?php $fotosData = $db->getAllRecords('empCupones','*','AND empresa='.($empresa['id']).'','ORDER BY id DESC LIMIT '.($empresa['cupCount']).'');
                                    if (count($fotosData)>0){
                                        $y	=	'';
                                            foreach($fotosData as $foto){
                                                $y++;                   
                                                ?>
									            	<!-- 2 -->
                                                    <div class="gallery-item">
                                                        <div class="grid-item-holder">
                                                            <div class="box-item">
                                                                <img  src="/upload/cupones/<?php echo (strftime("%Y", strtotime(($empresa['fr']))));?>/<?php echo (strftime("%m", strtotime(($empresa['fr']))));?>/<?php echo ($foto['codigo']) ?>.jpg"   alt="">
                                                                <a href="/upload/cupones/<?php echo (strftime("%Y", strtotime(($empresa['fr']))));?>/<?php echo (strftime("%m", strtotime(($empresa['fr']))));?>/<?php echo ($foto['codigo']) ?>.jpg" class="gal-link popup-image"><i class="fa fa-search-plus"  ></i></a>
                                                            </div>
                                                            <a style="color: red; margin-top: 10px;" href="/panel/borrar/cupon?delId=<?php echo ($foto['id']); ?>"><i class="fa fa-times" ></i>Borrar</a>
                                                        </div>
                                                    </div>
                                                <?php  
                                            }
                                        }
                                    ?>
                                               
                                                
                                                
                                                <!-- 7 end -->
                                            </div>
                                            <!-- end gallery items -->                                 
                                        </div>
                                            
                                            
                                            
                                        
                                    
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="col-md-9">
                                        <!-- profile-edit-container--> 
                                                <div class="profile-edit-container add-list-container">
                                                    
                                                <div class="custom-form">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-12">
                                                            <div style="margin-top: 20px;">
                                                                <div class="add-list-media-wrap">
                                                                    <span style="margin-right: 25px;"><i style="color: #4DB7FE;" class="fa fa-picture-o"></i> Craga un nuevo cupón. Imágenes JPG de max 1 MB</span>
                                                                    <input name="thumb" type="file" class="upload">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="profile-edit-container">
                                                <div class="custom-form">
                                                    <button type="submit" name="submit" value="submit" class="btn  big-btn  color-bg flat-btn">Subir<i class="fa fa-angle-right"></i></button>
                                                </div>
                                            </div>
                                         
                                        </div>
                                        
                                    </form>
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