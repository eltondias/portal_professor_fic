<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Período</title>
</head>
<?php include("login\config.php"); ?>
<?php include("portalaluno.php"); ?>

<style type="text/css">
	#informacao{
		text-align:center;
		background:#C6C6F2;
		font-family:Verdana, Geneva, sans-serif;
		font-size:18px;
		text-align:center;
		background:#C6C6F2;
		font-family:Verdana, Geneva, sans-serif;
		font-size:18px;
		box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
			-moz-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
			-webkit-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
	}
	
	#selper{
		text-align:center;
		font-family:Verdana, Geneva, sans-serif;
		font-size:14px;
		
		
		
	}	
	</style>
<body>
<div id="informacao">Período</div><p>
<?php
	$sql = " select ano,seqano 
				   from VIEW_LOGIN_WEB
				   where matric=".$_SESSION['login'].
				   " order by ano desc ,seqano desc ";
	$cur_periodo = @mssql_query($sql);
?>
<form method="post" action="portalaluno.php">
<div id="selper">Selecione o período: 
<select name="periodo" id="periodo" size="">
		
		<?php		
			while($row_periodo =@mssql_fetch_array($cur_periodo)){			 
			echo"<option value='".$row_periodo['ano'].'-'.$row_periodo['seqano']."'>".utf8_encode($row_periodo['ano']."-".$row_periodo['seqano'])."</option> ";
		
		}?></select>
        <input type="submit" value="Alterar">
</div>
</form>	

</body>
</html>