<?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
    
    
    //VERIFICAMOS QUE EL USUARIO SEA EL DUEÑO DE ESE POST Y POR LO TANTO TENGA PERMISO A ELIMINAR
    $DelData = $db->getAllRecords('empFavoritos','*','AND id='.($_REQUEST['delId']).' AND usuario='.($UserData['id']).'','LIMIT 1');


        //ERROR 21 Tu ApiKey no es válida
        if (!($DelData)) {
            
            setcookie("msg","notufav",time() + 2, "/");
            header('location: /panel/favoritos');
            exit();
            
        }

    
	    $db->delete('empFavoritos',array('id'=>$_REQUEST['delId']));
    
        //RESTAMOS -1 A SU EXPERIENCIA
        $sumFav = (($UserData['empFavCount'])-1);
        
        $InsertData	=	array(
            'empFavCount'=> $sumFav,
        );
	       $update	=	$db->update('usuarios',$InsertData,array('id'=>($UserData['id'])));
    
    
    setcookie("msg","favdel",time() + 2, "/");
	header('location: /panel/favoritos');
	exit;
}
?>