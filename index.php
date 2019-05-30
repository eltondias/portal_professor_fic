<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Informacao Pessoal</title>
<style type="text/css">
#apDiv2 table tr td {
	text-align: left;
}
</style>
</head>
<?php 
include("login/restrito.php");
include("login/config.php"); 
include("portalaluno.php");


 $matric=$_SESSION['login'];
 $ano=$_SESSION['ano'];
 $periodo=$_SESSION['seqano'];

				$sql = " select * from view_aluno_web where matric=".$matric." and ano='".$ano."' and seqano='".$periodo."'";
				$cur_sec_alunos = @mssql_query($sql);
				$row_sec_alunos=@mssql_fetch_array($cur_sec_alunos);
				
				$nome =utf8_encode($row_sec_alunos['nome']);
				$matric_view =utf8_encode($row_sec_alunos['matric']);
				$turma =utf8_encode($row_sec_alunos['turma']);
				$bairro=utf8_encode($row_sec_alunos['bairro']);
				$cidade=utf8_encode($row_sec_alunos['cid']);
				$uf=utf8_encode($row_sec_alunos['uf']);
				$cep=utf8_encode($row_sec_alunos['cep']);
				$endereco=utf8_encode($row_sec_alunos['endereco']);
				$email=utf8_encode($row_sec_alunos['email']);
				$fone=utf8_encode($row_sec_alunos['fone']);
				$fonecel=utf8_encode($row_sec_alunos['fonecel']);
				$pai=utf8_encode($row_sec_alunos['pai']);
				$mae=utf8_encode($row_sec_alunos['mae']);
?>

<style type="text/css">
	#informacao{
		text-align:center;
		background:#C6C6F2;
		font-family:Verdana, Geneva, sans-serif;
		font-size:18px;
		box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
		-moz-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
		-webkit-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
		
		
		}

#apDiv2 {
	position: absolute;
	left: 20px;
	top: 201px;
	width: 457px;
	height: 32px;
	z-index: 2;
	font-size: 12px;
	
		
}
#tabledados {
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	width:100%;	
	padding:3px 7px 2px 7px;
	font-size:12px;
	border-radius:20px;
	background:#F5F5F5;
	-webkit-box-shadow: 1px 2px 6px rgba(192, 192, 192, 192);
	
	
	


}

#apDiv1 {
	position: absolute;
	left: 63px;
	top: 201px;
	width: 100px;
	height: 500px;
	z-index: 3;
}
</style>
<div id="informacao">Informações Pessoal</div>
<body>
<div id="apDiv2">
  <table id="tabledados" width="833" height="266" border="0">
  <tr>
    <th>&nbsp;</th>
    <th align="center">DADOS CADASTRAIS</th>
 
  <tr>
    <th>Nome</th>
    <td ><?php echo " $nome";?></td>
    <tr>
    <th>Turma</th> <td><?php echo " $turma";?></td><tr><th>Endereço</th>
      <td><?php echo " $endereco";?>, BAIRRO <?php echo " $bairro";?>, CIDADE<?php echo " $cidade";?> ,CEP <?php echo " $cep";?>, UF, <?php echo " $uf";?></td>
    <tr>
      <th>Email</th>
      <td><?php echo " $email";?></td>
    <tr>
      <th>Fone</th>
      <td><?php echo " $fone";?></td>
    <tr>
      <th>Celular</th>
      <td><?php echo " $fonecel";?></td>
    <tr>
      <th>Pai</th>
      <td><?php echo " $pai";?></td>
    <tr>
      <th>Mãe</th>
      <td><?php echo " $mae";?></td>
  </table>
</div>

</body>
</html>