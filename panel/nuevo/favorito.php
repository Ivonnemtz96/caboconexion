<?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

if(isset($_REQUEST['addId']) and $_REQUEST['addId']!=""){
    
    
    //VERIFICAMOS QUE EL USUARIO SEA EL DUEÑO DE ESE POST Y POR LO TANTO TENGA PERMISO A ELIMINAR
    $addEmp = $db->getAllRecords('empresas','*','AND id='.($_REQUEST['addId']).'','LIMIT 1');


        //ERROR 21 Tu ApiKey no es válida
        if (!($addEmp)) {
            setcookie("msg","ups",time() + 2, "/");
            header('location: /');
            exit();
            
        }    
	
        $addEmp = $addEmp [0];
    
        $favDuplicado = $db->getAllRecords('empFavoritos','*','AND empresa='.($addEmp['id']).' AND usuario='.($UserData['id']).'','LIMIT 1');
    
        if (!empty ($favDuplicado)) {
            setcookie("msg","favdup",time() + 2, "/");
            header('location: /panel/favoritos');
            exit();
            
        } else {
            
            //RESTAMOS -1 A SU EXPERIENCIA
        $SumFav = (($UserData['empFavCount'])+1);
        
        $InsertData	=	array(
            'empFavCount'=> $SumFav,
        );
	       $update	=	$db->update('usuarios',$InsertData,array('id'=>($UserData['id'])));
            
    
      $favoritosCount	=	$db->getQueryCount('empFavoritos','id');
		if($favoritosCount[0]['total']<50000){
			$data	=	array(
							'empresa'=>($addEmp['id']),
							'usuario'=>($UserData['id']),
						);
			$insert	=	$db->insert('empFavoritos',$data);
            
			if($insert){
                setcookie("msg","favok",time() + 2, "/");                
				header('location:/panel/favoritos');//exito
				exit;
			}else{
                setcookie("msg","ups",time() + 2, "/");
				header('location:/panel/favoritos');//sin cambios
				exit;
			}
		} else{
            setcookie("msg","lim",time() + 2, "/");
			header('location:/panel/favoritos'); //limite
			exit;
		}
	}
}

?>
		