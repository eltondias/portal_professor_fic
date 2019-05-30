// JavaScript Document

$(document).ready(function(){
	//var isletra = false;
	
	$("#bt_exibir").hide();
	
	
	//PERIODO COMBO
	$("#periodo").change(function(){

					var periodo = this.value;
				
					$.ajax({
							  url:"../prg/fun/professor_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {periodo:periodo},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							  	$("#turma").html(data);
								$("#disciplina").empty();
								$("#data_frq").empty();
								$("#n_aula").empty();								
								
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
							  url:"../prg/fun/professor_disciplina.php",
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
							  url:"../prg/fun/professor_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {disciplina:disciplina},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	//$("#n_aula").html(data);
								

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});
	

	//N_AULA COMBO
		$("#n_aula").change(function(){
					
					var n_aula = this.value;
				
					$.ajax({
							  url:"../prg/fun/professor_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {n_aula:n_aula},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	//$("#n_aula").html(data);
								$("#bt_exibir").show();
								

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});

	//N_AULA COMBO
		$("#data_frq").change(function(){
					
					var data_frq = this.value;
				
					$.ajax({
							  url:"../prg/fun/professor_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {data_frq:data_frq},
							  beforeSend:function(jqXHR, settings){
							 // show_modal("first_window");
							  //$("#mensagem").dialog("close");
							  },	
							  success: function(data, textStatus){	
							    //alert(data);
							  	$("#n_aula").html(data);
								

							  },
							  complete:function(){
								 //close_modal();  
								// $("#grid").dialog("destroy");
								 //setTimeout("location.reload()", 200);
							  }
						 });
		
	});
	

						  
	// BOTÃO SALVAR
	$("#bt_salvar").click(function(){
					var dados = $("#frq").serialize();						
					
					$("#salvando").css("display", "inline");
					
					$.ajax({
								url:"../prg/fun/professor_frequencia_gravar.php",
								type: 'POST',
								dataType: "html",
								data: dados,
								success: function(data, textStatus){	
									alert(data);
					  			},
								complete:function(){
									$("#salvando").css("display", "none");
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

