<?php 
	include("../../login/restrito.php");
	include("../../login/config.php");  

$retorno="Conteúdo Não foi Salvo ";

while(list($key,$val) = each($_POST)){
	
	$retorno="Conteúdo Salvo com Sucesso ";
	
	$obj=$key;
	$valor=$val;
	$campo=trim(substr($key,8,10));
	$data=substr($key,0,4).substr($key,4,2).substr($key,6,2);
	
		$sql = "update sec_profdiscipdia
				   set ".$campo."='".utf8_decode($valor)."'
			       where ano='".$_SESSION['ano']."' 
				   and seqano='".$_SESSION['seqano']."' 
				   and turma='".$_SESSION['turma']."'
				   and discip='".$_SESSION['disciplina']."'
				   and matric=".$_SESSION['matric']."
				   and convert(varchar(10),dia,112)='".$data."'";
	$cur_sec_profdiscipdia = mssql_query($sql)or die(mssql_error());
}
echo $retorno;	
	
?>
