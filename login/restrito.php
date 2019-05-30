<?php
@session_start();




if (isset($_SESSION['login']) && isset($_SESSION['senha'])){
   $login_usuario = $_SESSION['login'];
	
	if($_SESSION['tempo']<$tempo=time()){
	echo"
<script LANGUAGE=\"Javascript\">
alert(\"Atenção: Sua sessão expirou logue novamente .\");
</SCRIPT>";
	$_SESSION_DESTROY;
	
	header("Location:".$_SERVER['REQUEST_URI']."login/index.php");
	//echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	
	}
	
	else{
		$_SESSION['tempo']=time()+(60*30);
		
		}
}
else {
	
	header("Location:".$_SERVER['REQUEST_URI']."login/index.php");
    //echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
   exit();
}


?>
