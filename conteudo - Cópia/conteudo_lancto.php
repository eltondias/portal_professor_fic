<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	include("../login/restrito.php");
	include("../login/config.php");  
?>

<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script src="../prg/jav/professor_conteudo.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Frequência</title>
</head>
	<link href="../css/home.css" rel="stylesheet" type="text/css">
    <link href="../css/alertas.css" rel="stylesheet" type="text/css">
	<style type="text/css"></style>
</head>
<body>

<div id="salvando" style='display:none;'><br/><br/><br/><br/>	</div>
<div id="carrega" style='display:none;'>Aguarde...<p>Estamos salvando seu Lancamento.</p>
<img  src="../imagens/aguarde11.gif"></div>

<div id="top-container">
  <div id="top">
    <p> <?php echo utf8_encode($_SESSION['nome'])."-".utf8_encode( $_SESSION['matric']); ?>
    &nbsp;&nbsp;<a href="sair.php">Sair</a></p>  </div>
</div>

<div id="container">
    <div id="content-right2">   
	
    
	<div id="box3">
	    <a href='../index.php'><button>Voltar</button></a>
    		<h3>
			<?php 
				$ano=substr($_SESSION['periodo'],0,4);
				$mes=$_SESSION['mes'];

			echo "Frequencia : ".utf8_encode($_SESSION['periodo'])." - ".retorna_mes($mes)." - Turma: ".utf8_encode( $_SESSION['turma'])." - ".utf8_encode( $_SESSION['disciplina_des']);?></h3>
                        
        <form action="" method="post" name="conteudo_p"  id="conteudo_p"> 
        <table class='tabelas' id="tabela_conteudo">
		<?php 			
			/*HADER DO GRID DE PRESENÇA*/
			echo "<tr><td width='8'>N.</td><td width='50'>Data</td><td width='10'>Aula(s)</td><td width='450'>Conteúdo</td><td width='350'>OBS</td>";
						
			/*LISTANDO OS DIAS DO MÊS SELECIONADO*/
			$sql = " select convert(varchar(10),dia,103) as dia,
					aula,
					isnull(conteudo,'') as conteudo,
					isnull(obs,'') as obs 
					from sec_profdiscipdia
			        where ano='".$_SESSION['ano']."' 
				    and seqano='".$_SESSION['seqano']."' 
					and matric=".$_SESSION['matric']."
				    and turma='".$_SESSION['turma']."'
				    and discip='".$_SESSION['disciplina']."' 
					and month(dia)=".$mes."	
				    order by dia";
			$cur_dias_conteudo = mssql_query($sql);

			$contador=0;			
			
			while($row_dias_conteudo = mssql_fetch_array($cur_dias_conteudo)){
				$contador++;
				// utilizado para dar nomes nos objetos a data no formato yyyymmdd 
				$nome_obj=$row_dias_conteudo['dia'];
				$d=explode("/",$nome_obj);
				$nome_obj=$d[2].$d[1].$d[0];
								
				echo "<tr  height='90'>
					 <td>".$contador."</td>
					 <td>".$row_dias_conteudo['dia']."</td>
					 <td> ".$row_dias_conteudo['aula']."</td>
					 <td><textarea cols='60' rows='4' name='".$nome_obj."conteudo'>".$row_dias_conteudo['conteudo']."</textarea></td>
					 <td><textarea cols='35' rows='4' name='".$nome_obj."obs'.>".$row_dias_conteudo['obs']."</textarea></td>
					 </tr>";

			}
		
			
		echo "</table></form>";
							
		echo "<input name='bt_salvar' id='bt_salvar' type='button' value='Salvar' />
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


