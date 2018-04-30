<?php include ("npc_users.php"); ?>
<?php
	include("conexion.php");
	$cmdSQL='INSERT INTO npc_logged (usuario,id_cookie,remote_addr,timestamp,objeto)
		VALUES ("'.$user_name.'"
			   ,'.$_COOKIE["marca_aleatoria_usuario_dw"].'
			   ,"'.$_SERVER['REMOTE_ADDR'].'"
			   ,CURRENT_TIMESTAMP
			   ,"Logout")';
	if (!mysql_query($cmdSQL, $conexion)) { die("Error en Insert: ".mysql_error()); }
	mysql_close($conexion);
	setcookie("id_usuario_dw","",time()-3600);
	setcookie("marca_aleatoria_usuario_dw","",time()-3600);
	header("location:index.php");
?> 