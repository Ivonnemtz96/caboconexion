<?php session_start();  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/funciones.php");



    if (isset($_SESSION["UserId"])) {
        setcookie("msg","ylog",time() + 2, "/");
        header("location: /");
        exit;
    } 

$fecha = date("Y-m-d H:i:s");




if(isset($_REQUEST['register'])){
	extract($_REQUEST);	
	if(($rnombre=="")&($remail=="")&($rpassword=="")){
        setcookie("msg","all",time() + 2, "/");    
		header('location: /acceder');
		exit;
	}else
    if($rnombre==""){
        setcookie("msg","rnombre",time() + 2, "/");
		header('location: /acceder');
		exit;
	}else if($remail==""){
        setcookie("msg","remail",time() + 2, "/");
		header('location: /acceder');
		exit;
	} else if(!isEmail($remail)) {
        setcookie("msg","rnoemail",time() + 2, "/");
		header('location: /acceder');
		exit;
	}else if($rpassword==""){
        setcookie("msg","rpass",time() + 2, "/");
		header('location: /acceder');
		exit;
	}else{
        
        //BERIFICAMOS SI EL CORREO YA EXISTE
        $EmailEx =	$db->getAllRecords('usuarios','*',' AND email="'.($_POST["remail"]).'"LIMIT 1 ');
        
        if (!($EmailEx)) {
            
            $userCount	=	$db->getQueryCount('usuarios','id');
		      if($userCount[0]['total']<10000){
		      	$data	=	array(
		      					'nombre'=>$rnombre,
                                'email'=>$remail,
                                'fr'=>$fecha,
                                'pass'=>$rpassword,
                                'rol'=>"3",
                                    
		      				);
		      	$insert	=	$db->insert('usuarios',$data);
                $lastId =   $pdo->lastInsertId(); //OBTENEMOS EL ID INCERTADO AL MOMENTO
                   
                  
		      	if($insert){
                    
                    //PARA MANDAR LA VERIFICACION POR EMAIL
                    //ENCRIPTAMOS EL ID DE UNIDAD PARA EVITAR QUE SEA MANIPULADO YA QUE SE MANDA POR URL
                    $linkEncrypt = encrypt($lastId, $keyEN);
                    //CODIFICAMOS A CARACTERES VALIDOS PARA URL
                    $linkEncrypt = urlencode($linkEncrypt);
                    
                    require_once($_SERVER["DOCUMENT_ROOT"]."/include/mailOuthCode.php");
                    
                    
                    setcookie("msg","rok",time() + 2, "/");
		      		header('location: /acceder');
		      		exit;
		      	}else{
                    setcookie("msg","ups",time() + 2, "/");
		      		header('location: /acceder');
		      		exit;
		      	}
		      }   else{
                  setcookie("msg","rlim",time() + 2, "/");
		      	   header('location: /acceder');
		      	   exit;
		          }
              
        } else { 
            setcookie("msg","mailex",time() + 2, "/");
            header('location: /acceder');
		      exit;
        
		
		      
	   }
    }
}
setcookie("msg","sad",time() + 2, "/");
header('location: /');
exit;

?>