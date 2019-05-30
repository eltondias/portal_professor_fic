<?php include("../../login/restrito.php");
include("../../login/config.php");  

new Sec_prof_discip;
 
class Sec_prof_discip{


	private $ano;
	private $seqano;
	private $turma;	
	private $disciplina;
	private $mes;
	private $dia_lancto;
		
	function __construct(){
			
			if(isset($_POST['periodo'])){            
			$this->ano = substr($_POST['periodo'],0,4);
			$this->seqano = substr($_POST['periodo'],5,1);
			
			$_SESSION['periodo'] = $_POST['periodo'];
			$_SESSION['ano'] =  $this->ano;
			$_SESSION['seqano'] =  $this->seqano;
			
			$this->turma_professor();
			}
			
			if(isset($_POST['turma'])){
			$this->disciplina = trim(addslashes(strip_tags(htmlspecialchars($_POST['turma']))));
			$_SESSION['turma'] = $this->disciplina;
			$this->disciplina_professor();
			}
			
			if(isset($_POST['disciplina'])){
							
				$_SESSION['disciplina']=$_POST['disciplina'];
				
				$sql=	" select tab_tabela.des from tab_tabela 
						   where tab_tabela.cod='".$_SESSION['disciplina']."' and tiptab='DIS'";
				$cur_disciplina = mssql_query($sql);
				$row_disciplina = mssql_fetch_array($cur_disciplina);
				$_SESSION['disciplina_des']=$row_disciplina['des'];
			
				$this->mes();			
			}

			if(isset($_POST['mes'])){			
				$_SESSION['mes']=$_POST['mes'];		
				$this->dia_lancto();
			}
			

			if(isset($_POST['dia_lancto'])){			
				$_SESSION['dia']=$_POST['dia_lancto'];		
			}
			
			if(isset($_POST['dia_certo'])){			
				$_SESSION['dia_certo']=$_POST['dia_certo'];		
			}			
						

			if(isset($_POST['bt_excluir'])){			
				$this->excluir();
			}

			if(isset($_POST['bt_alterar'])){			
				$this->alterar();
			}


	}
	
	final function turma_professor(){
			 
	 $sql="select distinct sec_profdiscip.turma from sec_profdiscip 
	 		inner join tab_tabela
	 		on sec_profdiscip.discip=tab_tabela.cod
	 		where tab_tabela.cod=sec_profdiscip.discip and matric=".$_SESSION['matric']." and  sec_profdiscip.ano='".$_SESSION['ano'].
			"' and sec_profdiscip.seqano='".$_SESSION['seqano']."' order by sec_profdiscip.turma";
	 
		$cur_turma_professor = mssql_query($sql) or die(mssql_error());
		//echo $sql;
				
		 
		$retorno = '<option disabled="disabled" selected="selected" >Selecione uma Turma</option>';
			while($row_turma_professor = mssql_fetch_array($cur_turma_professor)){
	
				$retorno .= "<option value='".$row_turma_professor['turma']."'>".trim(utf8_encode($row_turma_professor['turma']))."</option> ";
		
			}
			echo trim($retorno);
		}
		
	final function disciplina_professor(){
		
		$sql="select sec_profdiscip.discip,tab_tabela.des from sec_profdiscip 
	 			inner join tab_tabela
	 			on sec_profdiscip.discip=tab_tabela.cod
	 			where tab_tabela.cod=sec_profdiscip.discip and matric=".$_SESSION['matric']." and  ano='".$_SESSION['ano'].
				"' and seqano='".$_SESSION['seqano']."' and sec_profdiscip.turma='".$_SESSION['turma']."' order by tab_tabela.des";

		$cur_disciplina_professor = mssql_query($sql);
		
		//$retorno = "";
		$retorno = "<option disabled='disabled' selected='selected' value='' >Escolha uma Disciplina</option>";
		
		while($row_disciplina_professor = mssql_fetch_array($cur_disciplina_professor)){
			$retorno .= "<option value='".$row_disciplina_professor['discip']."'>".trim(utf8_encode($row_disciplina_professor['des']))."</option> ";
		}
		
		echo trim($retorno);
		
	}
	
	final function mes(){
		
		$sql=	" select distinct month(dia) as mes 
				   from SEC_PROFDISCIPDIA
				   where ano='".$_SESSION['ano']."' and seqano='".$_SESSION['seqano']."'
				   and turma='".$_SESSION['turma']."' and discip='".$_SESSION['disciplina']."'".
				   " and matric=".$_SESSION['matric'];
				   
		$cur_mes = mssql_query($sql);
		
		$retorno = '<option disabled="disabled" selected="selected" >Selecione o mês</option>';
		while($row_mes = mssql_fetch_array($cur_mes)){
			$retorno .= "<option value='".$row_mes['mes']."'>".trim(utf8_encode($this->retorna_mes($row_mes['mes'])))."</option> ";
		}
		
		echo trim($retorno);
		
	}

	final function dia_lancto(){
		
		$sql=	" select distinct day(dia) as dia 
				   from SEC_PROFDISCIPDIA
				   where ano='".$_SESSION['ano'].
				   "' and seqano='".$_SESSION['seqano']."'
				   and turma='".$_SESSION['turma'].
				   "' and discip='".$_SESSION['disciplina']."'".
				   " and matric=".$_SESSION['matric'].
				   " and month(dia)=".$_SESSION['mes'];
		$cur_dia = mssql_query($sql);
		
		$retorno = '<option disabled="disabled" selected="selected" >Selecione o dia</option>';
		while($row_dia = mssql_fetch_array($cur_dia )){
			$retorno .= "<option value='".str_pad($row_dia['dia'], 2, "0", STR_PAD_LEFT)."'>".
			str_pad($row_dia['dia'], 2, "0", STR_PAD_LEFT)."</option> ";
		}
		
		echo trim($retorno);
	}
	
	final function excluir(){
		
		$data_dia=$_SESSION['ano']."-".$_SESSION['mes']."-".$_SESSION['dia'];
		$data_dia=date('Y/m/d', strtotime($data_dia));
		
		$sql=	" insert into LOG_PROFDISCIPDIA ".
				 "(escola,ano,seqano,matric,turma,discip,dia,tarefa,tarefa_data)".
				 " values (1,'".$_SESSION['ano']."','".$_SESSION['seqano']."',".
				 $_SESSION['matric'].",'".$_SESSION['turma']."','".
				 $_SESSION['disciplina']."',".$data_dia.",'EXCLUSAO',GETDATE())";
		$cur_dia = mssql_query($sql);
				 
		
		$sql=	" delete
				   from SEC_PROFDISCIPDIA
				   where ano='".$_SESSION['ano'].
				   "' and seqano='".$_SESSION['seqano']."'
				   and turma='".$_SESSION['turma'].
				   "' and discip='".$_SESSION['disciplina']."'".
				   " and matric=".$_SESSION['matric'].
				   " and month(dia)=".$_SESSION['mes'].
				   " and day(dia)=".$_SESSION['dia'];				   
		$cur_dia = mssql_query($sql);
		

		$sql=	" delete
				   from SEC_aluanofrequencia
				   where ano='".$_SESSION['ano'].
				   "' and seqano='".$_SESSION['seqano']."'
				   and turma='".$_SESSION['turma'].
				   "' and discip='".$_SESSION['disciplina']."'".
				   " and professor=".$_SESSION['matric'].
				   " and month(dia)=".$_SESSION['mes'].
				   " and day(dia)=".$_SESSION['dia'];
				   
		$cur_dia = mssql_query($sql);		
		echo (!$cur_dia ? 'error':'Dia Excluido com Sucesso');
		

	}


	final function alterar(){
		
		$mes_certo=substr($_SESSION['dia_certo'],3,2);
		$dia_certo=substr($_SESSION['dia_certo'],0,2);

		
		// TESTABNDO SE A DATA CERTA JÁ EXISTE NO BANCO
		$sql=	" SELECT top 1 *
				   from SEC_PROFDISCIPDIA
				   where ano='".$_SESSION['ano'].
				   "' and seqano='".$_SESSION['seqano']."'
				   and turma='".$_SESSION['turma'].
				   "' and discip='".$_SESSION['disciplina']."'".
				   " and matric=".$_SESSION['matric'].
				   " and month(dia)=".$mes_certo.
				   " and day(dia)=".$dia_certo;				   
		
		//echo $sql_logar;
		$exe_logar = mssql_query($sql) or die (mssql_error());
		$num_logar = mssql_num_rows($exe_logar);
		
		if ($num_logar>'0' ){
			
			echo 'A data informada para alteração já existe no seu lançamento. Nenhuma data foi alterada.' ;
			
		}else {
				
			$data_dia=$_SESSION['ano']."-".$_SESSION['mes']."-".$_SESSION['dia'];
			$data_dia=date('Y/m/d', strtotime($data_dia));
								
			$dia_certo=substr($_SESSION['dia_certo'],6,4)."/".substr($_SESSION['dia_certo'],3,2)."/".substr($_SESSION['dia_certo'],0,2); 		
			$dia_certo=date('Y/m/d', strtotime($dia_certo));
			
			echo "ALTERADO DO DIA: ".$_SESSION['dia']."/".$_SESSION['mes']."/".$_SESSION['ano'];
			echo " -> PARA :".substr($_SESSION['dia_certo'],0,2)."/".substr($_SESSION['dia_certo'],3,2)."/".substr($_SESSION['dia_certo'],6,4);
			echo " . ";			
			
			$sql=	" insert into LOG_PROFDISCIPDIA ".
					 "(escola,ano,seqano,matric,turma,discip,dia,nova_data,tarefa,tarefa_data)".
					 " values (1,'".$_SESSION['ano']."','".$_SESSION['seqano']."',".
					 $_SESSION['matric'].",'".$_SESSION['turma']."','".
					 $_SESSION['disciplina']."',".$data_dia.",'".$dia_certo."','ALTERANDO',GETDATE())";
			$cur_dia = mssql_query($sql);
					 
			
			$sql=	" update 
					   SEC_PROFDISCIPDIA
					   set dia='".$dia_certo."'".
					   " where ano='".$_SESSION['ano'].
					   "' and seqano='".$_SESSION['seqano']."'
					   and turma='".$_SESSION['turma'].
					   "' and discip='".$_SESSION['disciplina']."'".
					   " and matric=".$_SESSION['matric'].
					   " and month(dia)=".$_SESSION['mes'].
					   " and day(dia)=".$_SESSION['dia'];				   
			$cur_dia = mssql_query($sql);
			
	
			$sql=	" update 
					   SEC_aluanofrequencia
					   set dia='".$dia_certo."'".
					   " where ano='".$_SESSION['ano'].
					   "' and seqano='".$_SESSION['seqano']."'
					   and turma='".$_SESSION['turma'].
					   "' and discip='".$_SESSION['disciplina']."'".
					   " and professor=".$_SESSION['matric'].
					   " and month(dia)=".$_SESSION['mes'].
					   " and day(dia)=".$_SESSION['dia'];
					   
			$cur_dia = mssql_query($sql);		
			echo (!$cur_dia ? 'error':'Dia Alterado com Sucesso');
		}
	}
	
	
	final function retorna_mes($MES){ 
		switch ($MES) {  
			case 1 : $MES='Janeiro'; break; 
			case 2 : $MES='Fevereiro';    break; 
			case 3 : $MES='Marco';    break; 
			case 4 : $MES='Abril';    break; 
			case 5 : $MES='Maio';    break; 
			case 6 : $MES='Junho';    break; 
			case 7 : $MES='Julho';    break; 
			case 8 : $MES='Agosto';    break; 
			case 9 : $MES='Setembro'; break; 
			case 10 : $MES='Outubro'; break; 
			case 11 : $MES='Novembro';    break; 
			case 12 : $MES='Dezembro'; break; 
		} 
		return $MES; 
		
	}
	
		
}







?>