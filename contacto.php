<?php include ("npc_users.php"); ?>

<?php
// Trasportamos las variables $_POST a variables PHP.
foreach($_POST as $k=>$v) {  $$k = $v; echo '->'.$k.'='.$v.PHP_EOL; };
if (!isset($post_submit)) { $post_submit = ""; } 

if ( !strcmp($post_submit,"Send") ) {
	include("conexion.php");
	$cmdSQL='INSERT INTO npc_contact (contact_subject,contact_category,contact_name,
			contact_email,contact_body,contact_datetime) 
			VALUES ("'.$post_subject.'","'.$post_category.'","'.$post_name.'","'.
			$post_email.'","'.$post_body.'",CURRENT_TIMESTAMP)';
	if (!mysql_query($cmdSQL, $conexion)) { die("Error en Insert: ".mysql_error()); }
	mysql_close($conexion);	
	header("location:index.php");
}
?>


<!DOCTYPE html>
<html lang="es-ES">
<head>
	<?php include ("npc_head_meta.php"); ?>
	<?php include ("npc_head_title.php"); ?>
	<?php include ("npc_head_css.php"); ?>
	<link href="stylesheets/contact/_controller.css" media="screen" rel="stylesheet" type="text/css"/>
	<link href="stylesheets/contact/index.css" media="screen" rel="stylesheet" type="text/css"/>
	<?php include ("npc_head_js.php"); ?>
</head>
<body>
<div id="wrapper" class="homepage">

	<?php include ("npc_login_register.php"); ?>
	<?php include ("npc_topnav.php"); ?>

	<section id="main">

		<div class="form-container">
	
		<h4>Contacta conmigo</h4>
	
		<form action="contacto.php" method="post">
	
		<p>
		<label for="contact_subject">Asunto</label>
		<input id="contact_subject" name="post_subject" size="30" type="text"/>
		</p>
	
		<p>
		<label for="contact_category">Categoria</label>
		<select id="contact_category" name="post_category">
			<option value="preguntas_grls">Preguntas en general</option>
			<option value="site_problems">Problemas con la p&aacute;gina</option>
			<option value="compra_venta">Compra/Venta</option>
			<option value="patchwork">Patchwork</option>
			<option value="encuadernacion">Encuadernaci&oacute;n</option>
			<option value="cocina">Cocina</option>
			<option value="informatica">Inform&aacute;atica</option>
		</select>
		</p>
	
		<p>
		<label for="contact_name">Nombre</label>
		<input id="contact_name" name="post_name" size="30" type="text"/>
		</p>
	
		<p>
		<label for="contact_email">Email</label>
		<input id="contact_email" name="post_email" size="30" type="text"/>
		</p>
	
		<p>
		<label for="contact_body">Texto</label>
		<textarea cols="40" rows="20" id="contact_body" name="post_body"></textarea>
		</p>

		<?php
		// Verificamos el reCaptcha cuando no estemos en local
		if ( !strcmp( $_SERVER['REMOTE_ADDR'],"127.0.01") ) {
			require_once('recaptchalib.php');
			$publickey = "6LddqNUSAAAAAMQXm-KGVJbxzsN78x1K-BbqD8CR"; // public_key
			echo recaptcha_get_html($publickey);
		}
		?>
	
		<p><input id="contact_submit" name="post_submit" type="submit" value="Send"/></p>
	
		</form>
	
		</div>

	</section>

	<?php include ("npc_footer.php"); ?>

</div>


</body>
</html>
