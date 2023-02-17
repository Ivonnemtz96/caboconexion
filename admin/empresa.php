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
    
    
    //VERIFICAMOS QUE EL USUARIO SEA EL DUEÑO DE ESE POST Y POR LO TANTO TENGA PERMISO A ELIMINAR
    $DelData = $db->getAllRecords('empresas','*','AND id='.($_REQUEST['delId']).'','LIMIT 1');


        //ERROR 21 Tu ApiKey no es válida
        if (!($DelData)) {
            setcookie("msg","empnoe",time() + 2, "/");
            header('location: /admin/empresas');
            exit();
            
        }

        $DelData = $DelData[0];
    
        $UserData = $db->getAllRecords('usuarios','*','AND id='.($DelData['usuario']).'','LIMIT 1');
        $UserData = $UserData[0];
    
        //RESTAMOS -1 A SU EXPERIENCIA
        $SumProp = (($UserData['empCount'])-1);
        
        $InsertData	=	array(
            'empCount'=> $SumProp,
        );
	       $update	=	$db->update('usuarios',$InsertData,array('id'=>($DelData['usuario'])));
    
    
        if (isset($DelData['fPortada'])){
                $archivo = '../../upload/empresas/'.(strftime("%Y", strtotime(($DelData['fr'])))).'/'.(strftime("%m", strtotime(($DelData['fr'])))).'/'.($DelData['fPortada']).'.jpg';
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
        
    
    $db->delete('empresas',array('id'=>$_REQUEST['delId']));
    
    setcookie("msg","empdel",time() + , "/");
	header('location: /admin/empresas');
	exit;
}
?>