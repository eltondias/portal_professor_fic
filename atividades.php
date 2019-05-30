<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Atividades Complementares</title>
</head>
<?php include("login\config.php"); ?>
<?php include("portalaluno.php"); ?>

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
	
	th{
		
		text-align:center;
		background:#F1EFF0;
		font-family:Verdana, Geneva, sans-serif;
		font-size:14px;
		box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
			-moz-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
			-webkit-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
	}	
	td{
		
		font-family:Verdana, Geneva, sans-serif;
		text-align: left;
		background:##F1EFF0;
		font-family:Verdana, Geneva, sans-serif;
		font-size:13px;
		box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
		-moz-box-shadow: 1px 2px 6px rgba(241, 241, 241, 0.5);
		-webkit-box-shadow: 1px 2px 6px rgba(241, 241, 241, 30);
	}	
	#tableatv{
		
		
	}
	table{
		vertical-align:50%
		bor
		}
		#label{
			text-align:center;
			}
	td{
		box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);}
	 table tr.alt td
      {
        
		color:#000;
        background-color:#D6EDFF;
		font-size:12px;
		border: thin;
      }
	  	#total{
			font-family:Verdana, Geneva, sans-serif;
		text-align: center;
		background:##F1EFF0;
		
		font-family:Verdana, Geneva, sans-serif;
		font-size:13px;
		box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
		-moz-box-shadow: 1px 2px 6px rgba(241, 241, 241, 0.5);
		-webkit-box-shadow: 1px 2px 6px rgba(241, 241, 241, 30);
			}
		
</style>
<body>
<div id="informacao">Atividades Complementares</div><p>
<?php 
	$sql1 = "SELECT  SUM(chr) as chr FROM SEC_ATVCOMITE WHERE matric=".$_SESSION['login'];
	$cur_atividadescont = @mssql_query($sql1);
	$row_atividadescont=@mssql_fetch_array($cur_atividadescont);
	$chr=$row_atividadescont['chr'];
	

	$sql = "SELECT  * FROM SEC_ATVCOMITE WHERE MATRIC=".$_SESSION['login']." order by id";
	$cur_atividades = @mssql_query($sql);
//	$row_atividades =@mssql_fetch_array($cur_atividades);
	
?>
<div id="tableatv"> 
<?php		

if ($chr==null){
				echo'<div id="label"> <label title="Aviso">Voçê não possui Atividades Complementares.</label></div>';
			}
			else{


echo'<div ><p><table align="center"> 
				<th>Nº</th>
				<th>Período</th>
				<th>Local</th>
				<th>Evento</th>
				<th>Empresa</th>
				<th>Chr</th>';
				$zebra=0;
				$style="";
			while($row_atividades =@mssql_fetch_array($cur_atividades)){
				$zebra++;
					
					if($zebra==2){
						$style="alt";
						$zebra=0;
						}
						else{
							$style="";
						}
				echo "<tr class='".$style."'><td hidden >".$row_atividades['curso']."</td>
				<td  >".utf8_encode($row_atividades['ord'])."</td>
				<td >".utf8_encode($row_atividades['periodo'])."</td>
				<td >".utf8_encode($row_atividades['localcur'])."</td>
				<td >".utf8_encode($row_atividades['evento'])."</td>
				<td >".utf8_encode($row_atividades['empresa'])."</td>
				<td >".utf8_encode($row_atividades['chr'])."</td></tr>";
							
			}
			}
			
									
			?>

			</table>
            <p id="total" align="center">Total de carga horária: <?php echo $chr; ?></p>
			

       
	

</body>
</html>