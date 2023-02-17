<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

    if (($UserData['rol'])>2) {
        setcookie("msg","sad",time() + 2, "/");
        header('Location: /');
    }


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Mexico_City');   
$fecha = date("Y-m-d H:i:s");

if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
    //EXTRAEMOS LA INFORMACIÓN DE LA PROPIEDAD
    $Delfoto = $db->getAllRecords('fotosEmp','*','AND id='.($_REQUEST['delId']).'','LIMIT 1');
    
        if (empty($Delfoto)) { //SI NO EXISTE ES QUE NO HAY UN ID VALIDO Y REDIRECCIONAMOS Y LANZAMOS ERROR
            setcookie("msg","ups",time() + 2, "/");
            header('location:/admin/empresas');
            exit;
            }
    
        $Delfoto = $Delfoto[0];

     	$db->delete('fotosEmp',array('id'=>$_REQUEST['delId']));
    
        $prodSel = $db->getAllRecords('empresas','*',' AND id="'.($Delfoto['empresa']).'"','LIMIT 1');
        $prodSel = $prodSel[0];
    
        //RESTAMOS -1 A SU EXPERIENCIA
        $SumFoto = (($prodSel['fotCount'])-1);
        
        $InsertData	=	array(
            'fotCount'=> $SumFoto,
        );
	       $update	=	$db->update('empresas',$InsertData,array('id'=>($prodSel['id'])));
    
        $archivo = '../../upload/empresas/'.(strftime("%Y/%m", strtotime(($prodSel['fr'])))).'/'.($Delfoto['codigo']).'.jpg';
        unlink($archivo);

    
    setcookie("msg","fbok",time() + 2, "/");
	header('location: /admin/editar/galeria/?prodId='.($prodSel['id']).'');
	exit;
}
?>