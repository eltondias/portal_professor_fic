// JavaScript Document

$(document).ready(function(){
	//var isletra = false;
	var notamax = 0;
	$("#bt_exibir").hide();	
	$("#turma").hide();
	$("#disciplina").hide();
	$("#data_frq").hide();
	$("#n_aula").hide();
	
	
	
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
								$("#disciplina").hide();
								$("#data_frq").hide();
								$("#n_aula").hide();
								$("#data_frq").val("");				
								$("#bt_exibir").hide();
								$("#turma").show();				
								
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
								$("#n_aula").hide();
								$("#data_frq").val("");
								$("#data_frq").hide();
								$("#disciplina").show();
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
								
								$("#data_frq").show();
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
		$("#data_frq").change(function(){								
					$.ajax({
							  url:"../prg/fun/professor_disciplina.php",
							  dataType: "html",
							  type: 'POST',
							  data: {'x':'x'},
							  beforeSend:function(jqXHR, settings){
							  },	
							  success: function(data, textStatus){	
								
								$("#n_aula").show();
								$("#bt_exibir").hide();

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
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
					
					$('#salvando').css({'width':maskWidth,'height':maskHeight,});
					$('#salvando').fadeIn(1000);
					$('#salvando').fadeTo("slow",0.4);
					$("#carrega").css("display", "inline");
					
					
					$.ajax({
								url:"../prg/fun/professor_notas_gravar.php",
								type: 'POST',
								dataType: "html",
								data: dados,
								success: function(data, textStatus){	
									alert(data);
					  			},
								complete:function(){
									$("#salvando").css("display", "none");
									$("#carrega").css("display", "none");
                                    window.location.href='../Lancamento/notas_lancto.php';
									//close_modal();  
									// $("#grid").dialog("destroy");
									//setTimeout("location.reload()", 200);
								}
							});
	
	
	
	
									
	});
	
	
	
	
	
	
	//---------------------- botao salvar frequencia -----/////
		// BOTÃO SALVAR
	$("#bt_salvar_frequencia").click(function(){
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
                                    window.location.href='../Lancamento/frequencia_lancto.php';
									//close_modal();  
									// $("#grid").dialog("destroy");
									//setTimeout("location.reload()", 200);
								}
							});
	
	
	
	
									
	});
									$("#bt_conteudo").click(function(){
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
                                    window.location.href='../conteudo/conteudo_lancto.php';
									//close_modal();  
									// $("#grid").dialog("destroy");
									//setTimeout("location.reload()", 200);
								}
							});
	
	
	
	
									
	});

    
     //---------formatando os numeros ------\\ 
    
     $("input").blur(function(e){
         var coluna_nota=this.id;
         //alert(coluna_nota);
          
         coluna_nota='nota_max'+coluna_nota.substr(8,2);
       //alert (coluna_nota);
         
         notamax=Number(document.getElementById(coluna_nota).value);
         
        if(this.value > notamax){
                alert("Nota Inválida!");
                //$(this).select();
                this.value = "";
                
                //e.preventDefault(false);
                //$(this).focus();
                //e.preventDefault(false);
        }
});
     
     
                                                                                
                $("input").keypress(function(e) {


        var strMascara = "#.#";
    var intDigito = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;				
        tecla = String.fromCharCode(intDigito);	
                //alert(intDigito)
        if(!((tecla >= "0") && (tecla <= "9")))
                {			
                        if(intDigito != 9 && intDigito != 116 && intDigito != 8 && intDigito != 46 && intDigito != 39 && intDigito != 37){
                         e.preventDefault(false);									
                         return false;
                        }
                }else{

        if(this.value.replace('.', '') == 10){
                        strMascara ="##.#";
                        this.value = "10.";
                }
                var objER = /^(4[8-9]|5[0-7]|9[6-9]|10[0-5])$/;																					
                if(objER.test(intDigito) && intDigito != 8)															
                        {
                                var intTamanho   = this.value.length;
                                var strCaractere = strMascara.charAt(0);
                                var strMascara   = strMascara.substring(intTamanho)

                                if (strMascara.charAt(0) != strCaractere)
                                        this.value += strMascara.charAt(0);
                        }

                }

 });





});


