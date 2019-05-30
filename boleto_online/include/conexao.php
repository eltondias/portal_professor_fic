<?php
$dbhost   = "25.119.198.156";   #Nome do host
$db       = "ESMAC";   #Nome do banco de dados
$user     = "sa"; #Nome do usuário
$password = "esmac1968";   #Senha do usuário
 
// Dados da tabela
$tabela = "sec_alunos";    #Nome da tabela
$campo1 = "matric";  #Nome do campo da tabela
$campo2 = "nome";  #Nome de outro campo da tabela
 
@mssql_connect($dbhost,$user,$password) or die("Estamos com problema em nossos servidores por favor retorne mais tarde!");
@mssql_select_db("$db") or die("Estamos com problema em nossos servidores retorne mais tarde!");


//----------- testando se o banco está retornando -----------------------------------\\
//$instrucaoSQL = "SELECT $campo1, $campo2 FROM $tabela ORDER BY $campo1";
//$consulta = mssql_query($instrucaoSQL);
//$numRegistros = mssql_num_rows($consulta);
// 
//echo "Esta tabela contém $numRegistros registros!\n<hr>\n";
// 
//if ($numRegistros!=0) {
//	while ($cadaLinha = mssql_fetch_array($consulta)) {
//		echo "$cadaLinha[$campo1] - $cadaLinha[$campo2]\n<br>\n";
//	}
//}
?>


