<?php
function sendMail($de,$para,$mensagem,$assunto)
{
    require_once('phpmailer/class.phpmailer.php');
    $mail = new PHPMailer(true);

    $mail->IsSMTP(); 
    try {
     $mail->SMTPAuth   = true;                 
      $mail->Host       = 'correio.podium.pro.br';     
      $mail->SMTPSecure = '';//"tls";                #remova se nao usar gmail
	  $mail->Port       = '25';//587;                  #remova se nao usar gmail
      $mail->Username   = 'sistema@podium.pro.br'; 
      $mail->Password   = 'isbd4312';
      $mail->AddAddress($para);
	  $mail->AddReplyTo($de);
      $mail->SetFrom($de);
      $mail->Subject = $assunto;
      $mail->MsgHTML($mensagem);
      $mail->Send();     
      $envio = true;
    } catch (phpmailerException $e) {
      $envio = false;
    } catch (Exception $e) {
      $envio = false;
    }
    return $envio;
}

function validaemail($email){
	//verifica se e-mail esta no formato correto de escrita
	if (!ereg('^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
		$mensagem='E-mail Inv&aacute;lido!';
		return $mensagem;
    }
    else{
		//Valida o dominio
		$dominio=explode('@',$email);
		if(!checkdnsrr($dominio[1],'A')){
			$mensagem='E-mail Inv&aacute;lido!';
			return $mensagem;
		}
		else{return true;} // Retorno true para indicar que o e-mail é valido
	}
}


?>
