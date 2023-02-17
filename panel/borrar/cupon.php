<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Mexico_City');   
$fecha = date("Y-m-d H:i:s");

if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
    //EXTRAEMOS LA INFORMACIÓN DE LA PROPIEDAD
    $Delfoto = $db->getAllRecords('empCupones','*','AND id='.($_REQUEST['delId']).' AND usuario='.($UserData['id']).'','LIMIT 1');
    
        if (empty($Delfoto)) { //SI NO EXISTE ES QUE NO HAY UN ID VALIDO Y REDIRECCIONAMOS Y LANZAMOS ERROR
            setcookie("msg","ups",time() + 2, "/");
            header('location:/panel/mis-empresas');
            exit;
            }
    
        $Delfoto = $Delfoto[0];

     	$db->delete('empCupones',array('id'=>$_REQUEST['delId']));
    
        $empSel = $db->getAllRecords('empresas','*',' AND id="'.($Delfoto['empresa']).'"','LIMIT 1');
        $empSel = $empSel[0];
    
        //RESTAMOS -1 A SU EXPERIENCIA
        $SumFoto = (($empSel['cupCount'])-1);
        
        $InsertData	=	array(
            'cupCount'=> $SumFoto,
        );
	       $update	=	$db->update('empresas',$InsertData,array('id'=>($empSel['id'])));
    
    
        $archivo = '../../upload/cupones/'.(strftime("%Y/%m", strtotime(($empSel['fr'])))).'/'.($Delfoto['codigo']).'.jpg';
        unlink($archivo); //BORRAMOS LA FOTO ANTIGUA SACANDO EL NOMBRE DE LA BASE DE DATOS

    
    setcookie("msg","cupbok",time() + 2, "/");
	header('location: /panel/nuevo/cupon/?empId='.($empSel['id']).'');
	exit;
}
?>