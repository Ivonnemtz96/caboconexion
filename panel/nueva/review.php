<?php 
        require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/sesion.php");

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        //ESTABLECEMOS LA HORA IGUAL QUE EN LOS CABOS
        date_default_timezone_set('America/Denver');   
        $fecha = date("Y-m-d H:i:s");
        

if(isset($_REQUEST['review'])){
	extract($_REQUEST);	
	if(($empresa=="")or($rating=="")or($review=="")){
        setcookie("msg","minreview",time() + 2, "/");
		header('location: /empresa/'.$empresa.'');
		exit;
	}else{
        
        $empData =	$db->getAllRecords('empresas','*',' AND id="'.$empresa.'"LIMIT 1 ');
        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!($empData)) {
        setcookie("msg","noemp",time() + 2, "/");
		header('location: /?msg=noemp');
        exit();
        }

        $empData = $empData[0];
        
        //BERIFICAMOS SI EL CORREO YA EXISTE
        $reviewEx =	$db->getAllRecords('reviewsEmp','*',' AND usuario="'.($UserData["id"]).'" AND empresa="'.$empresa.'" LIMIT 1 ');
        
        if (!($reviewEx)) {
            
            if(strlen($review)<100){
                setcookie("msg","revmin",time() + 2, "/");
                header('location: /empresa/'.$empresa.'');
                exit;
            }
            
            $userCount	=	$db->getQueryCount('reviewsEmp','id');
		      if($userCount[0]['total']<10000){
		      	$data	=	array(
		      					'usuario'=>$UserData["id"],
                                'empresa'=>$empresa,
                                'calificacion'=>$rating,
                                'review'=>$review,
                                'fr'=>$fecha,
                                    
		      				);
		      	$insert	=	$db->insert('reviewsEmp',$data);
		      	if($insert){
                    
                    //SUMAMOS +1 A LAS EMPRESAS DE ESTE USUARIO
                    $SumEmp = (($empData['reviewCount'])+1);
        
                    $InsertData	=	array(
                        'reviewCount'=> $SumEmp,
                        );
                    $update	=	$db->update('empresas',$InsertData,array('id'=>($empData['id'])));//SUMAMOS 1 A SUS REVIEWS
                
                    
                    setcookie("msg","reviewok",time() + 2, "/");
		      		header('location: /empresa/'.$empresa.'');
		      		exit;
		      	}else{
                    setcookie("msg","ups",time() + 2, "/");
		      		header('location: /empresa/'.$empresa.'');
		      		exit;
		      	}
		      }   else{
                   setcookie("msg","rlim",time() + 2, "/");
		      	   header('location: /empresa/'.$empresa.'');
		      	   exit;
		          }
              
        } else {
            setcookie("msg","reviewEx",time() + 2, "/");
            header('location: /empresa/'.$empresa.'');
            exit;
        
		
		      
	   }
    }
}
setcookie("msg","reviewsad",time() + 2, "/");
header('location: /?msg=reviewsad');
exit;
    
  
?>