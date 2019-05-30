
<style type="text/css">
#boxinformativo {
	margin-left:8px;
	margin-top:1px;
	margin-bottom:2px;
	left: 21px;
	top: 1px;
	width: 288px;
	height: 145px;
	z-index: 1;
	border: #D9D7D8 solid;
	border-width: 1px 1px 1px 1px;
	border-radius:3px;
	-webkit-box-shadow:inset 2px 2px 2px 3px #F9FFE8;
	box-shadow:inset 2px 2px 2px 3px #F9FFE8;
	float: left;
}

#postado{
	font: Verdana, Geneva, sans-serif;
	font-size:8px;
	
	margin-bottom:1px;
	text-align:left;
	
}
#mensagem{
	font: Verdana, Geneva, sans-serif;
	font-size: inherit ;
	text-align:center;
	
	
}
#titulo{
	margin-top:0px;
	font: Verdana, Geneva, sans-serif;
	font-size:16px;
	text-align:center;
	
	
}
</style>

<?php 
$sql1 = 'select * from web_informativo_prof';
			
		$cur_web_infor = @mssql_query($sql1);
		$row_web_infor= @mssql_fetch_array($cur_web_infor);
		
		$periodo_ini= (utf8_encode($row_web_infor ["periodo_ini"]));
		$periodo_fim= (utf8_encode($row_web_infor ["periodo_fim"]));
					
		$cur_web_infor = @mssql_query($sql1);	
		while($row_web_infor= @mssql_fetch_array($cur_web_infor )) {
		$mensagem= (utf8_encode($row_web_infor["mensagem"]));
		$operador= (utf8_encode($row_web_infor ["operador"]));
		$titulo= (utf8_encode($row_web_infor ["titulo"]));
			
		
		echo	'<table id="boxinformativo">
		<th id="titulo">'.$titulo.'</th><tr></tr>
		<td id="mensagem">'.$mensagem.'</td><tr></tr>
		<td id="postado">Autor:'.$operador.'</td>';
		
		
		}

echo'</table>';
?>