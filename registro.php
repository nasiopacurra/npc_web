<!DOCTYPE html>

<?php
if (empty($_REQUEST)) {	
	$_REQUEST = array("error" => "false", "errtxt" => ""); 
}
?>

<html lang="es-ES">
	<?php include ("npc_head_meta.php"); ?>
	<?php include ("npc_head_title.php"); ?>
	<?php include ("npc_head_css.php"); ?>
	<link href="stylesheets/users/_controller.css" media="screen" rel="stylesheet" type="text/css"/>
	<link href="stylesheets/users/register.css" media="screen" rel="stylesheet" type="text/css"/>
	<?php include ("npc_head_js.php"); ?>
<body>
<div id="wrapper" class="homepage">

	<?php include ("npc_login_register.php"); ?>
	<?php include ("npc_topnav.php"); ?>

	<section id="main">
		<div class="form-container">
			
			<div class="form-header">
				<h4>Registro</h4>
			</div>
			
			<form action="npc_alta_user.php" class="new_user" id="new_user" method="post">

			<?php
			if ($_REQUEST["error"]=="true") { 
				echo '<div class="errorExplanation" id="errorExplanation">';
				echo '<ul><li>Error: '.$_REQUEST["errtxt"].'</li></ul>';
				echo '</div>';
			}
			?>
			
			<div class="label-and-input">
				<div class="label-container"><label for="user_username">Usuario</label></div>
				<div class="input-container"><input id="user_username" name="j_username" size="30" type="text"/></div>
			</div>
			<div class="label-and-input">
				<div class="label-container"><label for="user_name">Nombre</label></div>
				<div class="input-container"><input id="user_name" name="j_name" size="30" type="text"/></div>
			</div>
			<div class="label-and-input">
				<div class="label-container"><label for="user_email">Email</label></div>
				<div class="input-container"><input id="user_email" name="j_email" size="30" type="text"/></div>
			</div>
			<div class="label-and-input">
				<div class="label-container"><label for="user_password">Contrase&ntilde;a</label></div>
				<div class="input-container"><input id="user_password" name="j_password" size="30" type="password"/></div>
			</div>
			<div class="label-and-input">
				<div class="label-container"><label for="user_password_confirmation">Confirmar Contrase&ntilde;a</label></div>
				<div class="input-container"><input id="user_password_confirmation" name="j_password_confirmation" size="30" type="password"/></div>
			</div>
			<div class="label-and-input">
				<input name="j_is_email_subscribed" type="hidden" value="0"/>
				<input id="user_is_email_subscribed" name="j_is_email_subscribed" type="checkbox" value="1"/>
				<label class="email-subscription-label" for="user_is_email_subscribed">Si, quiero que me envien Noticias por Email.</label>
			</div>
			
			<?php
			// Verificamos el reCaptcha cuando no estemos en local
			if ( !strcmp( $_SERVER['REMOTE_ADDR'],"127.0.01") ) {
				require_once('recaptchalib.php');
				$publickey = "6LddqNUSAAAAAMQXm-KGVJbxzsN78x1K-BbqD8CR"; // public_key
				echo recaptcha_get_html($publickey);
			}
			?>
			
			<p><input id="user_submit" name="commit" type="submit" value="Submit"/></p>
			
			</form>
			
		</div>
	</section>


	<?php include ("npc_footer.php"); ?>

</div>

</body>
</html>
