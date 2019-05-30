<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php include("../login/restrito.php");
include("../login/config.php");  
 ?>
<title>Biblioteca</title>
<link href="../css/home.css" rel="stylesheet" type="text/css">
<style type="text/css">
#apDiv1 {
	position: inherit;
	left: 100px;
	top: 436px;
	width: 325px;
	height: 16px;
	z-index: 1;
}
</style></head>
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="../prg/jav/professor_conteudo.js"></script>
  
  <script type="text/javascript" src="http://cdn.editorasaraiva.com.br/bibliotecadigital/api/digital.library.min.js"></script>
    
    
</head>

<body>

<div id="top-container">
  <div id="top">
    <p> <?php echo utf8_encode($_SESSION['nome']); ?>
    &nbsp;&nbsp;<a href="/professor_online/sair.php">Sair</a></p>  </div>
</div>

<div id="container">

  <div id="content-left"> <!--inicio do content left-->
        
<div id="box1">
      <h3> Matrícula:<?php echo utf8_encode( $_SESSION['matric']); ?>	</h3>
    </div>


     <?php include"../include/menu.php";     
     
     $matric_prof=utf8_encode( $_SESSION['matric']);
	
	
	 ?>
    
    
     
  </div> 
    
    <div id="content-right">   

     <div id="box2">
       <h3>Biblioteca</h3>
     
     </div>               
     <div id="consulta_bibli">
       <p>Consulta Biblioteca</p>
       <p>
       <form action="" method="POST">
         <label for="area_bibli"></label>
         <input type="text" name="area_bibli" id="area_bibli" width="300">
          <input type="submit" name="bt_consulta" id="bt_consulta" value="Consultar">
       
       </form></p>
       <div id="apDiv1">
         <?php if(isset($_REQUEST['area_bibli'])){
		   
		   if(strlen(($_REQUEST['area_bibli']))<5){
		  echo"acima de 5 caracteres";		  
		  return;
		  }
	   $sql_biblioteca="select * from dbo.VIEW_CONSULTA_BIBLIOTECA where titulo like('%contradição%') and PALAVRA like('%contradição%') and SUBTIT like('%contradição%')";
	   $cur_biblioteca = @mssql_query($sql_biblioteca);
	   $row_biblioteca=@mssql_fetch_array($cur_biblioteca);
	   echo'<br>
						  <table  border="0"  align="center"   width="40%"  >
							<tr>
							  <th cla width="5%" scope="col">Ano</th>
							  <th width="5%"scope="col">Parcela</th>
							  <th width="5%" scope="col">Vencimento</th>
							  <th width="8%" scope="col">Valor</th>
							  <th width="5%" scope="col">Pagamento</th>
							  <th width="5%"scope="col">Desconto</th>
							  <th width="8%" scope="col">Valor pago</th>
							  <th width="5%"scope="col">Multa</th>
							  <th width="5%"scope="col">Juros</th> 
							  <th hidden="" width="5%"scope="col"></th></tr>';
	   }
	  
	   
	   ?>
       </div>
      
       <p>&nbsp;</p>

     </div>
  </div> 
    
  <div id="clear">
   
  </div>
</div> 


</body></html>
