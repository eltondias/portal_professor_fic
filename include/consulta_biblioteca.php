<?php
$_SESSIONSTART['ERROBIBLI'];
if (count($_REQUEST['area_bibli'])<10){
$_SESSIONSTART['ERROBIBLI']=1;
header('location:../biblioteca/biblioteca.php');
}
$CONSULTA=$_REQUEST['area_bibli'];
$SQL_CONSULTA="select * from dbo.VIEW_CONSULTA_BIBLIOTECA where titulo like('%".$CONSULTA."%') and palavra like('%".$CONSULTA."%') and autor like('%".$CONSULTA."%') and subtit like('%".$CONSULTA."%')
";
$CUR_BIBLIOTECA = @mssql_query($SQL_CONSULTA) or die("ERRO NA CONEXÃO");





header('location:../biblioteca/biblioteca.php');



?>