<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Boletim</title>
</head>
<?php include("portalaluno.php") ?>
<?php include("login\config.php"); ?>

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
	
	#selbol{
		position:absolute; 
		 width:650px; /* Tamanho da Largura da Div */
		 height:450px; /* Tamanho da Altura da Div */        
         /*top:50%; 
        margin-top:-150px; /* ou seja ele pega 50% da altura tela e sobe metade do valor da altura no caso 100 */
        left:50%;
       	margin-left:-325px; /* ou seja ele pega 50% da largura tela e diminui  metade do valor da largura no caso 250 */
	   	/*background-color:#F00;*/
	}			
	#arealivre{
			clear:both;
			}
	
	table
      {
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        width:100%;
       
      }
      table td
      {
        box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
        padding:3px 7px 2px 7px;
		font-size:12px;
		
      }
      table th
      {
        
		text-align:center;
		background:#808080;
		font-family:Verdana, Geneva, sans-serif;
		font-size:18px;
		text-align:center;
		background:#F1EFF0;
		font-family:Verdana, Geneva, sans-serif;
		font-size:15px;
		box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
			-moz-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
			-webkit-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
			/*font-size:1em;
        text-align:left;
        padding-top:5px;
        padding-bottom:4px;
        background-color:#009;
        color:#fff;*/
      }
      table tr.alt td
      {
        color:#000;
        background-color:#D6EDFF;
		font-size:12px;
      }

					
</style>
<body>
<div id="informacao">Boletim</div>
<?php
	$sql = " select *
				   from view_boletim_web
				   where matric=".$_SESSION['login'].
				   " and ano='".$_SESSION['ano']."' and seqano='".$_SESSION['seqano']."'".
				   " order by discip";
	$cur_boleti = @mssql_query($sql) or die("erro");
	
?>
<div id="arealivre"></div>
<P>
<div id="selbol">
	<table>
    	<tr>
            <th>Disciplina</th>
            <th>Ava1</th>
            <th>Ava2</th>
            <th>Total</th>
            <th>NEF</th>
            <th>Prec.</th>
            <th>Final</th>
            <th>Falta</th>
        </tr>
        	<?php
				$zebra=0;
				$style="";
				while($row_boleti =@mssql_fetch_array($cur_boleti)){		
					$total_falta=$row_boleti['totfal'];
					$resultado=$row_boleti['result'];
						 
					$zebra++;
					if($zebra==2){
						$style="alt";
						$zebra=0;
						}
						else{
							$style="";
						}
				    echo "<tr class='".$style."'>";
					echo"<td  width='51%'>".utf8_encode($row_boleti['discip'])."</td>";
					echo"<td width='7%'>".$row_boleti['col1']."</td>";
					echo"<td width='7%'>".$row_boleti['col2']."</td>";
					echo"<td width='7%'>".$row_boleti['col3']."</td>";
					echo"<td width='7%'>".$row_boleti['col4']."</td>";					
					echo"<td width='7%'>".$row_boleti['col5']."</td>";
					echo"<td width='7%'>".$row_boleti['col6']."</td>";
					echo"<td width='7%'>".$row_boleti['col7']."</td>";
					echo "</tr>";
				}          
			?>        	
			
	</table>
	<p>
    <div>Total de Faltas:<?php echo $total_falta; ?></div>
    <div>Resultado:<?php echo $resultado; ?></div>

</div>

</body>
</html>