<?php
$dbhost   = "167.249.211.98";   #Nome do host
$db       = "fic";   #Nome do banco de dados
$user     = "sa"; #Nome do usuário
$password = "fic15bd2015";   #Senha do usuário
 
// Dados da tabela
$tabela = "sec_alunos";    #Nome da tabela
$campo1 = "matric";  #Nome do campo da tabela
$campo2 = "nome";  #Nome de outro campo da tabela
 
@mssql_connect($dbhost,$user,$password) or die("Estamos com problema em nossos servidores por favor retorne mais tarde!");
@mssql_select_db("$db") or die("Estamos com problema em nossos servidores retorne mais tarde!");
 
?>
