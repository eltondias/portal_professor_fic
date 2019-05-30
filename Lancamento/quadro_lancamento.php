<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lançamentos por aluno</title>
</head>
<script type="text/javascript">
function redirecionar(){
	
	window.location="../Lancamento/notas_lancto.php";
}
</script>




 <?php
    include("../login/restrito.php");
    include("../login/config.php");
    $matric=$_REQUEST['matricula_aluno'];
    echo $matric;
    ?>
    
                            <div id="box3">
                                <input type="button" value="Voltar" onClick="redirecionar();"></input>
                                    <h3>
                                    </h3>
                            </div>
                                
<body>


<table class='tabelas' id="tabela_aluno" >
                                            <?php
                                            /* HADER DO GRID DE PRESENÇA */
                                            $sql_item = "select * from view_lacto_notas_web where turma='" . $_SESSION['turma'] . "' and discip='" . utf8_encode($_SESSION['disciplina']) . "' and ano='" . $_SESSION['ano'] . "' and seqano='" . $_SESSION['seqano'] . "' AND ava ='" . $_SESSION['avaliacao'] . " ' order by nome";
                                            $CUR_ITEM = mssql_query($sql_item);
                                            $row_item = mssql_fetch_array($CUR_ITEM);

                                            echo "<tr><td width='200'>Disciplinas</td>";
                                            $iten = '';

                                            $cabechalho = '';

                                            for ($i = 1; $i <= 20; $i++) {

                                                $item_des = 'X' . str_pad($i, 2, "0", STR_PAD_LEFT) . '_DES';
                                                $id_max = 'nota_max' . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                $item_nota_max = 'X' . str_pad($i, 2, '0', STR_PAD_LEFT) . '_NOTA';

                                                if (!empty($row_item[$item_des])) {
                                                    $cabechalho.="<td width='25' >" . utf8_encode($row_item[$item_des]) . ""
                                                            . "</br><div class='cabecalho_top' <label>  N. Max  </label> <input class='cabecalho'   "
                                                            . "id='$id_max' value='" . str_pad($row_item[$item_nota_max], 3, ".0", STR_PAD_RIGHT) . "' </input>"
                                                            . "</div>   </td>";
                                                }
                                            }
                                            echo $cabechalho . "<td>TOTAL</td></tr>";
?>



 




</body>
</html>