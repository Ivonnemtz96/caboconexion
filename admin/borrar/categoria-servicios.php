<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

  if (($UserData['rol'])>2) {
        setcookie("msg","sad",time() + 2, "/");
        header('Location: /');
    }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Denver');   
$fecha = date("Y-m-d H:i:s");


if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
    
    
    
    //COMPROBAMOS QUE NO SE HAYA USADO ESTA CATEGORIA EN ALGUNA EMPRESA
    $empCount	=	$db->getQueryCount('servicios','*','AND catServicio='.($_REQUEST['delId']).'');
    $tEmp = ($empCount[0]['total']);
    
    
        //ERROR 21 Tu ApiKey no es válida
        if ($tEmp>0) {
            setcookie("msg","impdelcat",time() + 2, "/");
            header('location: /admin/nuevo/categoria-servicios');
            exit();
            
        }
    
    
	$db->delete('catServicios',array('id'=>$_REQUEST['delId']));
    
    setcookie("msg","catdel",time() + 2, "/");
	header('location: /admin/nuevo/categoria-servicios');
	exit;
}
?>
