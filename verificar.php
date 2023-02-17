<?php 
session_start(); 
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/funciones.php");
    
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        
        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!isset($_REQUEST['token'])) {
            header("location: /");
            exit;
        }
        
        $token = ($_GET['token']);
        //DECODIFICAMOS CARACTERES DE URL 
        $token = urldecode($token);
        //AHORA REEMPLAZAMOS CARACTERES COMO + PARA QUE SE DETECTE CORRECTAMENTE LA ENCRIPTACION
        $token = str_replace (' ','+', $token);
        //DESENCRIPTAMOS
        $token = decrypt($token, $keyEN);
        
        $usuarioVer =	$db->getAllRecords('usuarios','*',' AND id="'.$token.'" LIMIT 1 ');
        
        $fecha = date("Y-m-d H:i:s");

        //SI NO HAY ID EN EL GET MANDA ERROR
        if (!($usuarioVer)) {
            header("location: /");
            exit;
        }
        $usuarioVer = $usuarioVer[0];

        $_SESSION['UserId'] = $usuarioVer['id'];
        //ACTUALIZAMOS LA FECHA DEL ÚLTIMO LOGIN
        $InsertData	=	array(
                        'verificado'=> 1,
                        'fl'=> $fecha,
                     );
        $update	=	$db->update('usuarios',$InsertData,array('id'=>($usuarioVer['id'])));
        
        setcookie("msg","veriOK",time() + 2, "/");
        header("location: /");
        exit;
?>

