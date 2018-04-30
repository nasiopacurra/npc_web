<?php include ("npc_users.php"); ?>

<!DOCTYPE html>

<?php
if (empty($_REQUEST)) {	
	$_REQUEST = array("error" => "false"); 
}
?>

<html lang="es-ES">
<head>
	<?php include ("npc_head_meta.php"); ?>
	<?php include ("npc_head_title.php"); ?>
	<?php include ("npc_head_css.php"); ?>
	<link href="stylesheets/user_sessions/_controller.css" media="screen" rel="stylesheet" type="text/css"/>
	<link href="stylesheets/user_sessions/new.css" media="screen" rel="stylesheet" type="text/css"/>
	<?php include ("npc_head_js.php"); ?>
</head>
<body>
<div id="wrapper" class="homepage">

	<?php include ("npc_login_register.php"); ?>
	<?php include ("npc_topnav.php"); ?>
	
	<section id="main">
	
		<div class="form-container">
			<div class="form-header">
			<h4>Entrar en tu cuenta</h4>
			</div>
		
			<form action="j_security_check.php" class="new_user_session" id="new_user_session" method="post">

			<?php
			if ($_REQUEST["error"]=="true") { 
				echo '<div class="errorExplanation" id="errorExplanation">';
				echo '<ul><li>Usuario o Contrase&ntilde;a Erroneo</li></ul>';
				echo '</div>';
			}
			?>
			
			<div class="label-and-input">
				<div class="label-container"><label for="user_session_username">Usuario</label></div>
				<div class="input-container"><input id="user_session_username" name="j_username" size="30" type="text"/></div>
			</div>
		
			<div class="label-and-input">
				<div class="label-container"><label for="user_session_password">Contrase&ntilde;a</label></div>
				<div class="input-container"><input id="user_session_password" name="j_password" size="30" type="password"/></div>
			</div>
		
			<p>
			<input id="user_session_submit" name="commit" type="submit" value="Submit"/>
			&nbsp;&nbsp;&nbsp;<a href="npc_passwd_reset.php" class="forgot-password-link">Olvidaste la contrase&ntilde;a?</a>
			</p>
		
			</form>
		
		</div>

	</section>

	<?php include ("npc_footer.php"); ?>

</div>

</body>
</html>
