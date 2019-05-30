<style>
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
input{
	text-align:center;
	border-radius:3px}

.centered{
	text-align:center;
	background:#CCCCCC;
	border:1px solid;
	position:relative;
	display:none;
	
	top: 100px;
	
	margin-left:50%;
	left: -250px;  	//half the width
	
	width:500px;
	height: 200px;	
}
</style>
<?php
   session_start();
   
	
	if ($_POST["palavra"] == $_SESSION["palavra"]){
		//echo "<h1>Voce Acertou</h1>";	
		$_SESSION["login"]=$_POST["login"]  ;
   		$_SESSION["senha"]=$_POST["senha"] ;
		
		header("Location:../login/logar.php");
		
    return;
	}
	else{
		echo '<meta http-equiv="refresh" content="1; url=../login/index.php">';
        echo '<style>

</style>

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="../imagens/icone.ico" type="image/x-icon"/>
<title>Login</title>
<link href="../css/home.css" rel="stylesheet" type="text/css">
<style type="text/css"></style></head>

<body><br/>
<div id="logincaixa">
<div id="form">
  <form id="form1" name="form1" method="post" action="../captcha/validar.php">
    <p><img style="position: relative; left: 30%; right: 50%;" src="../imagens/logo.png" width="200" height="65"></p>
    <table width="61%" height="230" border="0" align="center">
      <tr>
        <td colspan="2"><div align="center">
          <p class="aluno"><strong>Fa&ccedil;a seu login</strong> </p>
        </div></td>
      </tr>
      <tr>
        <td width="17%"><span class="Style6">
          <p class="aluno">Email:</p>
        </span></td>
        <td width="83%"><span class="Style6">
          <label>
            <input name="login" type="text" id="login" />
          </label>
        </span></td>
      </tr>
      <tr>
        <td><span class="Style6">
          <p class="aluno">Senha:</p>
        </span></td>
        <td><span class="Style6">
          <label>
            <input name="senha" type="password" id="senha"  />
          </label>
        </span></td>
      </tr>
      <tr></tr>
      <tr></tr>
      <tr>
              </tr>
      <tr>
        <td>ERRO</td>
        <td align="center"><img src="../captcha/erro.jpg?l=50&a=50&tf=20&ql=6" width="50" height="40"></td><td><a class="" href="../form/index.php"></a>
          <a href="index.php"><input name="troocar" type="button" id="trocar"   value="trocar" />
        </a></td>
      </tr>
      <tr>
        <td><span class="Style6">
          <p class="aluno">&nbsp;</p></td>
        <td><input name="palavra" type="text"  /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="Style6"><a class="" href="../form/index.php">
          <input type="submit" name="OK" id="OK2" value="LOGIN" />
        </a></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="Style6"><a class="" href="../form/index.php">Esqueceu sua senha?</a></span></td>
      </tr>
    </table>
  </form></div>
          
               
              </div>
    
  </div> 
  
	



	
	
	
	      </tbody></table>
     </div> 
        
  </div> <!--fim do content right-->
    
  <div id="clear"></div>
</div> <!--fim do container-->


</body></html>'; 
 
   
    }
?>

