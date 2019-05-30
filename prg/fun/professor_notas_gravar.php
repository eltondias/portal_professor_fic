<?php
include("../../login/restrito.php");
include("../../login/config.php");

$item_avali = "xxx";
$matricula = 0;
$nota = NULL;

$retorno = "Salvo com Sucesso";

function begin() 
{ 
    @mssql_query("BEGIN TRAN"); 
} 

function commit() 
{ 
    @mssql_query("COMMIT"); 
} 

function rollback() 
{ 
    @mssql_query("ROLLBACK"); 
} 
while (list($key, $val) = each($_POST)) {


    $sql = " SELECT " .
            " sec_lanc_item_avaliacao.matric " .
            " FROM sec_lanc_item_avaliacao " .
            " where " .
            " sec_lanc_item_avaliacao.escola = '1'" .            
            " AND sec_lanc_item_avaliacao.ano='".$_SESSION['ano']."'".
            " AND sec_lanc_item_avaliacao.seqano='".$_SESSION['seqano']."'". 
            " AND sec_lanc_item_avaliacao.discip = '" . $_SESSION['disciplina'] . "' " .
            " AND sec_lanc_item_avaliacao.ava ='" . $_SESSION['avaliacao'] . "' ";

    if (substr($key, -4) == 'NOTA') {
        $item_avali = stristr($key, '-');
        $item_avali = stristr($item_avali, 'X');
    }


    if ($key != 'turma') {
        if ($key != 'discip') {
            if ($key != 'avali') {
                if ($key != 'item_avali') {
                    if ($key != 'matric') {
                        $nota = $val;

                        $matricula = strstr($key, '-', -7);

                        $sql.= " and sec_lanc_item_avaliacao.matric=" . $matricula;
                        
                       

                        $tuplas_notas = mssql_query($sql);
                        $teste_registro = mssql_fetch_assoc($tuplas_notas);

                        // testa se existe algum registro
                        // echo $sql;
                        if ($teste_registro['matric'] != null) {

                            //echo "existe registro";
                            // ATUALIZANDO
                            if (empty($nota)) {
                                $nota = 'null';
								//break;
                            	  }
                                  begin();
				    $sql_update = ' update sec_lanc_item_avaliacao ' .
                                    ' set ' . $item_avali . '=' . $nota .
                                    ' where ESCOLA =1 and ano="' . $_SESSION['ano'] . '" and seqano="' . $_SESSION['seqano'] . '"' .
                                    ' AND DISCIP ="' . $_SESSION['disciplina'] . '"' .
                                    ' AND ava ="' . $_SESSION['avaliacao'] . '"' .
                                    ' AND matric=' . $matricula;
                            //print $sql_update;
                            $tuplas_notas_update = mssql_query($sql_update); // or die(mssql_error());	
                            if(!$tuplas_notas_update){
								rollback();
								exit;
									}
							else{
								commit();
								}
							
                            //die("Ouve um erro. Você não pode retirar uma nota já lançada. Se realmente precisar retirar a nota, lance 0.00");
                        } else {
                            //echo "não existe registro";
                            if ($nota != null) {
								begin();
                                $sql_insert = " insert into " .
                                        " sec_lanc_item_avaliacao" .
                                        " (ESCOLA,ANO,SEQANO,DISCIP,AVA,MATRIC," . $item_avali . ")" .
                                        " values (1,'" . $_SESSION['ano'] . "','" . $_SESSION['seqano'] . "','" . $_SESSION['disciplina'] . "','" . $_SESSION['avaliacao'] . "'," . $matricula . "," . $nota . ")";
                                //print $sql_insert;
                                $tuplas_notas_insert = mssql_query($sql_insert);
								if(!$tuplas_notas_insert){
									rollback();
									}
								else{
									commit();
									}
                            }
                        } //continue;
                    }
                }
            }
        }
    }
}

echo $retorno;
?>
