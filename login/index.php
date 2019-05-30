<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="../imagens/icone.ico" type="image/x-icon"/>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/home.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="../mensage/jquery-ui.css" />
<style type="text/css">
#logincaixa {
	position:absolute;
	width:800px;
	height:auto;
	margin-top:5%;
	margin-left:33%;
	border-radius:10px;
	padding-bottom:30px;
	-moz-box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.05);
	-webkit-box-shadow: 0 1px 10px 0 rgba(0, 0, 0, 0.05);
	box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.05);
}
#form{
	
	width: 50%;
	height: 20%;
	border: #CCC 1px solid;
	margin-top: 3%;
	background: #FFF;
	border: 1px, #999;
}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
</head>
<?php



function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
	
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
	else{
     
        $bname = 'other'; 
        $ub = '0'; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

// now try it
$ua=getBrowser();
$yourbrowser= "O seu Navegador: " . $ua['name'] . " " . $ua['version']." E não posuimos suporte a ele.";
if(($ua['name']=='Internet Explorer' or $ua['name']=='other' ) and ($ua['version']==8.0 or $ua['version']=='0')){
	echo' <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
 
  
 
  <script>
  $(function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>
</head>
<body>

 
<div id="dialog-message" title="Erro Navegador">
  <p>
    </span>
    Detectamos que seu Navegador está desatualizado
  </p>
  <p>
    recomendados: atualize o navegador</b>.
  </p>
  <p ><h3>';
  /*echo'<a id="" id style="" href="http://www.google.com.br/chrome/browser/">Atualizar</a>';*/
  echo'<input name="" type="button" onClick="window.open('."http://www.google.com.br/chrome/browser/".')" value="Atualizar">';
  echo'<h3 id=""><button onclick="javascript:window.close()">Fechar</button></h3></p></div>';
  
 
echo"<p></p></body></html>";
}
?>


<body>
<div id="apDiv1"></div>
<br/>
<div id="logincaixa">
<div id="form">
  <form id="form1" name="form1" method="post" action="../captcha/validar.php">
    <p><img style="position: relative; left: 23%; right: 50%;" src="../imagens/logo.png" width="200" height="65" /></p>
    <table width="27%" height="230" border="0" align="center">
      <tr>
        <td colspan="2"><div align="center">
          <p class="aluno"><strong>Fa&ccedil;a seu login</strong> </p>
        </div></td>
      </tr>
      <tr>
        <td width="9%"><span class="Style6">
          <p class="aluno">Email:</p>
        </span></td>
        <td width="31%"><span class="Style6">
          <label>
            <input name="login" style="text-align:left" placeholder="Informe seu email" type="text" id="login" value="" />
          </label>
        </span></td>
      </tr>
      <tr>
        <td><span class="Style6">
          <p class="aluno">Senha:</p>
        </span></td>
        <td><span class="Style6">
          <label>
            <input name="senha" style="text-align:left" placeholder="informe sua senha" type="password" id="senha" value=""  />
          </label>
        </span></td>
      </tr>
      <tr></tr>
      <tr></tr>
      <tr>
              </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><img src="../captcha/captcha.php?l=170&a=50&tf=20&ql=3" width="150" height="40"></td><td width="60%"><a class="" href="../form/index.php"></a>
          <a href="index.php"><input name="troocar" type="button" id="trocar"  value="trocar" /></a>
        </a></td>
      </tr>
      <tr>
        <td><span class="Style6">
          <p class="aluno">&nbsp;</p></td>
        <td><input name="palavra" placeholder="informe as letras" style="text-align:left" type="text"  /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="Style6">
          <input type="submit" name="OK" id="OK2" value="ENTRAR" />
        </a></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="Style6"><a class="" href="../form/index.php">Esqueceu sua senha?</a></span></td>
      </tr>
    </table>
  </form></div>
  <div id="content-left"> <!--inicio do content left-->
        
    	<!--<div hidde id="box1">
      <h3> Matrícula:	</h3>
      </div>-->


          
               
              </div>
    
  </div> 
    <!--fim do content left-->


    <div id="content-right"> <!--inicio do content right-->     

<!--     <div id="box2">
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
     </div> -->                   
        
  </div> <!--fim do content right-->
    
  <div id="clear"></div>
</div> <!--fim do container-->


</body>
</html>