<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php include("../login/restrito.php");
include("../login/config.php");  
 ?>
<title>Biblioteca</title>
<link href="../css/home.css" rel="stylesheet" type="text/css">
<style type="text/css"></style></head>
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
       <h3>Bibliotecas Digitais</h3>
       
             <ul>
                <li><a href="biblioteca-bid.php" target="_blank">Biblioteca Digital - BID</a></li>
                <li><a href="biblioteca-ebsco.php" target="_blank">Biblioteca Digital - EBSCO</a></li>

				<li style="cursor: pointer" onClick="readerAccess('FIBRA','USUARIO','BD_FIBRA_CONCURSOS')"><a target"_blank">Saraiva - Concursos</a></li>
                 <li style="cursor: pointer" onClick="readerAccess('FIBRA','USUARIO','BD_FIBRA_PROFISSIONAIS')"><a target"_blank">Saraiva - Direito (Profissionais)</a></li>
                 <li style="cursor: pointer" onClick="readerAccess('FIBRA', 'USUARIO','BD_FIBRA_UNIVERSITARIO')"><a target"_blank">Saraiva - Direito (Universitário)</a></li>
            </ul>

     
     </div>                  
       
  </div> 
    
  <div id="clear"></div>
</div> 


</body></html>