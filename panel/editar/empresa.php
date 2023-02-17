<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/funciones.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Tijuana');   
$fecha = date("Y-m-d H:i:s");

if (isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$empSel  =  $db->getAllRecords('empresas','*','AND id='.($_REQUEST['editId']).' AND usuario='.($UserData['id']).'','LIMIT 1');
}

if (empty($empSel)) { //SI NO EXISTE ES QUE NO HAY UN ID DE PROPIEDAD VÁLIDO Y REDIRECCIONAMOS Y LANZAMOS ERROR
        setcookie("msg","ups",time() + 2, "/");
        header('location:/panel/mis-empresas');
        exit;
    }

$empSel  =  $empSel [0]; //PASAMOS LOS PRIMEROS 2 FILTROS Y SI TENEMOS UNA PROPIEDAD VÁLIDA SELECCIONADA 




if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if(($nombre=="")&($telefono=="")&($email=="")&($descripcion=="")){
        setcookie("msg","all",time() + 2, "/");
		header('location:/panel/editar/empresa?&editId='.$_REQUEST['editId'].'');
		exit;
	}else if($nombre==""){
        setcookie("msg","nombre",time() + 2, "/");
		header('location:/panel/editar/empresa?&editId='.$_REQUEST['editId'].'');
		exit;
	}else if($telefono==""){
        setcookie("msg","tel",time() + 2, "/");
		header('location:/panel/editar/empresa?&editId='.$_REQUEST['editId'].'');
		exit;
	}else if($email==""){
        setcookie("msg","email",time() + 2, "/");
		header('location:/panel/editar/empresa?&editId='.$_REQUEST['editId'].'');
		exit;
	}else if(!isEmail($email)) {
        setcookie("msg","noemail",time() + 2, "/");
		header('location:/panel/editar/empresa?&editId='.$_REQUEST['editId'].'');
		exit;
	}else if($descripcion==""){
        setcookie("msg","desc",time() + 2, "/");
		header('location:/panel/editar/empresa?&editId='.$_REQUEST['editId'].'');
		exit;
	}else {

        $catSel = $db->getAllRecords('catSubEmpresa','*','AND id="'.$categoriaSub.'" LIMIT 1');
        $catSel = $catSel[0];
        
        
         
        $codigo = ($empSel['fPortada']); //SI NO SE SUBE LA FOTO LE DAMOS EL VALOR EXISTENTE QUE YA ESTÁ EN NUESTRA BASE DE DATOS
         
        if (!empty($_FILES['thumb']['tmp_name'])) {
            
            //A ESTE PUNTO SABEMOS QUE SI SUBIÓ UNA FOTO NUEVA, ENTONCES DEBEMOS BORRAR LA EXISTENTE
            if (isset($empSel['fPortada'])){
                $archivo = '../../upload/empresas/'.(strftime("%Y/%m", strtotime(($empSel['fr'])))).'/'.($empSel['fPortada']).'.jpg';
                unlink($archivo); //BORRAMOS LA FOTO ANTIGUA SACANDO EL NOMBRE DE LA BASE DE DATOS
            }
            
            
            $thumb = $_FILES['thumb']['tmp_name']; //DEFINIMOS LA VARIABLE THUMB YA SABEMOS QUE SI SE CARGÓ UNA FOTO NUEVA
            
            if($_FILES['thumb']['type'] !== 'image/jpeg'){ 
                setcookie("msg","fnv",time() + 2, "/");
                header('location:/panel/editar/empresa?editId='.$_REQUEST['editId'].'');
                exit;
            }
            
            if(($_FILES['thumb']['size']) > 1000000){ 
                setcookie("msg","fnvz",time() + 2, "/");
                header('location:/panel/editar/empresa?editId='.$_REQUEST['editId'].'');
                exit;
            }
            
                $codigo = GeraHash(10); //LO USAMOS PARA EL NOMBRE DE LA NUEVA FOTO
            
            
                $ruta = '../../upload/empresas/'.(strftime("%Y/%m", strtotime(($empSel['fr'])))).'';
                
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
                            'telefono'=>$telefono,
                            'web'=>$web,
                            'fa'=>$fecha,
                            'descripcion'=>$descripcion,
                            'fPortada'=>$codigo,
                            'direccion'=>$direccion,
                            'catEmpresa'=>$catSel['categoria'],
                            'catSubEmpresa'=>$categoriaSub,
                            'lat'=>$lat,
                            'lon'=>$lon,
                            'lugar'=>$lugar,
                            'web'=>$web,
                            'usuario'=>($UserData['id']),
                            
						);
            $update	=	$db->update('empresas',$data,array('id'=>($_REQUEST['editId'])));
        
            
			if($update){
                setcookie("msg","empedit",time() + 2, "/");
                header('location:/panel/editar/empresa?editId='.$_REQUEST['editId'].''); //Exito en el cmabio
                exit;}
            else{
                setcookie("msg","ups",time() + 2, "/");
                header('location:/panel/editar/empresa?editId='.$_REQUEST['editId'].''); //sin cambios
                exit;
            }
        }
    }
}

        //OBTENER EL LUGHAR POR ID
        $Lugar = $db->getAllRecords('lugar','*', 'AND id="'.($empSel['lugar']).'"LIMIT 1 ');
        $Lugar = $Lugar[0];
        
        //OBTENER EL CATEGORIA POR ID
        $Categoria = $db->getAllRecords('catEmpresa','*', 'AND id="'.($empSel['catEmpresa']).'"LIMIT 1 ');
        $Categoria = $Categoria[0];

        //OBTENER EL CATEGORIA POR ID
        $CategoriaSub = $db->getAllRecords('catSubEmpresa','*', 'AND id="'.($empSel['catSubEmpresa']).'"LIMIT 1 ');
        $CategoriaSub = $CategoriaSub[0];
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
        
        <style>
            .responsive {
  width: 100%;
  height: auto;
}
        </style>
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
                                    <h2><i class="fa fa-plus-circle"></i> Estás editando: <?php echo ($empSel['nombre'])?></h2>
                                    <div class="breadcrumbs"><a href="/">Inicio</a><a href="/panel">Panel</a><span>Editar negocio</span></div>
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
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Título <i class="fa fa-briefcase"></i></label>
                                                        <input name="nombre" type="text" value="<?php echo ($empSel['nombre'])?>" />
                                                    </div>
                                                    <div class="col-md-6">
                                                            <label>Lugar</label>
                                                            <select name="lugar" data-placeholder="Seleccionar..." class="chosen-select" >
                                                                <option selected value="<?php echo ($Lugar['id']);?>">Actual: <?php echo ($Lugar['nombre']);?></option>
                                                               
                                                                <?php
                                                            $OptionData = $db->getAllRecords('lugar','*','ORDER BY nombre ASC');
                                                            if (count($OptionData)>0){
                                                                foreach($OptionData as $lugar){?>			    		
                                                                        <option value="<?php echo ($lugar['id']);?>"><?php echo ($lugar['nombre']);?></option>
                                                                        <?php 
                                                                    }
                                                                }
                                                            ?>
                                                                
                                                            </select>
                                                        </div>
                                                    
                                                        
                                                        <div class="col-md-12">
                                                            <label>Categoría</label>
                                                            <select name="categoriaSub" data-placeholder="Seleccionar..." class="chosen-select" >
                                                               <option selected value="<?php echo ($CategoriaSub['id']);?>">Actual: <?php echo ($CategoriaSub['nombre']);?></option>
                                                               
                                                                <?php
                                                            $OptionData = $db->getAllRecords('catSubEmpresa','*','ORDER BY nombre ASC');
                                                            if (count($OptionData)>0){
                                                                foreach($OptionData as $empresa){?>			    		
                                                                        <option value="<?php echo ($empresa['id']);?>"><?php echo ($empresa['nombre']);?></option>
                                                                        <?php 
                                                                    }
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div style="margin-top: 20px;">
                                                                <div class="add-list-media-wrap">
                                                                    <img class="responsive" src="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empSel['fr']))));?>/<?php echo (strftime("%m", strtotime(($empSel['fr']))));?>/<?php echo ($empSel['fPortada']) ?>.jpg" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div style="margin-top: 80px;">
                                                                <div class="add-list-media-wrap">
                                                                    <span style="margin-right: 25px;"><i style="color: #4DB7FE;" class="fa fa-picture-o"></i> Cambiar la portada actual.</span>
                                                                    <input name="thumb" type="file" class="upload">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="margin-top: 20px;" class="col-md-12">
                                                            <label>Descripción</label>
                                                            <textarea name="descripcion" cols="40" rows="3" placeholder=""><?php echo ($empSel['descripcion'])?></textarea>
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
                                                            <input name="telefono" type="text" value="<?php echo ($empSel['telefono'])?>" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Correo electrónico <i class="fa fa-envelope"></i></label>
                                                            <input name="email" type="text" value="<?php echo ($empSel['email'])?>" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Direeción<i class="fa fa-map-marker"></i></label>
                                                            <input name="direccion" type="text" value="<?php echo ($empSel['direccion'])?>"/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Pagina web<i class="fa fa-globe"></i></label>
                                                            <input name="web" type="text" value="<?php echo ($empSel['web'])?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-edit-container add-list-container">
                                                <div class="profile-edit-header fl-wrap">
                                                    <h4>Ubicación</h4>
                                                </div>
                                                <div class="custom-form">
                                                    <div class="row">
                                                    	<div class="col-md-6">
                                                            <label>Latitud:<i class="fa fa-map-marker"></i></label>
                                                            <input name="lat" type="text" id="lat" placeholder="" value="<?php echo ($empSel['lat'])?>"/>
                                                        </div>
                                                    	<div class="col-md-6">
                                                            <label>Longitud:<i class="fa fa-map-marker"></i></label>
                                                            <input name="lon" type="text" id="long" placeholder="" value="<?php echo ($empSel['lon'])?>"/>
                                                        </div>
                                                    </div>
                                                    <p style="text-align: left;"><i>Utiliza el marcador de el mapa para cambiar las coordenadas actuales.</i></p>
                                                    <div class="map-container">
                                                        <div id="singleMap" data-latitude="<?php echo ($empSel['lat'])?>" data-longitude="<?php echo ($empSel['lon'])?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-edit-container">
                                                <div class="custom-form">
                                                    <button type="submit" name="submit" value="submit" class="btn  big-btn  color-bg flat-btn">Actualizar<i class="fa fa-angle-right"></i></button>
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