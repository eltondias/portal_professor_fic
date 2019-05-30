<?php 
	include("../../login/restrito.php");
	include("../../login/config.php");  

$matricula	=0;
$presenca	=0;
$retorno="Salvo com Sucesso";
$data_frq=substr($_SESSION['data_frq'],6,4).substr($_SESSION['data_frq'],3,2).substr($_SESSION['data_frq'],0,2);

	// TESTANDO SE EXISTEM REGISTROS DE CONTEÚDO DO DIA DO PROFESSOR
	
		$sql = $sql = "select * from sec_profdiscipdia
			       where ano='".$_SESSION['ano']."' 
				   and seqano='".$_SESSION['seqano']."' 
				   and turma='".$_SESSION['turma']."'
				   and discip='".$_SESSION['disciplina']."'
				   and matric=".$_SESSION['matric']."
				   and convert(varchar(10),dia,112)='".$data_frq."'";
	
	$cur_sec_profdiscipdia = mssql_query($sql)or die(mssql_error());
	$teste_registro = mssql_fetch_assoc($cur_sec_profdiscipdia);

						// testa se existe algum registro
						if($teste_registro['matric']!=null){
						
							//echo "existe registro";							
							// ATUALIZANDO
						
						$sql_update = 
									"UPDATE ".
										" sec_profdiscipdia ".
										" set aula=".$_SESSION['n_aula'].
									 "where ano='".$_SESSION['ano']."' 
									   and seqano='".$_SESSION['seqano']."' 
									   and turma='".$_SESSION['turma']."'
									   and discip='".$_SESSION['disciplina']."'
									   and matric=".$_SESSION['matric']."
									   and convert(varchar(10),dia,112)='".$data_frq."'";
							
							$cur_sec_profdiscipdia_update = mssql_query($sql_update) or 
							die("Ouve um erro.");
							
						}else{
							//echo "não existe registro";
								$sql_insert	= 
											" insert into ".
												" sec_profdiscipdia".
													" (escola,ano,seqano,matric,turma,discip,dia,aula) ".	
												" values (1,'".$_SESSION['ano']."','".$_SESSION['seqano']."',".$_SESSION['matric'].",
												'".$_SESSION['turma']."','".$_SESSION['disciplina']."','".$data_frq.
												"',".$_SESSION['n_aula'].")";				
												
								$cur_sec_profdiscipdia_insert = mssql_query($sql_insert) or die(mssql_error());					
						} 


while(list($key,$val) = each($_POST)){
	
	$matricula=substr($key,0,7);
	$aula_posicao=substr($key,7,1);
	$presenca=$val;
	
	

		// TESTANDO SE EXISTEM REGISTROS DE FREQUENCIA DO ALUNO	
		$sql = $sql = "select * from sec_aluanofrequencia
					   where ano='".$_SESSION['ano']."' 
					   and seqano='".$_SESSION['seqano']."' 
					   and turma='".$_SESSION['turma']."'
					   and professor=".$_SESSION['matric']."
					   and discip='".$_SESSION['disciplina']."'
					   and matric=".$matricula."
					   and convert(varchar(10),dia,112)='".$data_frq."'";
		
		$cur_sec_aluanofrequencia = mssql_query($sql)or die(mssql_error());
		$teste_registro = mssql_fetch_assoc($cur_sec_aluanofrequencia);
	
							// testa se existe algum registro
							if($teste_registro['matric']!=null){
							
								//echo "existe registro";
								
									// ATUALIZANDO
						
							
							$sql_update = 
										"UPDATE ".
											" sec_aluanofrequencia ".
											" set presenca=UPPER(STUFF(presenca,".$aula_posicao.",1,'".$presenca."'))
											,aula=".$_SESSION['n_aula'].
										 "where ano='".$_SESSION['ano']."' 
										   and seqano='".$_SESSION['seqano']."' 
										   and turma='".$_SESSION['turma']."'
										   and professor=".$_SESSION['matric']."
										   and discip='".$_SESSION['disciplina']."'
										   and matric=".$matricula."
										   and convert(varchar(10),dia,112)='".$data_frq."'";
								
								//$tuplas_notas_update = mssql_query($sql_update) or die(mssql_error());	
								
								$cur_sec_aluanofrequencia_update = mssql_query($sql_update) or 
								die("Ouve um erro.");
								
							}else{
								//echo "não existe registro";
									$sql_insert	= 
												" insert into ".
													" sec_aluanofrequencia".
														" (escola,ano,seqano,professor,matric,turma,discip,dia,aula,presenca) ".	
													" values (1,'".$_SESSION['ano']."','".$_SESSION['seqano']."',".$_SESSION['matric'].
													",".$matricula.",
													'".$_SESSION['turma']."','".$_SESSION['disciplina']."','".$data_frq.
													"',".$_SESSION['n_aula'].",".strtoupper($presenca).")";				
													
									$cur_sec_aluanofrequencia_insert = mssql_query($sql_insert) or die(mssql_error());					
									
							} 

		
}
echo $retorno;	
	
?>
