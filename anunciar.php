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

        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!isset($_REQUEST['id'])) {
         
        echo "ERROR 10";
        exit();
        } 


        
        
        $userData =	$db->getAllRecords('usuarios','*',' AND id="'.$_REQUEST['id'].'"LIMIT 1 ');
        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!($userData)) {
        echo "ERROR 20";
        exit();
        }

        $userData = $userData[0];
        
        //SUMAMOS +1 A LAS IMPRECIONES DEL ANUNCIO
        $SumImpreciones = (($userData['impreciones'])+1);
    
        $InsertData	=	array(
            'impreciones'=> $SumImpreciones,
        );
        $update	 =  $db->update('usuarios',$InsertData,array('id'=>($userData['id'])));//ACTUALIZAMOS LAS IMPRECIONES

        if ($userData['fPerfil']) {
            $fotUser = '/upload/usuarios/'.(strftime("%Y", strtotime(($userData['fr'])))).'/'.(strftime("%m", strtotime(($userData['fr'])))).'/'.($userData['fPerfil']).'.jpg';
            } else {$fotUser = '/upload/usuarios/default.jpg';}

    
  
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title><?php echo $userData['nombre']; ?> - CaboConexion</title>
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
                <!-- Content-->   
                
                <div class="content">
                    <!--section -->
                    <section class="parallax-section small-par color-bg">
                        <div class="shapes-bg-big"></div>
                        <div class="container">
                            <div class="section-title center-align">
                                <h2><span><?php echo ($userData['nombre']) ?></span></h2>
                                <div class="user-profile-avatar"><img src="<?php echo $fotUser;?>" alt=""></div>
                            </div>
                        </div>
                        <div class="header-sec-link">
                            <div class="container"><a href="#sec1" class="custom-scroll-link">Aportes (<?php echo $userData['empCount']; ?>)</a></div>
                        </div>
                    </section>
                    <!-- section end -->
                    <!--section -->
                    <section class="gray-bg" id="sec1">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="listsearch-header fl-wrap">
                                        <h3>Empresas enviadas por: <b><?php echo $userData['nombre']; ?></b></h3>
                                    </div>
                                    <!-- list-main-wrap-->
                                    <div class="list-main-wrap fl-wrap card-listing ">
                                        <?php $empData = $db->getAllRecords('empresas','*','AND usuario='.($userData['id']).' ORDER BY fr LIMIT '.($userData['empCount']).'');
                                                if (count($empData)>0){
                                                    $y	=	'';
                                                        foreach($empData as $empresa){
                                                            $y++;
                                                            $catEmpresa = $db->getAllRecords('catEmpresa','*','AND id='.($empresa['catEmpresa']).' LIMIT 1');
                                                            $catEmpresa = $catEmpresa [0];
                                                            $lugEmp = $db->getAllRecords('lugar','*','AND id='.($empresa['lugar']).' LIMIT 1');
                                                            $lugEmp = $lugEmp [0];
                                                            ?>
                                                            
                                                            <div class="listing-item">
                                                                <article class="geodir-category-listing fl-wrap">
                                                                    <div class="geodir-category-img">
                                                                        <img src="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empresa['fr']))));?>/<?php echo (strftime("%m", strtotime(($empresa['fr']))));?>/<?php echo ($empresa['fPortada']) ?>.jpg" alt="">
                                                                        <div class="overlay"></div>
                                                                        <div class="list-post-counter"><span>4</span><i class="fa fa-heart"></i></div>
                                                                    </div>
                                                                    <div class="geodir-category-content fl-wrap">
                                                                        <a class="listing-geodir-category" href="/empresas"><?php echo $catEmpresa['nombre']; ?></a>
                                                                        
                                                                        
                                                                        <h3><a href="/empresa/<?php echo ($empresa['id']) ?>"><?php echo ($empresa['nombre']) ?></a></h3>
                                                                        <p><?php echo (substr(($empresa['descripcion']), 0, 150));?>...</p>
                                                                        <div class="geodir-category-options fl-wrap">
                                                                            <div class="geodir-category-location"><a href="/empresas"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo ($lugEmp['nombre']) ?></a></div>
                                                                        </div>
                                                                    </div>
                                                                </article>
                                                            </div>
						                                    
                                                        <?php     
                                                        }
                                                    }
                                                ?>
                                    </div>                         
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- section end -->
                    <div class="limit-box fl-wrap"></div>
                    
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
        
    </body>
</html>