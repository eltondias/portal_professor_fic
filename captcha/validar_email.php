
<?php
include"../login/config.php";
include "../form/funcao.php";
   session_start();
   
	
	if ($_POST["palavra"] == $_SESSION["palavra"]){
		//echo "<h1>Voce Acertou</h1>";	
		
		 




if(isset($_POST['email'])){
	
	$mail_prof=$_POST['email'];

$sql_logar = "select top 1  cpf,situacao,nome,matric,email,senha,desligado from SEC_PROFESSOR
where email='".$mail_prof."'";
//echo $sql_logar;
$exe_logar = mssql_query($sql_logar) or die (mssql_error());
$fet_logar = mssql_fetch_assoc($exe_logar);
$num_logar = mssql_num_rows($exe_logar);

//Verifica se existe uma linha com o login e a senha digitado
	if ($num_logar == 0){
  		echo"<script> alert('Este E-mail não foi encontrado em nosso sistema.');</script>";
	return;
	} 
// atribuindo as variaveis
$email = $fet_logar['email'];
$senha = $fet_logar['senha'];
$cpf= $fet_logar['cpf'];



//verifica se o professor está ativo
	if($fet_logar['desligado']==1){
	echo"<script> alert('Usuario Concelado entre em contado com sua IES.');</script>";
	return;
	}
	
	//verifica se o CPF está correto
	if($fet_logar['cpf'] <> $_POST['cpf']){
		echo"<script> alert('CPF ou Email incoretos tente novamente!');</script>";
	 
	return;
	}

	$conteudo = "<img src='http://187.18.58.198:88/portal_professor_fic/form/img/logo.png'/>
			<p>Olá ".($fet_logar['nome']).", Recebemos uma solicitação de recuperação de senha.  </p>
			
			<table width='500' border='0'>
			<tr>
			<td >Email: ". $email."</td>
			 </tr>
			  <tr>
				<td>Senha: " . $senha. "</td>
			  </tr>
			</table>";
			
	if(sendMail($_POST['email'],$_POST['email'], $conteudo, 'Recuperação de Senha Professor Online-Podium'))
    {
       echo"<script> alert('Sua mensagem foi enviada com sucesso!');</script>";
	    
    }
    else
    {
        echo"<script> alert('Ocorreu um erro ao enviar! Tente mais tarde.');</script>";
		
    }
    
    exit();
}

session_start();





		
    return;
	}
	else{
		echo '<meta http-equiv="refresh" content="1; url=../form/index_erro.php">';
        
 
   
    }
?>

