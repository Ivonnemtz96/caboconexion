<?php
date_default_timezone_set('America/Mazatlan');
setlocale(LC_ALL, 'es_MX');

include_once('include/Database.php');
define('SS_DB_NAME', 'grupoar6_caboconexion2');
define('SS_DB_USER', 'grupoar6_cabocon');
define('SS_DB_PASSWORD', 'E,}pE=OI0L;=');
define('SS_DB_HOST', 'localhost');

$dsn	= 	"mysql:dbname=".SS_DB_NAME.";host=".SS_DB_HOST."";
$pdo	=	"";
try {
	$pdo = new PDO($dsn, SS_DB_USER, SS_DB_PASSWORD);
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db 	=	new Database($pdo);

?>