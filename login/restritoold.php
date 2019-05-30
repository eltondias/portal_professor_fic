<?php
@session_start();

if (isset($_SESSION['login']) && isset($_SESSION['senha'])){
   $login_usuario = $_SESSION['login'];
}
else {
   header("Location:http://187.18.58.198:88/professor_online/login/index.php");
   exit();
}


?>
