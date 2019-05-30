<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<HTML>
<HEAD>
<TITLE></TITLE>
<META http-equiv=Content-Type content=text/html charset=utf-8>
<meta name="Generator" content="Projeto BoletoPHP - www.boletophp.com.br - Licença GPL" />
<?php
include("../login/restrito.php");
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa                |
// |                                                                      |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>         |
// | Desenvolvimento Boleto Santander-Banespa : Fabio R. Lenharo                |
// +----------------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$idparcela=$_REQUEST["idparcela"];
$anoseqano=$_REQUEST["anoseqano"];

include("include/conexao.php");
$sql="SELECT * FROM VIEW_SANTANDER WHERE ID=".$idparcela;
$cur_fin_boleto = @mssql_query($sql);
$row_fin_boleto= @mssql_fetch_array($cur_fin_boleto);

$sql_empres="SELECT * FROM GER_EMPRES";
$cur_fin_boleto_empres = @mssql_query($sql_empres);
$row_fin_boleto_empres= @mssql_fetch_assoc($cur_fin_boleto_empres);

//$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 0;
//$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$data_venc =$row_fin_boleto['datven'];
$valor_cobrado = $row_fin_boleto['valor']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $row_fin_boleto['nosso_numero'];  // Nosso numero sem o DV - REGRA: Máximo de 7 caracteres!
$dadosboleto["numero_documento"] = $row_fin_boleto['nosso_numero'];	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] =utf8_encode($row_fin_boleto['respon']);
$dadosboleto["endereco1"] =utf8_encode( $row_fin_boleto['endrespon'].' N. '.$row_fin_boleto['numero_respon']);
$dadosboleto["endereco2"] =  'Bairro:'.utf8_encode($row_fin_boleto['bairro']).' Cidade:'.utf8_encode($row_fin_boleto['cid']).' UF: '.utf8_encode($row_fin_boleto['uf']).' CEP:'.utf8_encode($row_fin_boleto['cep']);

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = ''; //"Pagamento de Compra na Loja Nonononono";
$dadosboleto["demonstrativo2"] = $row_fin_boleto['matric'].' &ensp;&ndash;&ensp; '.$row_fin_boleto['nome'].'<br>Turma: '.utf8_encode($row_fin_boleto['turma']).'<br>'.utf8_encode($anoseqano); //"Mensalidade referente a nonon nonooon nononon<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = ''; //"BoletoPhp - http://www.boletophp.com.br";
$dadosboleto["instrucoes1"] = " Sr. Caixa, não receber após o vencimento"; 
$dadosboleto["instrucoes2"] = '';    //"- Receber até 10 dias após o vencimento";
$dadosboleto["instrucoes3"] = $row_fin_boleto['matric'].' &ensp;&ndash;&ensp; '.$row_fin_boleto['nome'];    //"- Em caso de dúvidas entre em contato conosco: xxxx@xxxx.com.br";
$dadosboleto["instrucoes4"] = 'Turma: '.utf8_encode($row_fin_boleto['turma']).'<br>'.utf8_encode($anoseqano);    //"&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "Parcela:".$row_fin_boleto['parcel'];
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = $row_fin_boleto['aceite'];		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - SANTANDER BANESPA
$dadosboleto["codigo_cliente"] = $row_fin_boleto['codigo_cliente']; // Código do Cliente (PSK) (Somente 7 digitos)
$dadosboleto["ponto_venda"] = "1333"; // Ponto de Venda = Agencia
$dadosboleto["carteira"] = $row_fin_boleto['carteira'];  // Cobrança Simples - SEM Registro
$dadosboleto["carteira_descricao"] = "COBRANÇA SIMPLES - CSR";  // Descrição da Carteira

// SEUS DADOS
$dadosboleto["identificacao"] =''; //     "BoletoPhp - Código Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = $row_fin_boleto_empres['cnpj'];
$dadosboleto["endereco"] =   '';   //"Coloque o endereço da sua empresa aqui";
$dadosboleto["cidade_uf"] = '';    //"Cidade / Estado";
$dadosboleto["cedente"] = utf8_encode($row_fin_boleto_empres['razsoc']);  //"Coloque a Razão Social da sua empresa aqui";

// NÃO ALTERAR!
include("include/funcoes_santander_banespa.php"); 
include("include/layout_santander_banespa.php");
?>
<style type="text/css">
#apDiv1 {
	position: absolute;
	left: 534px;
	top: 11px;
	width: 65px;
	height: 25px;
	z-index: 1;
}
#apDiv2 {
	position: absolute;
	left: 450px;
	top: 11px;
	width: 65px;
	height: 24px;
	z-index: 1;
}
#apDiv3 {	position: absolute;
	left: 490px;
	top: 11px;
	width: 65px;
	height: 25px;
	z-index: 1;
}
</style>
<div id="apDiv1">
  <input name="Imp" type="button" id="Imp" onClick="history.go(-1)" value="Voltar"/>
</div>
</HEAD>
<div id="apDiv2">
  <input name="Imp2" type="button" id="Imp2" onClick="
window.print()" value="Imprimir"/>
</div>

</HTML>
