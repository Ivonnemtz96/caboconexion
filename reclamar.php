<?php 
        require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        //ESTABLECEMOS LA HORA IGUAL QUE EN LOS CABOS
        date_default_timezone_set('America/Denver');   
        $fecha = date("Y-m-d H:i:s");
        

if(isset($_REQUEST['reclamar'])){
	extract($_REQUEST);	
	if(($nombre=="")or($empresa=="")or($telefono=="")or($mensaje=="")){
        setcookie("msg","reclaups",time() + 2, "/");
		header('location: /empresa/'.$empresa.'');
		exit;
	}else{
        
        $empSel =	$db->getAllRecords('empresas','*',' AND id="'.$empresa.'" LIMIT 1 ');
        
        if (empty($empSel)) { //SI NO EXISTE ES QUE NO HAY UN ID DE EMPRESA VÁLIDO Y REDIRECCIONAMOS Y LANZAMOS ERROR
            setcookie("msg","noemp",time() + 2, "/");
            header('location:/');
            exit;
        }

        $empSel  =  $empSel [0]; //PASAMOS LOS PRIMEROS 2 FILTROS Y SI TENEMOS UNA EMPRESA VÁLIDA SELECCIONADA 
        
        require_once($_SERVER["DOCUMENT_ROOT"]."/include/mail-reclama.php");
        
        setcookie("msg","reclaok",time() + 2, "/");
        header('location: /empresa/'.$empresa.'');
        exit;
        
    }
}
setcookie("msg","reclasad",time() + 2, "/");
header('location: /');
exit;
    
  
?>