<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php 
	include("login/restrito.php");
?>
<link rel="shortcut icon" href="../ISBD/prg/adm/imagen/logoico.ico" type="image/x-icon"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
	<title>Menu Horizontal</title>
	<style type="text/css">

		body {
			padding:0px;
			margin:0px;
		}
 
		#menu ul {
			padding:0px;
			margin:0px;
			float: left;
			width: 100%;
			background-color:#EDEDED;
			list-style:none;
			font:80% Tahoma;
		}
 
		#menu ul li { display: inline; }
 
		#menu ul li a {
			background-color:#EDEDED;
			color:#30C;
			text-decoration: none;
			border-bottom:3px solid #EDEDED;
			padding: 10px 10px;
			float:left;
		}
 
		#menu ul li a:hover {
			background-color:#D6D6D6;
			color:#30C;
			border-bottom:1px solid #EA0000;
		}
		
		#logo{
			float:left;
			text-align:center;
			}	
			
		#aluno{
			position:absolute;
			height:62px;
			top:28px;
			left:250px;			
			text-shadow: black 0.1em 0.1em 0.2em;
			font-size:30px;
			font-family:Verdana, Geneva, sans-serif;
			

			
			}	
		#arealivre{
			clear:both;
			}
    </style>
</head>

<body>
<?php 
	if(isset($_POST['periodo'])){
		$ano=substr($_POST['periodo'],0,4);
		$seqano=substr($_POST['periodo'],5,1);
	
		$_SESSION['ano'] = $ano;
		$_SESSION['seqano'] = $seqano;
	}
?>
<div id="logo"><a href="http://fibrapara.edu.br"><img src="imagens/logo.png" width="200" height="65" /></a></div>
<div id="aluno">Área do Professor </div>
<br>
	<div id="menu">
		<ul>
	        
            <li><a href="index.php">Informações Pessoais</a></li>		
			<li><a href="boletim.php">Boletim</a></li>
			<li><a href="financeiro.php">Financeiro(Boleto)</a></li>
			<li><a href="horario.php">Horário</a></li>
            <li><a href="atividades.php">atividades Complementares</a></li>			
            <li><a href="periodo.php">Período</a></li>
            <li><a href="informativo.php">Informativos</a></li>		
            <li><a href="sair.php">Sair</a></li>	
   	        
		</ul>
	</div>
<div id="arealivre"></div>    
<div><?php echo "Professor(a):".$_SESSION['nome']." - Matrícula: ".$_SESSION['matric']. " - Período:".$_SESSION['ano'].'-'.$_SESSION['seqano']?> </div>


</body>
</html>