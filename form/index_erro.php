<!DOCTYPE html>
<html>
<head>
	<title>Recuperar Senha</title>
	<meta charset="iso-8859-1">
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
include"../login/config.php";
include "funcao.php";
?>
</head>

<body>
	<h2>Recuperação de senha </h2>
	
    <form method="post" id="formulario_contato" onsubmit="validaForm(); return false;" class="form" action="index.php">
		<p class="name">
           <!-- <label  for="name">Nome</label>-->        <span class="email">
           <label for="email3"> CPF</label>
           </span></p>
		<p class="name">
		  
          <input  name="cpf" id="cpf" placeholder="sem ponto nem traço" />
		</p>
		
		<p class="email">
          <label for="email">E-mail</label>
            <input type="text" name="email" id="email" placeholder="mail@exemplo.com.br" />
	  </p>		
      <p style="text-align:center; color:#F00; font-size:36px">ERRO</p>
      <p>
        <input  name="captch" id="captch" placeholder="informe aqui as letras" />
      </p>
	    <p class="text">
            <label for="mensagem"></label><p></textarea>
		</p>
		
		<p class="submit">
            <input type="submit" value="Enviar" />
		</p>
</form>


<script language= "JavaScript">
setTimeout("document.location = 'index.php'",1000);
</script>
</body>


<? 

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


?>
 <script type="text/javascript">
          
	    function validaForm()
        {
            erro = false;
           /* if($('#nome').val() == '')
            {
                alert('Você precisa preencher o campo Nome');erro = true;
            }*/
            if($('#email').val() == '' && !erro) {
                alert('Você precisa preencher o campo E-mail');erro = true;
				
            }
            if($('#cpf').val() == '' && !erro)
            {
                alert('Você precisa preencher o campo CPF');erro = true;
            }
                        //se nao tiver erros
            if(!erro)
            {
                $('#formulario_contato').submit();
            }
        }
    </script>
</html>