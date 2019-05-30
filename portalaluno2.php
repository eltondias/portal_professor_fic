
<!-- saved from url=(0051)http://fibrapara.edu.br/aluno-online/frequencia.php -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Home</title>
<link href="../template_fibra/Faculdade Integrada Brasil Amazônia - FIBRA_files/aluno-online-home.css" rel="stylesheet" type="text/css">
<style type="text/css"></style></head>

<body>
<div id="top-container">
  <div id="top">
    <p> <?php $_SESSION['nome'] ?>                                  &nbsp;&nbsp;<a href="http://fibrapara.edu.br/aluno-online/desconectar.php">Sair</a></p>  </div>

</div>

<div id="container">

    <div id="content-left"> <!--inicio do content left-->
        
    	<div id="box1">
      <h3> Matrícula: <?php $_SESSION['matric']?>	</h3>
      </div>


     <div id="box1"> 
                  <h3>Professor Online</h3>
            <ul>
            	<li><a href="http://fibrapara.edu.br/aluno-online/home.php">Home</a></li>	
                <li><a href="../template_fibra/lancamento/notas.php">Lançamento de Nota</a></li>
                <ul>
                  <li><a href="../template_fibra/lancamento/frequencia.php">Frequência</a><a href="../template_fibra/biblioteca/consulta.php">Biblioteca</a><a href="../template_fibra/Faculdade Integrada Brasil Amazônia - FIBRA_files/Faculdade Integrada Brasil Amazônia - FIBRA.htm">Relatório</a></li>
                </ul>	
            </ul>

            <h3>Bibliotecas Digitais</h3>
            <ul>
                <li><a href="http://fibrapara.edu.br/aluno-online/biblioteca-bid.php" target="_blank">Biblioteca Digital - BID</a></li>
                <li><a href="http://fibrapara.edu.br/aluno-online/biblioteca-ebsco.php" target="_blank">Biblioteca Digital - EBSCO</a></li>
            	<!--<li><a href="#">Biblioteca Digital - Saraiva</a></li>-->

                 <li style="cursor: pointer" onClick="readerAccess(&#39;FIBRA&#39;,&#39;1403107&#39;,&#39;BD_FIBRA_CONCURSOS&#39;)"><a target"_blank"="">Saraiva - Concursos</a></li>
                 <li style="cursor: pointer" onClick="readerAccess(&#39;FIBRA&#39;,&#39;1403107&#39;,&#39;BD_FIBRA_PROFISSIONAIS&#39;)"><a target"_blank"="">Saraiva - Direito (Profissionais)</a></li>
                 <li style="cursor: pointer" onClick="readerAccess(&#39;FIBRA&#39;, &#39;1403107&#39;,&#39;BD_FIBRA_UNIVERSITARIO&#39;)"><a target"_blank"="">Saraiva - Direito (Universitário)</a></li>

            </ul>

            <h3>Outros Serviços</h3>
            
            <ul>
                <li><a href="http://fibrapara.edu.br/docs/51-calendario-academico-2014-2.pdf" target="_blank">Calendário Acadêmico</a></li>
                <li><a href="http://fibrapara.edu.br/site/laboratorios-fibra" target="_blank">Laboratórios e Normas</a></li>
                <li><a href="http://fibrapara.edu.br/ouvidoria/" target="_blank">Fale Conosco (Ouvidoria)</a></li>
                <li><a href="http://fibrapara.edu.br/site/guia-academico" target="_blank">Guia Acadêmico</a></li>
            </ul>


      </div>       
               
              
    
    </div> <!--fim do content left-->


    <div id="content-right"> <!--inicio do content right-->     

     <div id="box2">
      <h3>Frequência</h3>
     <table border="0" cellspacing="0" cellpadding="0" class="tabelas">
        
	<tbody><tr>
		<td width="36%" align="center" colspan="7">Quadro de Faltas</td>
	</tr>
	<tr>
		<td width="5%" align="center">1M</td>
		<td width="5%" align="center">2M</td>
		<td width="5%" align="center">3M</td>
		<td width="5%" align="center">4M</td>
		<td width="5%" align="center">5M</td>
		<td width="5%" align="center">T.F</td>
		<td width="5%" align="center">% F</td>
	</tr>


	<tr>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    0</td>
		<td width="6%" align="center"></td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    0</td>
		<td width="6%" align="center"></td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    0</td>
		<td width="6%" align="center">  0%</td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    0</td>
		<td width="6%" align="center">  0%</td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  2</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    2</td>
		<td width="6%" align="center">  3%</td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    0</td>
		<td width="6%" align="center">  0%</td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  2</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    2</td>
		<td width="6%" align="center">  5%</td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    0</td>
		<td width="6%" align="center">  0%</td>
	</tr>
	
	<tr>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">  0</td>
		<td width="5%" align="center">    0</td>
		<td width="6%" align="center">  0%</td>
	</tr>
	      </tbody></table>
     </div>                    
        
  </div> <!--fim do content right-->
    
  <div id="clear"></div>
</div> <!--fim do container-->


</body></html>