<?php
// -------------------------------------------------------------------------
// comprobar_email
// -------------------------------------------------------------------------
function comprobar_email($email){
    $mail_correcto = false;
    //compruebo unas cosas primeras
    if ( (strlen($email) >= 6) && 
	     (substr_count($email,"@") == 1) && 
		 (substr($email,0,1) != "@") && 
		 (substr($email,strlen($email)-1,1) != "@")){
       if ( (!strstr($email,"'")) && 
	        (!strstr($email,"\"")) && 
			(!strstr($email,"\\")) && 
			(!strstr($email,"\$")) && 
			(!strstr($email," ")) ) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if ( strlen($term_dom)>1 && 
			      strlen($term_dom)<5 && 
				 (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = true;
                }
             }
          }
       }
    }
    return $mail_correcto;
} 
// -------------------------------------------------------------------------
// comprobar_email
// -------------------------------------------------------------------------
function comprobar_password($clave){
	$password_correcta = false;
	if( (strlen($clave) < 8) ||
	    (strlen($clave) > 30) ||
        !preg_match('`[a-z]`',$clave) ||
	    !preg_match('`[A-Z]`',$clave) ||
	    !preg_match('`[0-9]`',$clave) ) {
		$password_correcta = true;
	}
   // return $password_correcta;
   return true;
} 
?>

<?php
$registro = false;
// Verificamos el reCaptcha cuando no estemos en local
if ( !strcmp( $_SERVER['REMOTE_ADDR'],"127.0.01") ) {
	require_once('recaptchalib.php');
	$privatekey = "6LddqNUSAAAAAIPjVjQvYwA6rT2c2aMZv9uoEzYU"; // private_key
	$resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) {
		// What happens when the CAPTCHA was entered incorrectly
		// die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
		//      "(reCAPTCHA said: " . $resp->error . ")");		
		$errtxt = "Codigo Captcha Incorrecto";
	} else {
		$registro = true;
	}
} else {
	$registro = true;
}
// Trasportamos las variables $_POST a variables PHP.
foreach($_POST as $k=>$v) {  $$k = $v; };

// Validamos los campos de entrada
// j_email formato 
//if ( $registro && !comprobar_email($j_email) ) {
//	$registro = false;
//	$errtxt = "Formato de email Incorrecto";
//}
// j_password == j_password_confirmation
if ( $registro && !strcmp(j_password,j_password_confirmation) ) {
	$registro = false;
	$errtxt = "Confirmacion de Password Incorrecta";
}
// j_password Formato (mayuscula, minuscula, tamaño, caracteres
if ( $registro && !comprobar_password($j_password) ) {
	$registro = false;
	$errtxt = "Formato de Password Incorrecto";
}

// Procedemos a realizar el registro
if ( $registro ) {

	include("conexion.php");
	$cmdSQL='INSERT INTO npc_users (usuario,password,nivel,nombre,email,boletin)
			VALUES ("'.$j_username.'","'.$j_password.'",8,"'.$j_name.'","'.$j_email.'",'.$j_is_email_subscribed.')';
	if (!mysql_query($cmdSQL, $conexion)) { die("Error en Insert: ".mysql_error()); }
	mysql_close($conexion);
	
	header("location:index.php");
} else {
	header("location:registro.php?error=true&errtxt='".$errtxt."'");
}
?>