// JavaScript Document

$(document).ready(function(){
	//var isletra = false;
	
	$("#bt_exibir").hide();	
	$("#turma").hide();
	$("#disciplina").hide();
	$("#avaliacao").hide();
	$("#atividade").hide();
	
	
	
	//PERIODO COMBO
	$("#periodo").change(function(){

					var periodo = this.value;
				
					$.ajax({
							  url:"../prg/fun/notas_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {periodo:periodo},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							  	$("#turma").html(data);
								$("#turma").show();
								$("#disciplina").hide();
								$("#avaliacao").hide();
								$("#atividade").hide();
								$("#bt_exibir").hide();
												
								
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
							  url:"../prg/fun/notas_disciplina.php",
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
								$("#disciplina").show();
								$("#avaliacao").hide();
								$("#atividade").hide();
								$("#bt_exibir").hide();

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
							  url:"../prg/fun/notas_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {disciplina:disciplina},
							  beforeSend:function(jqXHR, settings){
							  //show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	$("#avaliacao").html(data);								
								$("#avaliacao").show();								
								$("#atividade").hide();
								$("#bt_exibir").hide();

								

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});

	//DISCIPLINA COMBO
		$("#avaliacao").change(function(){					
					var avaliacao = this.value;
				
					$.ajax({
							  url:"../prg/fun/notas_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {avaliacao:avaliacao},
							  beforeSend:function(jqXHR, settings){
							  //show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	//$("#n_aula").html(data);
														
								$("#atividade").hide();
								$("#bt_exibir").show();

								

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});

	

	//atividade
		/*$("#atividade").change(function(){
					
					var atividade = this.value;
				
					$.ajax({
							  url:"../prg/fun/notas_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {atividade:atividade},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	//$("#n_aula").html(data);
								$("#atividade").html(data);
								$("#bt_exibir").show();
								

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});*/

	
	

						  
	// BOTÃO SALVAR
	$("#bt_salvar").click(function(){
					var dados = $("#frq").serialize();						
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
					
					$('#salvando').css({'width':maskWidth,'height':maskHeight,});
					$('#salvando').fadeIn(1000);
					$('#salvando').fadeTo("slow",0.4);
					$("#carrega").css("display", "inline");
					
					
					$.ajax({
								url:"../prg/fun/professor_frequencia_gravar.php",
								type: 'POST',
								dataType: "html",
								data: dados,
								success: function(data, textStatus){	
									//alert(data);
					  			},
								complete:function(){
									$("#salvando").css("display", "none");
									$("#carrega").css("display", "none");
									//close_modal();  
									// $("#grid").dialog("destroy");
									//setTimeout("location.reload()", 200);
								}
							});
									
	});
									
	
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

