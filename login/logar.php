<?php

session_start();
  
        
		
		include("config.php");

$loginx =$_SESSION['login'];
$senhax =$_SESSION['senha'];

	$invalidos = array();
	$invalidos[0] = "/'/";
	$invalidos[1] = '/ or /';
	$invalidos[2] = '/ insert /';
	$invalidos[3] = '/ union /';
	$invalidos[4] = '/=/';
	$invalidos[5] = '/--/';
	$invalidos[6] = '/|/';
	
  
    $login = preg_replace($invalidos, '',$loginx);
	$senha = preg_replace($invalidos, '',$senhax);
	



/*if($login){
	
 echo "Os campos matricula e senha não numericos. ";
 echo "<br><a href='index.php'>Clique aqui para volta.</a>";*/


 
	
	
/*else*/

/* Verifica se existe usuario, o segredo ta aqui quando ele procupa uma 
linha q contenha o login e a senha digitada */
$sql_logar = "select top 1  situacao,nome,matric,email,senha,desligado from SEC_PROFESSOR
where email='".$login."'  and senha ='".$senha."'";
//echo $sql_logar;
$exe_logar = mssql_query($sql_logar) or die (mssql_error());
$fet_logar = mssql_fetch_assoc($exe_logar);
$num_logar = mssql_num_rows($exe_logar);


//echo $fet_logar['nome'].'-';echo $fet_logar['desligado'].'-';


//Verifica se existe uma linha com o login e a senha digitado
if ($num_logar == 0){
   
  
   echo '<div id "error">
<ul><h3>Imagem Digitada Incorretamente</h3></ul>
<p><br/><span><img src="imagem/erro_captcha.jpg"></span></p>
</p> <a href="index.php">Clique aqui para voltar</a>
</div>';    
} 

//verifica se o professor está ativo
elseif($fet_logar['desligado']=='1'){
	echo '<div id "error">
<ul><h3>Imagem Digitada Incorretamente</h3></ul>
<p><br/><span><img src="imagem/erro_captcha.jpg"></span></p>
</p> <a href="index.php">Clique aqui para voltar</a>
</div>'; 
	
	}
/*elseif($fet_logar['activo'] == "N"){
   echo "Usuario não ativado, verifique seu e-mail para ativa a conta.";
   echo "<br><a href='javascript:window.history.go(-1)'>Clique aqui para volta.</a>"; 
}*/
else{
   //manda a sessão pra pagina index.php
   
   
   $_SESSION['login'] = $login;
   $_SESSION['senha'] = $senha;
  /* $_SESSION['ano'] = $fet_logar['ano'];
   $_SESSION['seqano'] = $fet_logar['seqano'];*/
   $_SESSION['nome'] = $fet_logar['nome'];
   $_SESSION['matric'] = $fet_logar['matric'];
   $_SESSION['palavra'] = $palavra; 
   $_SESSION['tempo'] =time()+60;
   header("Location:../index.php");
}








?>