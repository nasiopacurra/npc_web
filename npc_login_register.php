	<section id="login-register">
		<?php
		if ( empty($user_nivel) || $user_nivel < 1) {
			echo '<div class="text-links">', PHP_EOL;
			echo '<a href="registro.php">Registro</a> | ', PHP_EOL;
			echo '<a href="login.php">Entrar</a>', PHP_EOL;
			echo '</div>', PHP_EOL;
		} else {
			echo '<div class="text-links">', PHP_EOL;
			echo '<a href="cuenta.php">'.$user_nombre.'</a> ('.$user_nivel.') | ', PHP_EOL;
			echo '<a href="logout.php">Salir</a>', PHP_EOL;
			echo '</div>', PHP_EOL;
		}
		?>
		<a href="http://twitter.com/nasiopacurra" target="_blank">
		<img alt="Twitter-icon" border="0" class="twitter-icon" src="images/twitter-icon.png"/></a>
	</section>
