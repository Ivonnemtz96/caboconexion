<?php session_start();
        include_once('config.php');
        require_once($_SERVER["DOCUMENT_ROOT"]."/include/funciones.php");

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

        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!isset($_REQUEST['id'])) {
         
        echo "ERROR 10";
        exit();
        } 
        
        $empData =	$db->getAllRecords('empresas','*',' AND id="'.$_REQUEST['id'].'"LIMIT 1 ');
        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!($empData)) {
        echo "ERROR 20";
        exit();
        }

        $empData = $empData[0];
        
        //SUMAMOS +1 A LAS IMPRECIONES DEL ANUNCIO
        $SumImpreciones = (($empData['visitas'])+1);
    
        $InsertData	=	array(
            'visitas'=> $SumImpreciones,
        );
        $update	 =  $db->update('empresas',$InsertData,array('id'=>($empData['id'])));//ACTUALIZAMOS LAS IMPRECIONES



        //OBTENER MÁS DATOS DE LA EMPRESA

        $catEmpresa = $db->getAllRecords('catEmpresa','*','AND id='.($empData['catEmpresa']).' LIMIT 1');
        $catEmpresa = $catEmpresa [0];

        $catSubEmpresa = $db->getAllRecords('catSubEmpresa','*','AND id='.($empData['catSubEmpresa']).' LIMIT 1');
        $catSubEmpresa = $catSubEmpresa [0];

        $userEmp = $db->getAllRecords('usuarios','*','AND id='.($empData['usuario']).' LIMIT 1');
        $userEmp = $userEmp [0];

        $lugEmp = $db->getAllRecords('lugar','*','AND id='.($empData['lugar']).' LIMIT 1');
        $lugEmp = $lugEmp [0];

        $fav    =	$db->getQueryCount('empFavoritos','id','AND empresa='.($empData['id']).'');

        if ($userEmp['fPerfil']) {
            $fotUserEmp = '/upload/usuarios/'.(strftime("%Y", strtotime(($userEmp['fr'])))).'/'.(strftime("%m", strtotime(($userEmp['fr'])))).'/'.($userEmp['fPerfil']).'.jpg';
            } else {$fotUserEmp = '/upload/usuarios/default.jpg';}


        if ($empData['reviewCount']>0){
            $reviewsData = $db->getAllRecords('reviewsEmp','*','AND empresa='.($empData['id']).'','ORDER BY id DESC LIMIT '.($empData['reviewCount']).'');
            
            if (count($reviewsData)>0) {
                
                $calificacionRev=0;
                foreach($reviewsData as $review) {
                    $calificacionRev += $review['calificacion'];
                }
            }
            
            $promedioRev = $calificacionRev/$empData['reviewCount'];
            $promedioRev = round($promedioRev, 0, PHP_ROUND_HALF_DOWN);
        }


    
    
  
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title><?php echo $empData['nombre']; ?> - CaboConexion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content="<?php echo (substr(($empData['descripcion']), 0, 150));?>..."/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="/css/reset.css">
        <link type="text/css" rel="stylesheet" href="/css/plugins.css">
        <link type="text/css" rel="stylesheet" href="/css/style.css">
        <link type="text/css" rel="stylesheet" href="/css/color.css">
        <link type="text/css" rel="stylesheet" href="/css/menu.css">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="images/favicon.ico">
        
        <!--=============== favicons ===============-->
        <meta property="og:site_name"         content="<?php echo $empData['nombre']; ?> - CaboConexion"/> 
        <meta property="fb:author"            content="CaboConexion" />
        <meta property="og:rich_attachment"   content="true"/>
        <meta property="og:image"             content="/upload/empresas/<?php echo (strftime("%Y/%m", strtotime(($empData['fr']))));?>/<?php echo ($empData['fPortada']) ?>.jpg" />
        <meta property="og:type"              content="website"/>
        <meta property="og:title"             content="<?php echo $empData['nombre']; ?> - CaboConexion"/>
        <meta property="og:description"       content="<?php echo (substr(($empData['descripcion']), 0, 150));?>..."/>
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
            
            
            <!-- wrapper -->	
            <div id="wrapper">
                <!-- Content-->   
                
                <div class="content">

                    <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/nav.php");?>

                    <!--  section  --> 
                    <section class="parallax-section single-par list-single-section" data-scrollax-parent="true" id="sec1">
                        <div class="bg par-elem "  data-bg="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empData['fr']))));?>/<?php echo (strftime("%m", strtotime(($empData['fr']))));?>/<?php echo ($empData['fPortada']) ?>.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
                        <div class="overlay"></div>
                        <div class="bubble-bg"></div>
                        <div class="list-single-header absolute-header fl-wrap">
                            <div class="container">
                                <div class="list-single-header-item">
                                    <div class="list-single-header-item-opt fl-wrap">
                                        <div class="list-single-header-cat fl-wrap">
                                            <a href="/empresas/?subcat=<?php echo $catSubEmpresa['id']; ?>"><?php echo $catSubEmpresa['nombre']; ?></a>
                                            <?php if ($empData['verificado']==1) { ?>
                                            <span>Verificado <i class="fa fa-check"></i></span>
                                            <?php
                                            } 
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <h2><?php echo $empData['nombre']; ?> <span> - Enviado por </span><a href="author-single.html"><?php echo $userEmp['nombre']; ?></a> </h2>
                                    <span class="section-separator"></span>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $promedioRev; ?>">
                                        <span>(<?php echo $empData['reviewCount']; if ($empData['reviewCount']>1) {echo" reseñas";} else {echo" reseña";}?>)</span>
                                    </div>
                                    <div class="list-post-counter single-list-post-counter"><span><?php echo ($fav[0]['total']);?></span><i class="fa fa-heart"></i></div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="list-single-header-contacts fl-wrap">
                                                <ul>
                                                    <li><i class="fa fa-phone"></i><a  href="#"><?php echo $empData['telefono']; ?></a></li>
                                                    <li><i class="fa fa-map-marker"></i><a  href="#"><?php echo $lugEmp['nombre']; ?></a></li>
                                                    <li><i class="fa fa-envelope-o"></i><a  href="#"><?php echo $empData['email']; ?></a></li>
                                                    <?php if ($empData['verificado']==0) { ?>
                                                        <li><i class="fa fa-handshake-o"></i><a class="modal-reclamar"  href="#">¡Reclama este negocio!</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fl-wrap list-single-header-column">
                                                <div class="share-holder hid-share">
                                                    <div class="showshare"><span>Compartir </span><i class="fa fa-share"></i></div>
                                                    <div class="share-container  isShare"></div>
                                                </div>
                                                <span class="viewed-counter"><i class="fa fa-eye"></i> Vistas -  <?php echo $empData['visitas']; ?> </span>
                                                <a class="custom-scroll-link" href="#sec5"><i class="fa fa-hand-o-right"></i>Envía una reseña </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--  section end --> 
                    <div class="scroll-nav-wrapper fl-wrap">
                        <div class="container">
                            <nav class="scroll-nav scroll-init">
                                <ul>
                                    <li><a class="act-scrlink" href="#sec1">Top</a></li>
                                    <li><a href="#sec3">Galería</a></li>
                                    <li><a href="#sec2">Detalles</a></li>
                                    <li><a href="#sec4">Cupones</a></li>
                                </ul>
                            </nav>
                            <a href="/panel/nuevo/favorito?addId=<?php echo $empData['id']; ?>" class="save-btn"> <i class="fa fa-heart"></i> Favorito </a>
                        </div>
                    </div>
                    <!--  section  --> 
                    <section class="gray-section no-top-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="list-single-main-wrapper fl-wrap">
                                        <div class="breadcrumbs gradient-bg  fl-wrap">
                                            <a href="/">Inicio</a>
                                            <a href="/empresas">Empresas</a>
                                            <span><strong><?php echo $empData['nombre']; ?></strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                        <div class="list-single-main-item fl-wrap" id="sec3">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Galería</h3>
                                            </div>
                                            <!-- gallery-items   -->
                                            <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">
                                                
                                    <?php           //VERIFICAMOS SI YA TIENE FOTOS EN LA GALERIA
                                    if (($empData['fotCount'])>0) { 
                    
                                        } else { echo "<h4>Aún no se han publicado fotos para este negocio.</h4>"; }
                                    ?>
                                    <?php $fotosData = $db->getAllRecords('fotosEmp','*','AND empresa='.($empData['id']).'','ORDER BY id DESC LIMIT '.($empData['fotCount']).'');
                                    if (count($fotosData)>0){
                                        $y	=	'';
                                            foreach($fotosData as $foto){
                                                $y++;                   
                                                ?>
									            	<!-- 2 -->
                                                    <div class="gallery-item">
                                                        <div class="grid-item-holder">
                                                            <div class="box-item">
                                                                <img  src="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empData['fr']))));?>/<?php echo (strftime("%m", strtotime(($empData['fr']))));?>/<?php echo ($foto['codigo']) ?>.jpg"   alt="">
                                                                <a href="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empData['fr']))));?>/<?php echo (strftime("%m", strtotime(($empData['fr']))));?>/<?php echo ($foto['codigo']) ?>.jpg" class="gal-link popup-image"><i class="fa fa-search-plus"  ></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php  
                                            }
                                        }
                                    ?>
                                            </div>
                                            <!-- end gallery items -->                                 
                                        </div>
                                        
                                        
                                        
                                        <div class="list-single-main-item fl-wrap" id="sec2">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Sobre <strong><?php echo $empData['nombre']; ?></strong>:</h3>
                                            </div>
                                            <p><?php echo nl2br($empData['descripcion']); ?></p>
                                        </div>
                                        
                                        
                                        <div class="list-single-main-item fl-wrap" id="sec4">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Cupones</h3>
                                            </div>
                                            <!-- gallery-items   -->
                                            <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">
                                                
                                    <?php           //VERIFICAMOS SI YA TIENE FOTOS EN LA GALERIA
                                    if (($empData['cupCount'])>0) { 
                    
                                        } else { echo "<h4>Aún no se han dado de alta cupones para este negocio.</h4>"; }
                                    ?>
                                    <?php $fotosData = $db->getAllRecords('empCupones','*','AND empresa='.($empData['id']).'','ORDER BY id DESC LIMIT '.($empData['cupCount']).'');
                                    if (count($fotosData)>0){
                                        $y	=	'';
                                            foreach($fotosData as $foto){
                                                $y++;                   
                                                ?>
									            	<!-- 2 -->
                                                    <div class="gallery-item">
                                                        <div class="grid-item-holder">
                                                            <div class="box-item">
                                                                <img  src="/upload/cupones/<?php echo (strftime("%Y", strtotime(($empData['fr']))));?>/<?php echo (strftime("%m", strtotime(($empData['fr']))));?>/<?php echo ($foto['codigo']) ?>.jpg"   alt="">
                                                                <a href="/upload/cupones/<?php echo (strftime("%Y", strtotime(($empData['fr']))));?>/<?php echo (strftime("%m", strtotime(($empData['fr']))));?>/<?php echo ($foto['codigo']) ?>.jpg" class="gal-link popup-image"><i class="fa fa-search-plus"  ></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php  
                                            }
                                        }
                                    ?>
                                            </div>
                                            <!-- end gallery items -->                                 
                                        </div> 
                                        
                                        
                                        
                                        <!-- REVIEWS -->
                                        <div class="list-single-main-item fl-wrap" id="sec4">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3><?php if ($empData['reviewCount']>1) {echo" Reseñas";} else {echo" Reseña";}?> -  <span><?php echo $empData['reviewCount']; ?></span></h3>
                                            </div>
                                            
                                            
                                            <?php           //VERIFICAMOS SI YA TIENE FOTOS EN LA GALERIA
                                    if (($empData['reviewCount'])>0) { 
                    
                                        } else { echo "<h4>Aún no se han agregado reseñas para esta empresa.</h4>"; }
                                    ?>
                                    <?php $reviewsData = $db->getAllRecords('reviewsEmp','*','AND empresa='.($empData['id']).'','ORDER BY id DESC LIMIT '.($empData['reviewCount']).'');
                                    if (count($reviewsData)>0){
                                        ?>
                                        <div class="reviews-comments-wrap">
                                           <?php 
                                            foreach($reviewsData as $review){
                                                $userSel = $db->getAllRecords('usuarios','*','AND id='.($review['usuario']).'','LIMIT 1');
                                                $userSel = $userSel[0];
                                                
                                                //($UserData['nombres'])
                                                if ($userSel['fPerfil']){
                                                    $fPerfil = '/upload/usuarios/'.(strftime("%Y/%m", strtotime(($userSel['fr'])))).'/'.($userSel['fPerfil']).'.jpg';
                                                } else {$fPerfil = '/upload/usuarios/default.jpg';}
                                                
                                                ?>
                                                    <div class="reviews-comments-item">
                                                        <div class="review-comments-avatar">
                                                            <img src="<?php echo $fPerfil; ?>" alt="">
                                                        </div>
                                                        <div class="reviews-comments-item-text">
                                                            <h4><a href="/perfil/<?php echo $userSel['id']; ?>"><?php echo $userSel['nombre']; ?></a></h4>
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $review['calificacion']; ?>"> </div>
                                                            <div class="clearfix"></div>
                                                            <p><?php echo $review['review']; ?></p>
                                                            <span class="reviews-comments-item-date"><i class="fa fa-calendar-check-o"></i><?php echo (strftime("%d %B %Y", strtotime(($review['fr']))));?></span>
                                                        </div>
                                                    </div>
                                                <?php  
                                            } ?>
                                        </div>
                                        <?php 
                                        }
                                    ?>
                                            
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        <?php
                                        if (isset($_SESSION["UserId"])) {
                                            ?>
                                                
                                                <div class="list-single-main-item fl-wrap" id="sec5">
                                                    <div class="list-single-main-item-title fl-wrap">
                                                        <h3>Agrega una reseña para <strong><?php echo $empData['nombre']; ?></strong></h3>
                                                    </div>
                                                    
                                                    
                                                    <div id="add-review" class="add-review-box">
                                                        <form action="/panel/nueva/review/" method="post" class="add-comment custom-form">
                                                            <input hidden type="text" name="empresa" value="<?php echo $empData['id'];?>">
                                                            <div class="leave-rating-wrap">
                                                                <span class="leave-rating-title">Tu calificación: </span>
                                                                <div class="leave-rating">
                                                                    <input selected type="radio" name="rating" id="rating-1" value="5"/>
                                                                    <label style="float: right; color: #FACC39; width: auto;" for="rating-1" class="fa fa-star-o"></label>
                                                                    <input type="radio" name="rating" id="rating-2" value="4"/>
                                                                    <label style="float: right; color: #FACC39; width: auto;" for="rating-2" class="fa fa-star-o"></label>
                                                                    <input type="radio" name="rating" id="rating-3" value="3"/>
                                                                    <label style="float: right; color: #FACC39; width: auto;" for="rating-3" class="fa fa-star-o"></label>
                                                                    <input type="radio" name="rating" id="rating-4" value="2"/>
                                                                    <label style="float: right; color: #FACC39; width: auto;" for="rating-4" class="fa fa-star-o"></label>
                                                                    <input type="radio" name="rating" id="rating-5" value="1"/>
                                                                    <label style="float: right; color: #FACC39; width: auto;" for="rating-5" class="fa fa-star-o"></label>
                                                                </div>
                                                            </div>
                                                            
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label><i class="fa fa-user-o"></i></label>
                                                                        <input name="nombre" type="text" placeholder="Nombre*" value="<?php echo $UserData['nombre']; ?>"/>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label><i class="fa fa-envelope-o"></i>  </label>
                                                                        <input name="correo" type="text" placeholder="Correo electrónico*" value="<?php echo $UserData['email']; ?>"/>
                                                                    </div>
                                                                </div>
                                                                <textarea id="mensaje" maxlength="200" name="review" cols="40" rows="3" placeholder="Comparte tu experiencia:"></textarea>
                                                                <p><b>Mínimo 100 caracteres máximo 200</b> - <span id="contador">0/200</span></p>
                                                            </fieldset>
                                                            
                                                            <button type="submit" value="review" class="btn  big-btn  color-bg flat-btn">Enviar reseña
                                                                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                            </button>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            
                                            <?php
                                            } else { 
                                            
                                            ?>
                                                
                                                <div class="list-single-main-item fl-wrap" id="sec5">
                                                    <div class="list-single-main-item-title fl-wrap">
                                                        <h3>Agrega una reseña para <strong><?php echo $empData['nombre']; ?></strong></h3>
                                                    </div>
                                                    <div class="notification waitforreview fl-wrap">
                                                        <p>Por favor <b>inicia sesión</b> para poder agregar reseñas.</p>
                                                        <a class="notification-close" href="#"><i class="fa fa-times"></i></a>
                                                    </div>   
                                                </div>
                                            
                                            <?php
                                        
                                        }
                                         
                                       ?>
                                        
                                        
                                </div>
                                <!--box-widget-wrap -->
                                <div class="col-md-4">
                                    <div class="box-widget-wrap">
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget">
                                                <div class="map-container">
                                                    <div id="singleMap" data-latitude="<?php echo $empData['lat']; ?>" data-longitude="<?php echo $empData['lon']; ?>" data-mapTitle="Out Location"></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="box-widget-wrap">							
                                        <!--box-widget-item -->
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget-item-header">
                                                <h3>Enviado por: </h3>
                                            </div>
                                            <div class="box-widget list-author-widget">
                                                <div class="list-author-widget-header shapes-bg-small  color-bg fl-wrap">
                                                    <span class="list-author-widget-link"><a href="/perfil/<?php echo $userEmp['id']; ?>"><?php echo $userEmp['nombre']; ?></a></span>
                                                    <img src="<?php echo $fotUserEmp;?>" alt=""> 
                                                </div>
                                                <div class="box-widget-content">
                                                    <div class="list-author-widget-text">
                                                        <a href="/perfil/<?php echo $userEmp['id']; ?>" class="btn transparent-btn">Ver perfil <i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--box-widget-wrap end -->
                            </div>
                        </div>
                    </section>
                    <!--  section end --> 
                    <div class="limit-box fl-wrap"></div>
                    <!--  section  --> 
                    <section class="gradient-bg">
                        <div class="cirle-bg">
                            <div class="bg" data-bg="images/bg/circle.png"></div>
                        </div>
                        <div class="container">
                            <div class="join-wrap fl-wrap">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>¿Quiéres ver tu empresa aquí? </h3>
                                        <p style="font-size: 23px;">Así como <strong><b><?php echo $empData['nombre']; ?></b></strong></p>
                                    </div>
                                    <div class="col-md-4"><a href="/panel/nueva/empresa" class="join-wrap-btn">¡Publícala!</a></div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--  section  end--> 
                </div>
                <!-- Content end -->      
            </div>
            <!-- wrapper end -->
            
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/footer.php");?>
            
            
            <!--footer end  -->
            <!--register form -->
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/login.php");?>
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/reclamar.php");?>
            
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
        <script>
            const mensaje = document.getElementById('mensaje');
            const contador = document.getElementById('contador');
            
            mensaje.addEventListener('input', function(e) {
                const target = e.target;
                const longitudMax = target.getAttribute('maxlength');
                const longitudAct = target.value.length;
                contador.innerHTML = `${longitudAct}/${longitudMax}`;
            });
        </script>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
        
    </body>
</html>