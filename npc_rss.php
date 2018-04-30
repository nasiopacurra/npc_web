<?php include ("npc_users.php"); ?>

<!DOCTYPE html>

<html lang="es-ES">
<head>
	<?php include ("npc_head_meta.php"); ?>
	<?php include ("npc_head_title.php"); ?>
	<?php include ("npc_head_css.php"); ?>
	<link href="stylesheets/posts/_controller.css" media="screen" rel="stylesheet" type="text/css"/>
	<link href="stylesheets/posts/index.css" media="screen" rel="stylesheet" type="text/css"/>
	<?php include ("npc_head_js.php"); ?>
</head>
<body>
<div id="wrapper" class="homepage">

	<?php include ("npc_login_register.php"); ?>
	<?php include ("npc_topnav.php"); ?>

	<section id="main">
	
	<?php include ("npc_sidebar.php"); ?>
	
	<section id="posts">
	
	<?php
	include("conexion.php"); 
	$query = "SELECT * 
			  FROM npc_rss_items
			  WHERE rssitem_enable = '1' 
			  ORDER BY rssitem_pubDate DESC";
	$result=mysql_query($query, $conexion);
	if (!$result)  { die("<br />Error de SQL: ".mysql_error()."<br />"); }
	if ( mysql_num_rows($result) > 0 ) {
		while($row = mysql_fetch_array($result))
		{
			echo '<article class="post">'.PHP_EOL;
			echo '<header>'.PHP_EOL;
			echo '<h3><a href="'.$row['rssitem_link'].'">'.$row['rssitem_title'].'</a></h3>'.PHP_EOL;
			echo '</header>'.PHP_EOL;
			echo '<div class="post-content">'.PHP_EOL;
			echo '<p>'.$row['rssitem_description'].'</p>'.PHP_EOL;
			echo '</div>'.PHP_EOL;
			echo '</article>'.PHP_EOL;
		}
	} else {
		echo '<article class="post">'.PHP_EOL;
		echo '<header>'.PHP_EOL;
		echo '<h3><a href="#"> NO Existen Chanchulos</a></h3>'.PHP_EOL;
		echo '</header>'.PHP_EOL;
		echo '</article>'.PHP_EOL;
	}
	mysql_close($conexion);
	?>
	
	</section>

	<?php include ("npc_footer.php"); ?>

</div>


</body>
</html>
