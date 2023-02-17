<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


date_default_timezone_set('America/Denver');   
$fecha = date("Y-m-d H:i:s");

setlocale(LC_ALL, 'es_MX'); 
$mesr = strftime("%m");
$anor = strftime("%Y");

function isEmail($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

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
	if(($nombre=="")&($categoria=="")&($telefono=="")&($email=="")&($descripcion=="")){
		header('location:?msg=vacio');
		exit;
	}else if($nombre==""){
		header('location:?msg=nombre');
		exit;
	}else if($categoria==""){
		header('location:?msg=cat');
		exit;
	}else if($email==""){
		header('location:?msg=email');
		exit;
	}else if(!isEmail($email)) {
		header('location:?msg=noemail');
		exit;
	}else if($email==""){
		header('location:?msg=email');
		exit;
	}else {
        
        
         
        if (!empty($_FILES['thumb']['tmp_name'])) {
            
            $thumb = $_FILES['thumb']['tmp_name']; //DEFINIMOS LA VARIABLE THUMB YA SABEMOS QUE SI SE CARGÓ UNA FOTO
            
            if($_FILES['thumb']['type'] !== 'image/jpeg'){ 
		      header('location:?msg=fnv');
		      exit;
            }
            
            if(($_FILES['thumb']['size']) > 1000000){ 
		      header('location:?msg=fnvz');
		      exit;
            }
            
                $codigo = GeraHash(10); //LO USAMOS PARA EL NOMBRE DE LA FOTO
                $ruta = '../../upload/empresas/'.$anor.'/'.$mesr.'';
            
        
                //SI LA CARPETA NO EXISTE LA CREAMOS
                if(!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
	            
                //SUBIMOS LA FOTO EN LA CARPETA EXISTENTE O LA CREADA
	            $archivo_subido = ''.$ruta.'/' . $codigo . '.jpg';
	            move_uploaded_file($thumb, $archivo_subido);
         }
        

		
        if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
            extract($_REQUEST);
			$data	=	array(
							'nombre'=>$nombre,
                            'email'=>$email,
                            'fa'=>$fecha,
                            'fPerfil'=>$codigo,
                            
						);
	       $update	=	$db->update('usuarios',$data,array('id'=>($UserData['id'])));
    
            if($update){
                header('location:?msg=rus'); //Exito en el cmabio
                exit;}
            else{
                header('location:?msg=ups'); //sin cambios
                exit;
            }
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
                                    <h2><i class="fa fa-plus-circle"></i> Nueva Empresa</h2>
                                    <div class="breadcrumbs"><a href="/">Inicio</a><a href="/panel">Panel</a><span>Agregar nueva empresa</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/userMenu.php");?>
                                    </div>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="col-md-9">
                                        <!-- profile-edit-container--> 
                                                <div class="profile-edit-container add-list-container">
                                                <div class="profile-edit-header fl-wrap">
                                                    <h4>Información básica.</h4>
                                                </div>
                                                <div class="custom-form">
                                                    <label>Título <i class="fa fa-briefcase"></i></label>
                                                    <input name="nombre" type="text" placeholder="Nombre de la empresa"/>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Categoría</label>
                                                            <select name="categoria" data-placeholder="Seleccionar..." class="chosen-select" >
                                                               <option value="">Seleccionar</option>
                                                               
                                                                <?php
                                                            $OptionData = $db->getAllRecords('categoriaEmpresa','*','ORDER BY nombre ASC');
                                                            if (count($OptionData)>0){
                                                                foreach($OptionData as $empresa){?>			    		
                                                                        <option value="<?php echo ($empresa['id']);?>"><?php echo ($empresa['nombre']);?></option>
                                                                        <?php 
                                                                    }
                                                                }
                                                            ?>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Número de teléfono <i class="fa fa-phone"></i></label>
                                                            <input name="telefono" type="text" placeholder="Ej. (124) 100-11-22"/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Correo electrónico <i class="fa fa-envelope"></i></label>
                                                            <input name="email" type="text" placeholder="Ej. info@miempresa.com"/>
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
                                                    <label>Direeción<i class="fa fa-map-marker"></i></label>
                                                    <input name="direccion" type="text" placeholder="Dirección del negocio" value=""/>
                                                    <div class="row">
                                                    	<div class="col-md-6">
                                                            <label>Latitud:<i class="fa fa-map-marker"></i></label>
                                                            <input name="lat" type="text" id="lat" placeholder="" value=""/>                                                    
                                                        </div>
                                                    	<div class="col-md-6">
                                                            <label>Longitud:<i class="fa fa-map-marker"></i></label>
                                                            <input name="lon" type="text" id="long" placeholder="" value=""/>                                                    
                                                        </div>
                                                    </div>
                                                    <div class="map-container">
                                                        <div id="singleMap" data-latitude="23.057637448965124" data-longitude="-109.69978713989258"></div>
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