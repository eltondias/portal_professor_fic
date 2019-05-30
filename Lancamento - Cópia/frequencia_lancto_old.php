<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	include("../login/restrito.php");
	include("../login/config.php");  
?>

<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script src="../prg/jav/professor_disciplina.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Frequência</title>
</head>
	<link href="../css/home.css" rel="stylesheet" type="text/css">
	<style type="text/css"></style>
</head>
<body>

<div id="top-container">
  <div id="top">
    <p> <?php echo utf8_encode($_SESSION['nome'])."-".utf8_encode( $_SESSION['matric']); ?>
    &nbsp;&nbsp;<a href="sair.php">Sair</a></p>  </div>
</div>

<div id="container">
    <div id="content-right2">   
	
    
	<div id="box3">
	    <a href='frequencia.php'><button>Voltar</button></a>
    		<h3><?php echo "Frequencia : ".utf8_encode($_SESSION['periodo'])." | Turma: ".utf8_encode( $_SESSION['turma'])." | ".utf8_encode( $_SESSION['disciplina_des']);?></h3>
        <h3><?php echo "Mês de Referência:Outubro "." Data: ".$_SESSION['data_frq']." | N. Aula(s): ".utf8_encode( $_SESSION['n_aula']); ?></h3>

        <br>
        <form action="" method="post" name="frq"  id="frq">
        <table id="tabela_aluno" width="0" border="1" style="table-layout: fixed;border-collapse:collapse;">
		<?php 
			$data_frq=substr($_SESSION['data_frq'],6,4)."-".substr($_SESSION['data_frq'],3,2)."-".substr($_SESSION['data_frq'],0,2);
			$mes=substr($_SESSION['data_frq'],3,2);
			$dia=substr($_SESSION['data_frq'],0,2);
			
			/*HADER DO GRID DE PRESENÇA*/
			echo "<tr><td width='20'>N.</td><td width='380'>Aluno</td><td width='64'>Matr&iacute;cula</td>";
			$dia_selecionado=0;
						
			/*VERIFICANDO SE EXISTEM OUTROS DIAS JÁ LANÇADOS*/
			$sql = " select 
						dia as data,cast(day(dia) as varchar(2)) as dia
					from view_aluno_frequencia
			        where ano='".$_SESSION['ano']."' 
				    and seqano='".$_SESSION['seqano']."' 
				    and turma='".$_SESSION['turma']."'
				    and discip='".$_SESSION['disciplina']."' 
					and sit='M' and situacao='' 
					and month(dia)=".$mes."	
					group by dia
				    order by dia";
			$cur_dias_lancados = mssql_query($sql);
			$n_dias=0;	
			while($row_dias_lancados = mssql_fetch_array($cur_dias_lancados)){
				$n_dias++;
				echo "<td width=30'>".$row_dias_lancados['dia']."</td>";
				$dia_selecionado=( $row_dias_lancados['dia']==$dia ? 1 : $dia_selecionado);
			}
			// TESTA SE O DIA SELECIONA ESTÁ DENTRO DOS DIAS JÁ GRAVADOS SE NÃO INSERE					
			if($dia_selecionado==0){
				echo "<td width=30'>".$dia."</td>";
			}
			echo "</tr>";
			
						
			$sql = " select 
						nome,matric,convert(varchar(10),dia,103) as dia,isnull(presenca,'1') as presenca
					from view_aluno_frequencia
			        where ano='".$_SESSION['ano']."' 
				    and seqano='".$_SESSION['seqano']."' 
				    and turma='".$_SESSION['turma']."'
				    and discip='".$_SESSION['disciplina']."' 
					and sit='M' and situacao='' order by nome,dia";
				   			
		$cur_sec_aluanofrequencia = mssql_query($sql);	
		
		/*echo "<tr><td width='20'>N.</td><td width='380'>Aluno</td><td width='64'>Matr&iacute;cula</td><td width=30'>".substr($_SESSION['data_frq'],0,2)."</td></tr>";*/
		
		$contador=0;
		$qtd_dia=0;
		$aluno_guia="x";
			
		while($row_sec_aluanofrequencia  = mssql_fetch_array($cur_sec_aluanofrequencia )){
			$contador++;
			$presenca_cheked=( $row_sec_aluanofrequencia['presenca']=='1' ? 'CHECKED' : '' );
			$presenca_lancada=( $row_sec_aluanofrequencia['presenca']=='1' ? 'P' : 'F');
					
			if($aluno_guia<>$row_sec_aluanofrequencia['matric']){
				if(($qtd_dia>0 and $qtd_dia<=$n_dias)){
					$qtd_dia=0;
					echo "<td width='30'><input type='hidden' value='0' name='".$row_sec_aluanofrequencia['matric']."'>
					<input class='presenca' CHECKED  name='".$row_sec_aluanofrequencia['matric']."'".
					" id=".$row_sec_aluanofrequencia['matric']." type='checkbox' value='1'/></td>";
				}
				
				$aluno_guia=$row_sec_aluanofrequencia['matric'];
				$qtd_dia++;
				echo "</tr>";

				echo "<tr><td>".$contador."</td>".
					 "<td width='380'>".utf8_encode($row_sec_aluanofrequencia['nome'])."</td>".
					 "<td width='64'>".$row_sec_aluanofrequencia['matric']."</td>";
				
				if($row_sec_aluanofrequencia['dia']==$_SESSION['data_frq'] or $n_dias==0){
					echo "<td width='30'><input type='hidden' value='0' name='".$row_sec_aluanofrequencia['matric']."'>
					<input class='presenca' ".$presenca_cheked."  name='".$row_sec_aluanofrequencia['matric']."'".
					" id=".$row_sec_aluanofrequencia['matric']." type='checkbox' value='1'/></td>";
						   
				}else{
					echo "<td width='30'>".$presenca_lancada."</td>";
				}	
				
			}elseif($row_sec_aluanofrequencia['dia']==$_SESSION['data_frq']){
					echo "<td width='30'><input type='hidden' value='0' name='".$row_sec_aluanofrequencia['matric']."'>
					<input class='presenca' ".$presenca_cheked."  name='".$row_sec_aluanofrequencia['matric']."'".
					" id=".$row_sec_aluanofrequencia['matric']." type='checkbox' value='1'/></td>";
			}else{
				echo "<td width='30'>".$presenca_lancada."</td>";
				$qtd_dia++;
			}		
			//echo "<td width='30'>".$qtd_dia."</td>";					
			
		}
		if(($qtd_dia>0 and $qtd_dia<=$n_dias)){
					$qtd_dia=0;
					echo "<td width='30'><input type='hidden' value='0' name='".$aluno_guia['matric']."'>
					<input class='presenca' CHECKED  name='".$aluno_guia['matric']."'".
					" id=".$aluno_guia." type='checkbox' value='1'/></td>";
				}
		echo "</table></form>";
		
		/*echo "<tr><td><input name='bt_salvar' id='bt_salvar' type='button' value='Salvar' />
					<input type='button' id='bt_imprimir' value='Imprimir' /></td></tr>";*/
					
		echo "<input name='bt_salvar' id='bt_salvar' type='button' value='Salvar' />
			<input type='button' id='bt_imprimir' value='Imprimir' />";
			
		?>
		
        
	</div>                      
         
  </div> 
    
  <div id="clear"></div>
</div> 

</body>
</html>


