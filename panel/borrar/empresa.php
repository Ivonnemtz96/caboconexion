<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Denver');   
$fecha = date("Y-m-d H:i:s");


if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
    
    
    //VERIFICAMOS QUE EL USUARIO SEA EL DUEÑO DE ESE POST Y POR LO TANTO TENGA PERMISO A ELIMINAR
    $DelData = $db->getAllRecords('empresas','*','AND id='.($_REQUEST['delId']).' AND usuario='.($UserData['id']).'','LIMIT 1');


        //ERROR 21 Tu ApiKey no es válida
        if (!($DelData)) {
            
            setcookie("msg","notuemp",time() + 2, "/");
            header('location: /panel/mis-empresas/');
            exit();
            
        }

        $DelData = $DelData[0];
    
    
        //RESTAMOS -1 A SU EXPERIENCIA
        $SumProp = (($UserData['empCount'])-1);
        
        $InsertData	=	array(
            'empCount'=> $SumProp,
        );
	       $update	=	$db->update('usuarios',$InsertData,array('id'=>($UserData['id'])));
    
    
        if (isset($DelData['fPortada'])){
                $archivo = '../../upload/empresas/'.(strftime("%Y/%m", strtotime(($DelData['fr'])))).'/'.($DelData['fPortada']).'.jpg';
                unlink($archivo); //BORRAMOS LA FOTO ANTIGUA SACANDO EL NOMBRE DE LA BASE DE DATOS
            }
    
    
        if (isset($DelData['fotCount'])){
            
                if (($DelData['fotCount'])>0){
            
                $Delfotos = $db->getAllRecords('fotosEmp','*','AND empresa='.($_REQUEST['delId']).'','LIMIT '.($DelData['fotCount']).'');
                
                if (count($Delfotos)>0){
                    $y	=	'';
                        foreach($Delfotos as $foto){
                            $y++;
                            
                            $archivo = '../../upload/empresas/'.(strftime("%Y/%m", strtotime(($DelData['fr'])))).'/'.($foto['codigo']).'.jpg';
                            unlink($archivo); 
                        
                        }
                    }
                }
            }
    
        if (isset($DelData['cupCount'])){
            
                if (($DelData['cupCount'])>0){
            
                $Delfotos = $db->getAllRecords('empCupones','*','AND empresa='.($_REQUEST['delId']).'','LIMIT '.($DelData['cupCount']).'');
                
                if (count($Delfotos)>0){
                    $y	=	'';
                        foreach($Delfotos as $foto){
                            $y++;
                            
                            $archivo = '../../upload/cupones/'.(strftime("%Y/%m", strtotime(($DelData['fr'])))).'/'.($foto['codigo']).'.jpg';
                            unlink($archivo); 
                        
                        }
                    }
                }
            }
        
    
    $db->delete('empresas',array('id'=>$_REQUEST['delId']));
    
    setcookie("msg","empdel",time() + 2, "/");
	header('location: /panel/mis-empresas');
	exit;
}
?>
