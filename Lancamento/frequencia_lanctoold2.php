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
    <link href="../css/alertas.css" rel="stylesheet" type="text/css">
	<style type="text/css"></style>
</head>
<body>

<div id="salvando" style='display:none;'>Gravando. Aguarde...</div>

<div id="top-container">
  <div id="top">
    <p> <?php echo utf8_encode($_SESSION['nome'])."-".utf8_encode( $_SESSION['matric']); ?>
    &nbsp;&nbsp;<a href="sair.php">Sair</a></p>  </div>
</div>

<div id="container">
    <div id="content-right2">   
	
    
	<div id="box3">
	    <a href='frequencia.php'><button>Voltar</button></a>
    		<h3>
			<?php 
				$data_frq=substr($_SESSION['data_frq'],6,4)."-".substr($_SESSION['data_frq'],3,2)."-".substr($_SESSION['data_frq'],0,2);
				$ano=substr($_SESSION['data_frq'],6,4);
				$mes=substr($_SESSION['data_frq'],3,2);
				$_SESSION['mes']=$mes;
				
				$dia=substr($_SESSION['data_frq'],0,2);

			echo "Frequencia : ".utf8_encode($_SESSION['periodo'])." - ".retorna_mes($mes)." - Turma: ".utf8_encode( $_SESSION['turma'])." - ".utf8_encode( $_SESSION['disciplina_des']);?></h3>
        <h3><?php echo "Data: ".$_SESSION['data_frq']." Aula(s): ".utf8_encode( $_SESSION['n_aula']); ?></h3>

        <form action="" method="post" name="frq"  id="frq">
        <table class='tabelas' id="tabela_aluno">
		<?php 			
			/*HADER DO GRID DE PRESENÇA*/
			echo "<tr><td width='3'>N.</td><td width='250'>Aluno</td><td width='45'>Matr&iacute;cula</td>";
			$dia_selecionado=0;
						
			/*VERIFICANDO SE EXISTEM OUTROS DIAS JÁ LANÇADOS*/
			$sql = " select 
						dia as data,substring(convert(varchar(10),dia,103),1,2) as dia
					from view_aluno_frequencia
			        where ano='".$_SESSION['ano']."' 
				    and seqano='".$_SESSION['seqano']."' 
				    and turma='".$_SESSION['turma']."'
				    and discip='".$_SESSION['disciplina']."' 
					and professor=".$_SESSION['matric']."
					and sit='M' and situacao='' 
					and month(dia)=".$mes."	
					group by dia
				    order by dia";
			$cur_dias_lancados = mssql_query($sql);

			while($row_dias_lancados = mssql_fetch_array($cur_dias_lancados)){
				echo "<td width='15'>".$row_dias_lancados['dia']."</td>";
				$dia_selecionado=( $row_dias_lancados['dia']==$dia ? 1 : $dia_selecionado);
			}
			// TESTA SE O DIA SELECIONA ESTÁ DENTRO DOS DIAS JÁ GRAVADOS SE NÃO INSERE					
			if($dia_selecionado==0){
				echo "<td width=30'>".$dia."</td>";
			}
			echo "</tr>";
			
			$left_join='';
			$select_dia='';
			$select_presenca='';
			$select_aula='';
			
			for($i=1;$i<32;$i++){
				$left_join.=" left join sec_aluanofrequencia as D".$i." 
						on D".$i.".escola=view_aluno_turma.escola 
						and D".$i.".ano=view_aluno_turma.ano
						and D".$i.".seqano=view_aluno_turma.seqano
						and D".$i.".professor=".$_SESSION['matric']."
						and D".$i.".turma=view_aluno_turma.turma
						and D".$i.".discip=view_aluno_turma.discip
						and D".$i.".matric=view_aluno_turma.matric
						and DAY(D".$i.".DIA)=".$i."
						and month(D".$i.".DIA)=".$mes."
						and year(D".$i.".DIA)=".$ano;
						
				$select_dia.="case when D".$i.".dia is not null then CONVERT(VARCHAR(10),D".$i.".dia,103) else null end as DIA".$i.",";		
				$select_presenca.="case when D".$i.".dia is not null then D".$i.".presenca else 1 end as PRESENCA".$i.",";
				$select_aula.="case when D".$i.".aula is not null then D".$i.".aula else null end as aula".$i.($i<31 ? "," : "");
				}
						
			$sql = " select 
						view_aluno_turma.escola,
						view_aluno_turma.ano,
						view_aluno_turma.seqano,
						view_aluno_turma.turma,
						view_aluno_turma.nome,
						view_aluno_turma.matric,
						view_aluno_turma.sit,
						view_aluno_turma.situacao,
						view_aluno_turma.discip,".$select_dia.$select_presenca.$select_aula.					
					" from view_aluno_turma ".$left_join.
			        " where view_aluno_turma.ano='".$_SESSION['ano']."' 
				    and view_aluno_turma.seqano='".$_SESSION['seqano']."' 
				    and view_aluno_turma.turma='".$_SESSION['turma']."'
				    and view_aluno_turma.discip='".$_SESSION['disciplina']."' 
					and view_aluno_turma.sit='M' 
					and view_aluno_turma.situacao='' order by nome";
				   			
		$cur_sec_aluanofrequencia = mssql_query($sql);	
			
		$contador=0;
			
		while($row_sec_aluanofrequencia  = mssql_fetch_array($cur_sec_aluanofrequencia )){
			$contador++;			
			echo "<tr><td>".$contador."</td>".
				 "<td>".utf8_encode($row_sec_aluanofrequencia['nome'])."</td>".
				 "<td>".$row_sec_aluanofrequencia['matric']."</td>";

			for($ndias=1; $ndias < 32 ;$ndias++){
				$presenca='PRESENCA'.$ndias;				
				$diax='DIA'.$ndias;
				$aluax='aula'.$ndias;

				$presenca_cheked=($row_sec_aluanofrequencia[$presenca]==1 || $row_sec_aluanofrequencia[$presenca]==null ? 'CHECKED' : '' );
				$presenca_lancada=($row_sec_aluanofrequencia[$presenca]==1 ? str_repeat("P", $row_sec_aluanofrequencia[$aluax]) : str_repeat("F", $row_sec_aluanofrequencia[$aluax]));			
					
				if($row_sec_aluanofrequencia[$diax]==$_SESSION['data_frq'] OR $dia==$ndias){
					echo "<td ><input type='hidden' value='0' name='".$row_sec_aluanofrequencia['matric']."'>
					<input class='presenca' ".$presenca_cheked."  name='".$row_sec_aluanofrequencia['matric']."'".
					" id=".$row_sec_aluanofrequencia['matric']." type='checkbox' value='1'/></td>";
					
				}else{
					if($row_sec_aluanofrequencia[$diax]!=null){
						echo "<td>".$presenca_lancada."</td>";
					}
				}		
			}
		}

		echo "</table></form>";
							
		echo "<input name='bt_salvar' id='bt_salvar' type='button' value='Salvar' />
			   <a href='../conteudo/conteudo_lancto.php'><input name='bt_conteúdo' id='bt_conteúdo' type='button' value='Lançar Conteúdo' /></a>
			  <input type='button' id='bt_imprimir' value='Imprimir' />";
			
		?>
		
        
	</div>                      
         
  </div> 
    
  <div id="clear"></div>
</div> 

</body>
<?php  

function retorna_mes($MES){ 
    switch ($MES) {  
        case 1 : $MES='Janeiro'; break; 
        case 2 : $MES='Fevereiro';    break; 
        case 3 : $MES='Março';    break; 
        case 4 : $MES='Abril';    break; 
        case 5 : $MES='Maio';    break; 
        case 6 : $MES='Junho';    break; 
        case 7 : $MES='Julho';    break; 
        case 8 : $MES='Agosto';    break; 
        case 9 : $MES='Setembro'; break; 
        case 10 : $MES='Outubro'; break; 
        case 11 : $MES='Novembro';    break; 
        case 12 : $MES='Dezembro'; break; 
    } 
    return $MES; 
} 

//Ex.: echo retorna_mes($MES); 
//resultado  Janeiro 

?>
</html>


