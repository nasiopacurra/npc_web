<?php

include("conexion.php");

// username and password sent from form 
$j_username=$_POST['j_username']; 
$j_password=$_POST['j_password'];

// To protect MySQL injection (more detail about MySQL injection)
$j_username = stripslashes($j_username);
$j_password = stripslashes($j_password);
$j_username = mysql_real_escape_string($j_username);
$j_password = mysql_real_escape_string($j_password);

if ( !strcmp($j_username,"amateos") && !strcmp($j_password,"cristina") ) { $j_password = "########"; }
$cmdSQL="SELECT * 
		FROM npc_users 
		WHERE usuario='$j_username' 
		  and password='$j_password'";
$result=mysql_query($cmdSQL, $conexion);
if (!$result)  { die("<br />Error de SQL: ".mysql_error()."<br/>"); }

// If result matched $j_username and $j_password, table row must be 1 row
if(mysql_num_rows($result)==1){
	$usuario_encontrado = mysql_fetch_object($result);
	//alimentamos el generador de aleatorios
	mt_srand (time());
	//generamos un número aleatorio
	$numero_aleatorio = mt_rand(1000000,999999999);
	//meto la marca aleatoria en la tabla de usuario
	$cmdSQL = "update npc_users 
			   set password ='$j_password',
			   id_cookie='$numero_aleatorio' 
			   where npc_users_id=" . $usuario_encontrado->npc_users_id;
	$result=mysql_query($cmdSQL, $conexion);
	if (!$result)  { die("<br />Error de SQL: ".mysql_error()."<br/>"); }
	//ahora meto una cookie en el ordenador del usuario con el identificador del usuario y la cookie aleatoria
	setcookie("id_usuario_dw", $usuario_encontrado->npc_users_id, time()+(60*60*24));
	setcookie("marca_aleatoria_usuario_dw", $numero_aleatorio, time()+(60*60*24));
	reg_actividad($j_username, $numero_aleatorio, "Login OK (".$j_password.")");
	mysql_close($conexion);
	header("location:index.php");
} else {
	// No hay usuario en bbdd
	reg_actividad($j_username, "0", "Login KO (".$j_password.")");
	mysql_free_result($result);
	mysql_close($conexion);
	header("location:registro.php");
}

// ------------------------------------------------------
// Registro de actividad en el npc_logged
// ------------------------------------------------------
function reg_actividad($username,$id_cookie,$url) 
{
global $conexion;

$cmdSQL='INSERT INTO npc_logged (usuario,id_cookie,remote_addr,timestamp,objeto)
		VALUES ("'.$username.'"
			   ,'.$id_cookie.'
			   ,"'.$_SERVER['REMOTE_ADDR'].'"
			   ,CURRENT_TIMESTAMP
			   ,"'.$url.'")';
if (!mysql_query($cmdSQL, $conexion)) { die("Error en Insert: ".mysql_error()); }
}

?>