
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php include("../login/restrito.php");
include("../login/config.php");  
 ?>
<title>Conteúdo Programático</title>
<link href="../css/home.css" rel="stylesheet" type="text/css">
<style type="text/css"></style></head>
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#data_frq" ).datepicker({
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
});
	
  });
  </script>
 
	<!-- <script src="../prg/bib/jquery.js"></script> !-->
    <script src="../prg/jav/professor_conteudo.js"></script>
    
    
</head>

<body>

<div id="top-container">
  <div id="top">
    <p> <?php echo utf8_encode($_SESSION['nome']); ?>
    &nbsp;&nbsp;<a href="../sair.php">Sair</a></p>  </div>
</div>

<div id="container">

  <div id="content-left"> <!--inicio do content left-->
        
<div id="box1">
      <h3> Matrícula:<?php echo utf8_encode( $_SESSION['matric']); ?>	</h3>
      </div>


     <?php include"../include/menu.php";     
     
     $matric_prof=utf8_encode( $_SESSION['matric']);
	 //echo $matric_prof;
     
	 $sql='select distinct sec_profdiscip.ano,sec_profdiscip.seqano from sec_profdiscip 
	 inner join tab_tabela
	 on sec_profdiscip.discip=tab_tabela.cod
	 where tab_tabela.cod=sec_profdiscip.discip and matric='.$matric_prof.' order by sec_profdiscip.ano desc,sec_profdiscip.seqano desc';

	 
	 
	 $cur_periodo_prof= @mssql_query($sql);	 
	 ?>
    </div> 
    
    <div id="content-right">   

     <div id="box2">
      <h3>Conteúdo Programático</h3>
      <form name="falta_escolhe" style="margin-top:10px;" method="post" action="conteudo_lancto.php">
      <table>
      	<tr><td>
        <label for="periodo">Periodo</label></td>
        <td><select name="periodo" id="periodo" style="width:auto;" >
          <option disabled="disabled"  selected="selected" >Selecione o Período</option>
          <?php
		  	while($row_periodo_prof= @mssql_fetch_array($cur_periodo_prof )) {
		   		echo'<option>'.utf8_encode($row_periodo_prof['ano']).'/'.utf8_encode($row_periodo_prof['seqano']);
		   }
		   ?>
		</select>
        </td></tr>
        <tr><td>  
        <label for="turma">Turma</label></td>
        <td>
        <select name="turma" id="turma" style="width:auto;" ></select>
        </td>
        </tr>
        <tr><td><label for="disciplina">Disciplina</label></td>
        <td><select name="disciplina" id="disciplina" style="width:auto;" ></select></td>
        </tr>
        <tr><td>
        Mês:</td><td> <select name="mes" id="mes" style="width:auto;" ></select></td>
        </tr> 
        </table>
		<br>
        <a href="conteudo_lancto.php"><input name="bt_exibir" id="bt_exibir" type="submit" value="Exibir" /></a>
        
        <!-- <a href="frequencia_lancto.php">Exibir</a> !-->
        
      </form>
      <br/>
      <h4><span> <?php 
	  include("../include/frequencia.php"); 
	  ?></span></h4>
     
     </div>                  
       
  </div> 
    
  <div id="clear"></div>
</div> 


</body></html>