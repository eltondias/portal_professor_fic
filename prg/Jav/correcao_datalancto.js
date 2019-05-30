// JavaScript Document

$(document).ready(function(){
	//var isletra = false;
	
	$("#turma").hide();
	$("#disciplina").hide();
	$("#data_frq").hide();
	$("#n_aula").hide();	
	$("#mes").hide();
	$("#dia_lancto").hide();
	$("#dia_certo").hide();
	$("#bt_excluir").hide();	
	$("#bt_alterar").hide();
	
	//PERIODO COMBO
	$("#periodo").change(function(){

					var periodo = this.value;
				
					$.ajax({
							  url:"../prg/fun/correcao_dialanto_tela.php",
							  dataType: "html",
							  type: 'POST',
							  data: {periodo:periodo},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							  	$("#turma").html(data);
								
								$("#data_frq").hide();
								$("#n_aula").hide();
								$("#mes").hide();
								$("#disciplina").hide();
								$("#bt_excluir").hide();
								$("#bt_alterar").hide();
								$("#dia_certo").hide();
								$("#turma").show();
								$("#dia_certo").empty();
								//alert(data);
							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});
	
	//TURMA COMBO
		$("#turma").change(function(){
					
					var turma = this.value;
				
					$.ajax({
							  url:"../prg/fun/correcao_dialanto_tela.php",
							  dataType: "html",
							  type: 'POST',
							  data: {turma:turma},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	$("#disciplina").html(data);
								$("#mes").empty();
								$("#dia").empty();
								$("#n_aula").empty();
								$("#bt_excluir").hide();
								$("#bt_alterar").hide();
								$("#disciplina").show();
								$("#dia_certo").hide();
								$("#dia_certo").empty();

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});
	
	
	//DISCIPLINA COMBO
		$("#disciplina").change(function(){
					
					var disciplina = this.value;
				
					$.ajax({
							  url:"../prg/fun/correcao_dialanto_tela.php",
							  dataType: "html",
							  type: 'POST',
							  data: {disciplina:disciplina},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	$("#mes").html(data);
								$("#data_frq").show();
								$("#mes").show();
								$("#bt_excluir").hide();
								$("#bt_alterar").hide();
								$("#dia_certo").hide();
								$("#dia_certo").empty();								

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});
	

	//MES COMBO
		$("#mes").change(function(){
					
					var mes = this.value;
				
					$.ajax({
							  url:"../prg/fun/correcao_dialanto_tela.php",
							  dataType: "html",
							  type: 'POST',
							  data: {mes:mes},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	$("#dia_lancto").html(data);		
								$("#dia_lancto").show();		
								$("#bt_excluir").hide();
								$("#bt_alterar").hide();	
								$("#dia_certo").empty();	
								$("#dia_certo").hide();
								
							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});
	
	//DIA LANÇADO
		$("#dia_lancto").change(function(){
					
					var dia_lancto = this.value;
				
					$.ajax({
							  url:"../prg/fun/correcao_dialanto_tela.php",
							  dataType: "html",
							  type: 'POST',
							  data: {dia_lancto:dia_lancto},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);								
								$("#dia_certo").show();
								$("#bt_excluir").show();
								$("#dia_certo").show();
								$("#bt_alterar").hide();
															

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});

	//DIA CERTO
		$("#dia_certo").change(function(){
					
					var dia_certo = this.value;
				
					$.ajax({
							  url:"../prg/fun/correcao_dialanto_tela.php",
							  dataType: "html",
							  type: 'POST',
							  data: {dia_certo:dia_certo},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);								
								$("#dia_certo").show();
								$("#bt_excluir").hide();
								$("#bt_alterar").show();						
																

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});

	// BOTÃO excluir
	$("#bt_excluir").click(function(){
					var bt_excluir = this.value;
														
					$.ajax({
								url:"../prg/fun/correcao_dialanto_tela.php",
								type: 'POST',
								dataType: "html",
								data: {bt_excluir:bt_excluir},
								success: function(data, textStatus){	
									alert(data);
									location.reload();
					  			},
								complete:function(){
									//$("#salvando").css("display", "none");
									//$("#carrega").css("display", "none");
																	}
							});
									
	});

	// BOTÃO alterar
	$("#bt_alterar").click(function(){
					var bt_alterar = this.value;
														
					$.ajax({
								url:"../prg/fun/correcao_dialanto_tela.php",
								type: 'POST',
								dataType: "html",
								data: {bt_alterar:bt_alterar},
								success: function(data, textStatus){	
									alert(data);
									location.reload();
					  			},
								complete:function(){
									//$("#salvando").css("display", "none");
									//$("#carrega").css("display", "none");
																	}
							});
									
	});
						  
	// BOTÃO SALVAR
	$("#bt_salvar").click(function(){
					var dados = $("#conteudo_p").serialize();
					
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
					
					$('#salvando').css({'width':maskWidth,'height':maskHeight,});
					$('#salvando').fadeIn(1000);
					$('#salvando').fadeTo("slow",0.4);
					$("#carrega").css("display", "inline");
					
					$.ajax({
								url:"../prg/fun/diario_tela_gravar.php",
								type: 'POST',
								dataType: "html",
								data: dados,
								success: function(data, textStatus){	
									//alert(data);
					  			},
								complete:function(){
									$("#salvando").css("display", "none");
									$("#carrega").css("display", "none");
																	}
							});
									
	});
								
	
	
	//
	
	
	//var dados =$("#ID_FORM").serlialize();
});

function verificaNumero(e) {
	                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
						alert("oi");
	                    return false;
	                }
	            }
function FormatarCampo(objCampo,event, strMascara)
        {	
					
			
            var intDigito = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;;
              //alert(intDigito);        
            if(objCampo.value.replace('.', '') == 10){
				strMascara ="##.#";
				objCampo.value = "10.";
            }
			//alert(objCampo.value);
			
			
            
            // Expressão regular para validação de caractere dígitado.
            // São aceitos apenas números entre "0-9", são feitos dois testes pois existem "dois teclados numéricos" e seus caracteres ASCII são diferentes.
            var objER = /^(4[8-9]|5[0-7]|9[6-9]|10[0-5])$/;

            if(objER.test(intDigito) && intDigito != 8	)
                {
                    var intTamanho   = objCampo.value.length;
                    var strCaractere = strMascara.charAt(0);
                    var strMascara   = strMascara.substring(intTamanho)

                    if (strMascara.charAt(0) != strCaractere)
						
                        objCampo.value += strMascara.charAt(0);
						
                   
                }
        }  

