
<style type="text/css">
#boxinformativo {
	margin-left:6px;
	margin-top:1px;
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
	

</style>

<?php 

if(isset($_REQUEST['turma'])){
	$turma_receb=$_REQUEST['turma'];
	$discip_receb=$_REQUEST['discip'];
$sql = 'SELECT NOME,MATRIC,SITUACAO   	 FROM VIEW_ALUNO_TURMA	
						 WHERE 	 						 
						 	ESCOLA=1 				 
						 	AND ANO=2014
						 	AND SEQANO=1
						 	AND TURMA='.$turma_receb.'    
						 	AND SIT IN ("M","T","S","C","A") 
						 	AND DISCIP=	'.$discip_receb.' 
						 ORDER BY NOME ';
			
		$cur_web_falta = @mssql_query($sql);
		$row_web_falta= @mssql_fetch_array($cur_web_falta);
		$cur_web_falta = @mssql_query($sql);	
		echo'<div id="boxinformativo" > <th>Matrícula</th><th>Nome</th><th>dia</th><tr></tr>';
		while($row_web_falta= @mssql_fetch_array($cur_web_falta )) {
			echo'	<table> 		
			<td>'.utf8_encode($row_web_falta["MATRIC"]).'<td>'.utf8_encode($row_web_falta["NOME"]).'  '.utf8_encode($row_web_falta["SITUACAO"]).'</td>';
			
			
		}
			echo'</div>';
}
else {
}
			?>