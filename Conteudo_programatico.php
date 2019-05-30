<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("portalaluno.php"); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2º Via de Boleto</title>
<style type="text/css">
#apDiv1 {
	position: absolute;
	left: 52px;
	top: 2px;
	width: 195px;
	height: 89px;
	z-index: 1;
}
</style>
<link href="boleto_online/css/pagosenaopagos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv2 {
	position: absolute;
	left: 1004px;
	top: 3px;
	width: 108px;
	height: 80px;
	z-index: 2;
}
#apDiv2 p label {
	font-size: 5px;
}
#apDiv3 {
	position: absolute;
	left: 11px;
	top: 160px;
	width: 190px;
	height: 103px;
	z-index: 2;
	font-size: 10px;
}

input.semborda {
    background-color: transparent;
    border: 0px solid;

}
#apDiv4 {
	position: absolute;
	left: 68px;
	top: 10px;
	width: 185px;
	height: 72px;
	z-index: 1;
}
#apDiv5 {
	position: absolute;
	left: 364px;
	top: 411px;
	width: 561px;
	height: 23px;
	z-index: 2;
	overflow: auto;
}
</style>
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
}
		
		

</style>
</head>
<body>
<div id="informacao">Financeiro</div>

<div id="apDiv5"></div>



<link href="boleto_online/css/pagosenaopagos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="boleto_online/JS/selecaotable.js"></script>


<!--/*<table width="27%" border="0" align="center">
    <tr><form  method="post" action="" >
      <td width="62%">Matricula Aluno:</td>
      <td width="26%">
      <input type="text" name="matric" id="matric" size="20"/></td>
      <td width="12%"><input name="buscar" type="submit" id="buscar" value="Buscar" /></td>
    </form></tr>
</table>*/-->
<?php
$hoje= date('d/m/Y');


 $matric=$_SESSION['login'];
 $ano=$_SESSION['ano'];
 $periodo=$_SESSION['seqano'];
   

	echo'<div id="apDiv3">
  <p>&nbsp;</p>
  <table width="100%" border="0">
    <tr>
      <td width="64%" height="14" scope="col">PAGA</td>
      <td width="34%" bgcolor="#0000FF" scope="col">&nbsp;</td>
    </tr>
    <tr>
      <td>ABERTA</td>
      <td bgcolor="#FF0000">&nbsp;</td>
    </tr>
	<tr>
      <td>SEM BOLETA</td>
      <td bgcolor="#D49F00">&nbsp;</td>
    </tr>
  </table>
  <p>
  <table>
    <td width="153">* Solicite seu boleto em sua IES </td>
  </table>
  <table>
    <tr>
      <td width="153">* Não será Gerado boleto item 2</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</div>';
	
	

		//select para o banco de dados esmac
include("boleto_online/include/conexao.php");
		 $sql = " select * from view_ficha_fin_web				 
				 where matric=".$matric." and ano='".$ano."' and seqano='".$periodo."'							
				 order by ano,seqano,parcel,item "; 
				$cur_sec_boleto = @mssql_query($sql);
 				
				
				$sql1 = " select * from sec_alunos where matric=".$matric;
				$cur_sec_bolnome = @mssql_query($sql1);
				$row_sec_view_boleto2=@mssql_fetch_array($cur_sec_bolnome);
				
				$nome =utf8_encode($row_sec_view_boleto2['nome']);
			
				//criando a tabela das parcelas	
				echo'<br>
						  <table  border="0"  align="center"   width="65%"  >
							<tr>
							  <th cla width="5%" scope="col">Ano/S</th>
							  <th width="5%"scope="col">Parcela</th>
							  <th width="5%" scope="col">Vencimento</th>
							  <th width="8%" scope="col">Valor</th>
							  <th width="5%" scope="col">Pagamento</th>
							  <th width="5%"scope="col">Desconto</th>
							  <th width="8%" scope="col">Valor pago</th>
							  <th width="5%"scope="col">Multa</th>
							  <th width="5%"scope="col">Juros</th> 
							  <th hidden="" width="5%"scope="col"></th></tr>';
   						  

			while($row_sec_view_boleto= @mssql_fetch_array($cur_sec_boleto )) {
				//echo'<img src="/imagens/ajax-loader.gif" width="32" height="32" />
//<div id="apDiv1"><img src="imagens/logo_esmac.png" width="189" height="82" />';
				
				
				
				//--------------------colunas do select------------------\\
					$id = $row_sec_view_boleto ["id"];
					$parcel = $row_sec_view_boleto ["parcel"];
					$item = $row_sec_view_boleto ["item"];					
					$ano = $row_sec_view_boleto["ano"];
					$seqano = $row_sec_view_boleto["seqano"];
					$datven= $row_sec_view_boleto  ["datven"];
					$valmen =number_format($row_sec_view_boleto  ["valor_parcela"], 2, ',', '.'); 					
					$datpagto =$row_sec_view_boleto["datpagto"] ;
					$valdes = number_format($row_sec_view_boleto  ["valdes"], 2, ',', '.');
					$valorpago= number_format($row_sec_view_boleto  ["valorpago"], 2, ',', '.');
					$multa = number_format($row_sec_view_boleto  ["multa"], 2, ',', '.');
					$juros = number_format($row_sec_view_boleto  ["juros"], 2, ',', '.');
					$status = $row_sec_view_boleto  ["status"];
					$recibo = $row_sec_view_boleto  ["recibo"];				
					$parneg = $row_sec_view_boleto  ["parneg"];			
					$banco = $row_sec_view_boleto  ["banco"];
					$boleta = $row_sec_view_boleto  ["boleta"];
					$style = $row_sec_view_boleto  ["style"];
					$novencimento = $row_sec_view_boleto  ["novencimento"];
									
					if($item==1  and $style=='aberta' and is_null($boleta)){
	   					$style='naogerada';
	  }
   echo '
  	  <width="65%" class=" table1" align="center"><tr><form method="post" action="boleto_online/boleto_santander_banespa.php">
      <td width="5%" scope="col" class="'.$style.'">'.$ano.'-'.$seqano.'</td>
      <td width="5%" scope="col" class="'.$style.'">'.$parcel.'-'.$item.'</td>
      <td width="5%" scope="col" class="'.$style.'">'.$datven.'</td>
      <td width="8%" scope="col" class="'.$style.'valor">'.$valmen.'</td>
      <td width="5%" scope="col" class="'.$style.'">'.$datpagto.'</td>
      <td width="5%"  scope="col" class="'.$style.'valor">'.$valdes.'</td>
      <td width="8%" scope="col" class="'.$style.'valor">'.$valorpago.'</td>
      <td width="5%" scope="col" class="'.$style.'valor">'.$multa.'</td>
      <td width="5%" scope="col" class="'.$style.'valor">'.$juros.'</td>
	  <td  scope="col" hidden><input name="idparcela" value="'.$id.'"></td>
	  <td  scope="col" hidden><input name="anoseqano" value="'.$ano.'/'.$seqano.'"></td>
	  <td hidden="" scope="col" class="'.$style.'">'.$style.'</td>';
	  
	  if($item==1  and $style=='aberta' and $novencimento==0 ){
	  
	  echo'<td  width="1%" scope="col" class="'.$style.'"><input type="submit"class="button" name="2via" id="2via" value="2&ordm; Via"></form><tr>';
	  }
	   if( is_null($boleta)){
	    echo'<td hidden width="1%" scope="col" class="'.$style.'"></form><tr>';
	  }
	  else  {
	  echo'<td hidden="" width="1%" scope="col" class="'.$style.'"><input  type="submit" name="2via" id="2via" value="2&ordm; Via"></form></tr>';
	  }
   				  
			
			}
			
	echo'</table><br>';		


/*echo $hoje= date("d/m/Y").':hoje';
echo'<br>'.$datven.':vencimento';
echo $hoje + $datven;*/

?>
</body>
</html>