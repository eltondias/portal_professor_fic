
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php include("login/restrito.php");

include("login/config.php");  
 ?>
<title>Home</title>
<link href="css/home.css" rel="stylesheet" type="text/css">
<style type="text/css"></style></head>

<body>
<?php 
	/*if(isset($_POST['periodo'])){
		$ano=substr($_POST['periodo'],0,4);
		$seqano=substr($_POST['periodo'],5,1);
	
		$_SESSION['ano'] = $ano;
		$_SESSION['seqano'] = $seqano;
	}*/
?>
<div id="top-container">
  <div id="top">
    <p> 
	<?php echo utf8_encode($_SESSION['nome']); ?>
    <a href="sair.php">Sair</a> </a></p>  </div>

</div>

<div id="container">

  <div id="content-left"> <!--inicio do content left-->
        
<div id="box1">
      <h3> Matrícula:<?php echo utf8_encode( $_SESSION['matric']); ?>	</h3>
      </div>


     <?php include"include/menu.php" ?>       
               
              
    
    </div> 
    


    <div id="content-right">   

     <div id="box2">
      <h3>Informativo</h3>
      <br/>
      <h4><span><?php include("informativo/informativo.php");  ?> </span></h4>
     
     </div>                  
       
  </div> 
    
  <div id="clear"></div>
</div> 


</body></html>