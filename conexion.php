<?php include ("config.inc.php"); ?>
<?php
$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword);
if (!$conexion)  { die("Error de conexion: ".mysql_error()); }
mysql_select_db($db, $conexion);
?>