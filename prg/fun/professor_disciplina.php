<?php include("../../login/restrito.php");
include("../../login/config.php");  

new Sec_prof_discip;
 
class Sec_prof_discip{


	private $ano;
	private $seqano;
	private $turma;	
	private $disciplina;
		
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
	
			
			}

			if(isset($_POST['data_frq'])){			
				$_SESSION['data_frq']=$_POST['data_frq'];
				$retorno = '<option disabled="disabled" selected="selected" >Selecione o número de Aulas</option>';
				$retorno .= '<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>';		
				echo $retorno;	
			}
					
			if(isset($_POST['n_aula'])){			
			$_SESSION['n_aula']=$_POST['n_aula'];
						
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
	
	final function avali_item(){
		
		$sql_item = "SELECT * FROM sec_item_avaliacao 
		WHERE sec_item_avaliacao.ESCOLA = '".$_SESSION['COD_ESCOLA']."' 
		AND sec_item_avaliacao.TURMA = '".$_SESSION['turma_ava']."' 
		AND sec_item_avaliacao.DISCIP = '".$_SESSION['discip_ava']."' AND AVA ='".$this->avali."' ";
		
		//$campo_des = '';
		//$campo_nota = '';
		//echo $sql_item;
		$tuplas_item = mssql_query($sql_item);
		$registro = mssql_fetch_array($tuplas_item);
		$retorno='<option value="123" disabled="disabled" selected="selected">Selecione</option>';
		
		for($i = 1;$i < 21;$i++){
						
			$campo = (strlen($i)<2 && $i<10) ? "X".'0'.$i."_DES" : "X".$i."_DES";
			$nota  = (strlen($i)<2 && $i<10) ? "X".'0'.$i."_NOTA" : "X".$i."_NOTA";
			$valor_campo=trim($registro[$campo]);
			$valor_nota =trim($registro[$nota]);
			if (strlen($valor_campo) > 0)
			{
				$retorno .= "<option name='teste' id='".$valor_nota."' value='".$campo."'>".trim(utf8_encode($valor_campo))."</option> ";				
			}		
			
		}
		echo trim($retorno);
		
		
	}
	
	final function lancto_aluno(){

		$nota=substr($this->item_avali,0,4)."NOTA";
		
		$_SESSION['nota'] = $nota;
		
		/*$sql_set="SET SQL_BIG_SELECTS=1";
		$tuplas_set = mssql_query($sql_set);*/
			
		$sql_aluno = 
		" SELECT ".
			" sec_aluno.nome,sec_aluno.matric,".$nota.
		" FROM sec_aluno ".
			"left join sec_lanc_item_avaliacao
			on 
			sec_lanc_item_avaliacao.escola=sec_aluno.escola 
			and sec_lanc_item_avaliacao.matric=sec_aluno.matric
			AND sec_lanc_item_avaliacao.DISCIP = '".$_SESSION['discip_ava']."' 
			AND sec_lanc_item_avaliacao.ava ='".$_SESSION['ava_cod']."' ".
		"WHERE 
			sec_aluno.ESCOLA = '".$_SESSION['COD_ESCOLA']."' 
			AND sec_aluno.TURMA = '".$_SESSION['turma_ava']."'".
		" ORDER BY sec_aluno.NOME"; 
			
		$tuplas_aluno = mssql_query($sql_aluno);	
		
		$retorno="<tr><td width='380'>Aluno</td><td width='64'>Matr&iacute;cula</td><td width='64'>Nota</td></tr>";
		
		//$retorno="<tr><td width='65%'>Aluno</td><td width='10%'>Matr&iacute;cula</td><td width='10%'>Nota</td></tr>";
		
		//echo $sql_aluno;
		
		while($registro_aluno = mssql_fetch_array($tuplas_aluno)){
		$retorno.="<tr><td width='380'>".utf8_encode($registro_aluno['nome'])."</td>".
			"<td width='64'>".$registro_aluno['matric']."</td>".
			"<td width='64'><input class='notas' name=".$registro_aluno['matric']." id=".$registro_aluno['matric']." type='text' size='4' maxlength='4' value='".$registro_aluno[$nota]."' /></td></tr>";
/*
			$retorno.="<tr><td width='65%' style='font-size: 12px;'>".utf8_encode($registro_aluno['nome'])."</td>".
			"<td width='10%' style='font-size: 13px;'>".$registro_aluno['matric']."</td>".
			"<td width='10%'><input class='notas' name=".$registro_aluno['matric']." id=".$registro_aluno['matric']." type='text' size='4' maxlength='4' value='".$registro_aluno[$nota]."' /></td></tr>";
	*/		
		}
		$retorno.="<tr><td><input name='bt_salvar_ava' id='bt_salvar_ava' type='button' value='Salvar' />
					<input type='button' id='bt_imprimir_lancto' value='Imprimir' /></td></tr>";
			
		
		echo trim($retorno);
		
	}
	
}




?>