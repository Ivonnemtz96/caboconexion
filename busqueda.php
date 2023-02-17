<?php session_start();
        include_once('config.php');

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        
        if (isset($_SESSION["UserId"])) {
            $UserData =	$db->getAllRecords('usuarios','*',' AND id="'.($_SESSION["UserId"]).'"LIMIT 1 ');
            $UserData = $UserData[0];
            //($UserData['nombres'])
            if ($UserData['fPerfil']){
                $fPerfil = '/upload/usuarios/'.(strftime("%Y", strtotime(($UserData['fr'])))).'/'.(strftime("%m", strtotime(($UserData['fr'])))).'/'.($UserData['fPerfil']).'.jpg';
                } else {$fPerfil = '/upload/usuarios/default.jpg';}
        } 



        //PARA EL CONTADOR GLOBAL
        $tUsu	=	$db->getQueryCount('usuarios','id');
        $tEmp	=	$db->getQueryCount('empresas','id');
        $tPro	=	$db->getQueryCount('productos','id');
        $tSer	=	$db->getQueryCount('servicios','id');
    

        //CONDICION PARA REALIZAR LA BUSQUEDA
        $condition	=	'';
        if(isset($_REQUEST['lug']) and $_REQUEST['lug']!=""){
            $condition	.=	' AND lugar LIKE "%'.$_REQUEST['lug'].'%" ';
        }
        if(isset($_REQUEST['cat']) and $_REQUEST['cat']!=""){
            $condition	.=	' AND catEmpresa LIKE "%'.$_REQUEST['cat'].'%" ';
        }
        if(isset($_REQUEST['subcat']) and $_REQUEST['subcat']!=""){
            $condition	.=	' AND catSubEmpresa LIKE "%'.$_REQUEST['subcat'].'%" ';
        }
        if(isset($_REQUEST['nomb']) and $_REQUEST['nomb']!=""){
            $condition	.=	' AND nombre LIKE "%'.$_REQUEST['nomb'].'%" ';
        }

    
        //REESCRIBO $PostData PARA USAR EN EL RESULTADO DE BUSQUEDA
        $PostData	=	$db->getAllRecords('empresas','*',$condition,'ORDER BY fr DESC');

    
  
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>CaboConexion - Directorio Teléfonico</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="/css/reset.css">
        <link type="text/css" rel="stylesheet" href="/css/plugins.css">
        <link type="text/css" rel="stylesheet" href="/css/style.css">
        <link type="text/css" rel="stylesheet" href="/css/color.css">
        <link type="text/css" rel="stylesheet" href="/css/menu.css">
        
        <link type="text/css" rel="stylesheet" href="/fotorama/fotorama.css">
        <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        
        
       
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
            <!-- header-->
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/header.php");
            
                if(isset($_COOKIE ['msg'])) {
                require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/msg.php");
            } 
            ?>
            
            <style>
                .bus-header input, .main-search-input  {
                    width: 1000px;
                    transition-duration: 1s;
                }
               
                
                @media (max-width: 1930px) {
                  .bus-header input, .main-search-input {
                    width: 900px;
                }
                }
                    
                @media (max-width: 1800px) {
                  .bus-header input, .main-search-input {
                    width: 800px;
                }
                }
                    
                @media (max-width: 1680px) {
                  .bus-header input, .main-search-input {
                    width: 700px;
                }
                }
                    
                @media (max-width: 1560px) {
                  .bus-header input, .main-search-input {
                    width: 600px;
                }
                }
                    
                @media (max-width: 1430px) {
                  .bus-header input, .main-search-input {
                    width: 380px;
                }
                }
                   
                    
                
            

            
            </style>
            
            
            
            <!-- wrapper -->	
            <div id="wrapper">
                <!-- Content-->   
                <div class="content">
                
                    
                    
                                                                                
                                            
                                            
                                            
	<nav class="menu" id="menu">
		<div class="contenedor contenedor-botones-menu">
			<button id="btn-menu-barras" class="btn-menu-barras"><i class="fas fa-bars"></i></button>
			<button id="btn-menu-cerrar" class="btn-menu-cerrar"><i class="fas fa-times"></i></button>
		</div>

		<div class="contenedor contenedor-enlaces-nav">
			<div class="btn-departamentos" id="btn-departamentos">
				<p class="titul-menu">Todos los <span>Departamentos</span></p>
				<i class="fas fa-caret-down"></i>
			</div>

			<div class="enlaces">
				<a href="#">Cupones</a>
				<a href="/directorio">Directorio teléfonico</a>
				<a href="#">Ayuda</a>
			</div>
		</div>

		<div class="contenedor contenedor-grid">
			<div class="grid" id="grid">
				<div class="categorias">
					<button class="btn-regresar"><i class="fas fa-arrow-left"></i> Regresar</button>
					<h3 class="subtitulo">Categorias</h3>
					
					
                    <?php 
                    $categoriaData = $db->getAllRecords('catEmpresa','*',' ORDER BY nombre ASC');
                        if (count($categoriaData)>0){
                            foreach($categoriaData as $categoria){
                            ?>
                            
                            <a href="#" data-categoria="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?><i class="fas fa-angle-right"></i></a>
                                              
                            <?php     
                            }
                        }
                        ?>
                                                            
				</div>

				<div class="contenedor-subcategorias">
				
				    <?php 
                    $categoriaData = $db->getAllRecords('catEmpresa','*',' ORDER BY nombre ASC');
                        if (count($categoriaData)>0){
                            foreach($categoriaData as $categoria){
                                
                                ?>
                                <div class="subcategoria " data-categoria="<?php echo $categoria['id']; ?>">
					               <div class="enlaces-subcategoria">
					                   <button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
					                   <h3 class="subtitulo"><?php echo $categoria['nombre']; ?></h3>
                                
                                
                                <?php
                                $subCategoriaData = $db->getAllRecords('catSubEmpresa','*','AND categoria="'.$categoria['id'].'" ORDER BY nombre ASC');
                                if (count($subCategoriaData)>0){
                                    foreach($subCategoriaData as $subCat){
                                    ?>
                                    
                                    
					                		<a href="/empresas/?cat=<?php echo $categoria['id']; ?>&subcat=<?php echo $subCat['id']; ?>"><?php echo $subCat['nombre']; ?></a>
                                    <?php     
                                    }
                                }
                                ?>
                                    </div>
                                <?php
                                $fotoGData = $db->getAllRecords('empresas','*','AND catEmpresa="'.$categoria['id'].'" ORDER BY rand() LIMIT 1');
                                
                                if (!empty($fotoGData)) { 
                                    
                                    $fotoGData = $fotoGData[0];
                                    ?>
                                    <div class="banner-subcategoria">
                                        <a href="#">
                                            <img src="/upload/empresas/<?php echo (strftime("%Y/%m", strtotime($fotoGData['fr'])));?>/<?php echo $fotoGData['fPortada'] ?>.jpg" alt="">
                                        </a>
                                    </div>
                                    
                                    <div class="galeria-subcategoria">
                                    
                                <?php
                                $fotoGData = $db->getAllRecords('fotosEmp','*','ORDER BY rand() LIMIT 4');
                                if (count($fotoGData)>0){
                                    foreach($fotoGData as $foto){
                                        
                                        $empSel = $db->getAllRecords('empresas','*','AND id="'.$foto['empresa'].'" LIMIT 1');
                                        $empSel = $empSel[0];
                                        
                                    ?>
                                    <a href="#">
					           	        <img src="/upload/empresas/<?php echo (strftime("%Y/%m", strtotime($empSel['fr'])));?>/<?php echo $foto['codigo']; ?>.jpg" alt="">
                                    </a>
					           	       
                                    <?php     
                                    }
                                }
                                ?>
					           	   	    
					           	   </div>
                                    <?php
                                }
                                ?>
					           </div>
                            <?php
                            }
                        }
                        ?>
				</div>
			</div>
		</div>
	</nav>
                                            
                                  
                                        
                   
                    
                    
                    
                    
                 <!-- wrapper -->
            <div id="wrapper">
                <!--  content  -->
                <div class="content">
                    <!--  section  -->
                    
                    <!--  section  -->
                    <section class="gray-bg no-pading no-top-padding" id="sec1">
                        <div class="col-list-wrap  center-col-list-wrap left-list">
                            <div class="container">
                                
                                <div class="list-main-wrap fl-wrap card-listing">
                                    <!-- listing-item -->
                                    
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <img src="images/all/23.jpg" alt="">
                                                <div class="overlay"></div>
                                                <div class="list-post-counter"><span>35</span><i class="fa fa-heart"></i></div>
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <a class="listing-geodir-category" href="listing.html">Hotels</a>
                                                <div class="listing-avatar"><a href="author-single.html"><img src="images/avatar/6.jpg" alt=""></a>
                                                    <span class="avatar-tooltip">Added By  <strong>Kliff Antony</strong></span>
                                                </div>
                                                <h3><a href="listing-single.html">Luxary Hotel</a></h3>
                                                <p>Lorem ipsum gravida nibh vel velit.</p>
                                                <div class="geodir-category-options fl-wrap">
                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5">
                                                        <span>(11 reviews)</span>
                                                    </div>
                                                    <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    
                                    <!-- listing-item end-->
                                    
                                </div>
                                <!-- list-main-wrap end-->
                            </div>
                        </div>
                    </section>
                    <!--  section  end-->
                    <div class="limit-box fl-wrap"></div>
                    <!--  section  -->
                    
                    <!--  section  end-->
                </div>
                <!--  content  end-->
            </div>
            <!-- wrapper end -->
                    
                    <?php   
                        require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/contador.php");
                    ?>
                    
                    
                </div>
                <!-- Content end -->      
            </div>
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
      
        <script type="text/javascript" src="/js/map_infobox.js"></script>
        <script type="text/javascript" src="/js/markerclusterer.js"></script>  
        <script type="text/javascript" src="/js/maps.js"></script>
       
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
        <script src="/fotorama/fotorama.js"></script>

        



        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/menujs.php");?>
  
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready( function () {
    $('#myTable').DataTable();
} );
       
        </script>
    </body>
</html>