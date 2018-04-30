<?php
// Ponemos las variables globales por defecto
$user_name="";
$user_nombre="";
$user_email="";
$user_nivel=0;

// Primero tengo que ver si el usuario está memorizado en una cookie
if ( isset($_COOKIE["id_usuario_dw"]) 
	 && isset($_COOKIE["marca_aleatoria_usuario_dw"]) ){
	// Tengo cookies memorizadas
	// además voy a comprobar que esas variables no estén vacías
	if ( $_COOKIE["id_usuario_dw"]!="" || 
		 $_COOKIE["marca_aleatoria_usuario_dw"]!="" ){

		include("conexion.php");

		// Voy a ver si corresponden con algún usuario
		$cmdSQL = "select * from npc_users where npc_users_id=" . $_COOKIE["id_usuario_dw"] . 
				  " and id_cookie='" . $_COOKIE["marca_aleatoria_usuario_dw"] . 
				  "' and id_cookie<>''";
		$result = mysql_query($cmdSQL, $conexion);
		if (!$result)  { die("<br />Error de SQL: ".mysql_error()."<br/>"); }
		if (mysql_num_rows($result)==1){
			$usuario_encontrado = mysql_fetch_object($result);
			// Variable generales de autenticacion
			$user_name=$usuario_encontrado->usuario;
			$user_nombre=$usuario_encontrado->nombre;
			$user_email=$usuario_encontrado->email;
			$user_nivel=$usuario_encontrado->nivel;
			// Extraermos el trozo de URL de acceso
			$par = $_SERVER['REQUEST_URI'] . '?';
			foreach($_REQUEST as $k=>$v){ 
				$par = $par . $k.'='.$v.','; 
			};
			$cmdSQL='INSERT INTO npc_logged (usuario,id_cookie,remote_addr,timestamp,objeto)
				VALUES ("'.$user_name.'"
						,'.$_COOKIE["marca_aleatoria_usuario_dw"].'
						,"'.$_SERVER['REMOTE_ADDR'].'"
						,CURRENT_TIMESTAMP
						,"'.$par.'")';
			if (!mysql_query($cmdSQL, $conexion)) { die("Error en Insert: ".mysql_error()); }
			// liberamos la memoria y Cerramos BD
			mysql_free_result($result); 
			mysql_close($conexion); 
		} else { 
			// No tenemos el usuario correcto en la cookie
			// liberamos antes de la redireccion
			mysql_free_result($result); 
			mysql_close($conexion); 
			// header("location:login.php?error=true");
		}
	} else { 
		// Cookies vacias
		// header("location:login.php?error=true");
	}
} else { 
	// no tengo Cookies
	// header("location:login.php?error=true");
}

?>