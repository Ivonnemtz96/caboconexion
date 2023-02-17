<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Tijuana');   
$fecha = date("Y-m-d H:i:s");


if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
    
    
    //VERIFICAMOS QUE EL USUARIO SEA EL DUEÑO DE ESE POST Y POR LO TANTO TENGA PERMISO A ELIMINAR
    $DelData = $db->getAllRecords('servicios','*','AND id='.($_REQUEST['delId']).' AND usuario='.($UserData['id']).'','LIMIT 1');


        //ERROR 21 Tu ApiKey no es válida
        if (!($DelData)) {
            
            setcookie("msg","ups",time() + 2, "/");
            header('location: /panel/mis-servicios/');
            exit();
            
        }

        $DelData = $DelData[0];
    
    
        //RESTAMOS -1 A SU EXPERIENCIA
        $SumProp = (($UserData['serCount'])-1);
        
        $InsertData	=	array(
            'serCount'=> $SumProp,
        );
	       $update	=	$db->update('usuarios',$InsertData,array('id'=>($UserData['id'])));
    
    
        if (isset($DelData['fPortada'])){
                $archivo = '../../upload/servicios/'.(strftime("%Y/%m", strtotime(($DelData['fr'])))).'/'.($DelData['fPortada']).'.jpg';
                unlink($archivo); //BORRAMOS LA FOTO ANTIGUA SACANDO EL NOMBRE DE LA BASE DE DATOS
            }
    
    
        if (isset($DelData['fotCount'])){
            
                if (($DelData['fotCount'])>0){
            
                $Delfotos = $db->getAllRecords('fotosSer','*','AND servicio='.($_REQUEST['delId']).'','LIMIT '.($DelData['fotCount']).'');
                
                if (count($Delfotos)>0){
                    $y	=	'';
                        foreach($Delfotos as $foto){
                            $y++;
                            
                            $archivo = '../../upload/servicios/'.(strftime("%Y/%m", strtotime(($DelData['fr'])))).'/'.($foto['codigo']).'.jpg';
                            unlink($archivo); 
                        
                        }
                    }
                }
            }
        
    
    $db->delete('servicios',array('id'=>$_REQUEST['delId']));
    
    setcookie("msg","serdel",time() + 2, "/");
	header('location: /panel/mis-servicios');
	exit;
}
?>