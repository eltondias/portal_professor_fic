 <html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <?php
    include("../login/restrito.php");
    include("../login/config.php");
	$nota_total='S/L';
    ?>

    <head>
    <style>
.oculta {
	
   display:none;
   
  
    
}

.normal {
   display:block;
   top:15%;
   
}
</style>
<script language="javascript">

window.onload = function() {
   document.getElementById( "site" ).className = "normal";
   document.getElementById("carregando").className="oculta";
}

</script>
    
  
    
       	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
            <script src="//code.jquery.com/jquery-1.10.1.js"></script> 
            <script src="//code.jquery.com/jquery-1.6.4.js"></script> 
            <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
            <script src="../prg/jav/professor_disciplina.js"></script>
              <script src="../prg/jav/th_fixo.js"></script>
            <script src="../prg/jav/marcar_todos.js"></script>
            <script src="../js/fundo.js"></script>
            

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Notas</title>
    </head>
    <link href="../css/lacto_notas.css" rel="stylesheet" type="text/css">
        <link href="../css/alertas.css" rel="stylesheet" type="text/css">
            <link href="../css/mask.css" rel="stylesheet" type="text/css">
            
                <style type="text/css">
                    #salvando #carrega p {
                        color: #000000;
                    }
                </style>
                </head>
<body class="body">
                <div class="normal"  id="carregando" align="center">
               
                <!-- Carregando... -->
                <img src="../imagens/aguarde11.gif" width="250" height="250" >
                 
<!--... -->
</div>
                
                
                <div class="oculta" id="site">
                

                    <div id="salvando" style='display:none;'><br/><br/><br/><br/>	</div>
                    <div id="carrega" style='display:none;'>Aguarde...<p>Estamos salvando seu Lancamento.</p>
                        <img  src="../imagens/aguarde11.gif"></div>

                    <div id="top-container">
                        <div id="top">
                            <p> <?php echo utf8_encode($_SESSION['nome']) . "-" . utf8_encode($_SESSION['matric']); ?>
                                &nbsp;&nbsp;<a href="../sair.php">Sair</a></p>  </div>
                    </div>

<div id="container">
<div id="content-right2">   


                            <div id="box3">
                                <input type="button" name="cancelar"  onclick="document.location.href='notas.php'" value="voltar"> 
                                    <h3>
                                        <?php
                                        $sqlava = "select  ava,des from sec_avaprof
 		where ano='" . $_SESSION['ano'] . "' and seqano='" . $_SESSION['seqano'] . "' and ava='" . $_SESSION['avaliacao'] . "'";
                                        $cur_avaliacao_ava = mssql_query($sqlava);
                                        $row_item_ava = mssql_fetch_array($cur_avaliacao_ava);

                                        /* $data_frq=substr($_SESSION['data_frq'],6,4)."-".substr($_SESSION['data_frq'],3,2)."-".substr($_SESSION['data_frq'],0,2);
                                          $ano=substr($_SESSION['data_frq'],6,4);
                                          $mes=substr($_SESSION['data_frq'],3,2);
                                          $_SESSION['mes']=$mes;

                                          $dia=substr($_SESSION['data_frq'],0,2); */

                                        echo "Lançamento de notas : " . utf8_encode($_SESSION['periodo']) . " -  Turma: " . utf8_encode($_SESSION['turma']) . " - " . utf8_encode($row_item_ava['des']) . "   -  " . utf8_encode($_SESSION['disciplina_des']);
                                        ?></h3>

                                    <?php
                                    $ano = substr($_SESSION['periodo'], -0, 4);
                                    $seqano = substr($_SESSION['periodo'], -1);
                                    ?>

                                    <form action="" method="post" name="frq"  id="frq">
                                        <table class='tabelas' id="tabela_aluno" width="100%" >
                                        
                                            
											<?php
                                            /* HADER DO GRID DE PRESENÇA */
											$sql_item = "select * from sec_item_avaliacao where turma='" . $_SESSION['turma'] . "' and discip='" .
											 utf8_encode($_SESSION['disciplina']) . "' and ano='" . $_SESSION['ano'] . "' and seqano='" .
											 $_SESSION['seqano'] . "' AND ava ='" . $_SESSION['avaliacao'] . " ' ";
											 
                                            $CUR_ITEM = mssql_query($sql_item);
                                            $row_item = mssql_fetch_array($CUR_ITEM);

                                            echo '<tr><div id="meuMenu"><td style="display: none">Matricula</td><td>Aluno</td><td style="display:none">Situação</td>';
                                            $iten = '';

                                            $cabechalho = '';

                                            for ($i = 1; $i <= 20; $i++) {

                                                $item_des = 'X' . str_pad($i, 2, "0", STR_PAD_LEFT) . '_DES';
                                                $id_max = 'nota_max' . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                $item_nota_max = 'X' . str_pad($i, 2, '0', STR_PAD_LEFT) . '_NOTA';

                                                if (!($row_item[$item_nota_max])<>'null') {                      
												                                $cabechalho.="<td>" . ($row_item[$item_des]) . ""
                                                            . "</br><div class='cabecalho_top'> <label>  N. Max  </label></br>
															<input style='display:none' width='50' readonly class='cabecalho'   "
															. "id='$id_max' value='" . str_pad($row_item[$item_nota_max], 3, ".0", STR_PAD_RIGHT) . "'                                              					></input>". "   
															<label>".str_pad($row_item[$item_nota_max], 3, ".0", STR_PAD_RIGHT) ."</label>
															</td>";
                                                }
                                            }




											
												echo $cabechalho .= "<td>TOTAL</th></div></div></tr>";
												
												$sql_item = "select * from view_lacto_notas_web where turma='" . $_SESSION['turma'] . "' and discip='" .
											 utf8_encode($_SESSION['disciplina']) . "' and ano='" . $_SESSION['ano'] . "' and seqano='" .
											 $_SESSION['seqano'] . "' AND ava ='" . $_SESSION['avaliacao'] . " '  and situacao=' ' and sit='M'  order by nome";
											 
                                            $CUR_ITEM = mssql_query($sql_item);                                   

											
											$numero=1;
                                            while ($row_item = mssql_fetch_array($CUR_ITEM)) {
													
                                                echo '<tr>';
                                                echo '<td style="display: none" >' . trim($row_item['MATRIC']) . '</td>';
                                                echo '<th>'.$numero++.' - ' . utf8_encode(trim($row_item['NOME'])) . '</th>';


                                                if (strlen($row_item['SITUACAO']) > 1) {
                                                    echo "<td style='display:none'>" . utf8_encode($row_item['SITUACAO']) . "  </td>";


                                                    
                                                } else {
                                                    echo "<td style='display:none'>" . utf8_encode($row_item['SITUACAO']) . "  </td>";



                                                    for ($i = 1; $i <= 20; $i++) {
                                                        $item_des = 'X' . str_pad($i, 2, "0", STR_PAD_LEFT) . '_DES';
                                                        $item_nota_aluno = 'X' . str_pad($i, 2, '0', STR_PAD_LEFT) . '_NOTA';
                                                        $coluna_nota = str_pad($i, 2, '0', STR_PAD_LEFT);

                                                        if (!($row_item[$item_nota_aluno])<>'null'){

                                                            $SQL_NOTA = "SELECT " . $item_nota_aluno . " FROM SEC_LANC_ITEM_AVALIACAO WHERE ANO='" . $_SESSION['ano'] .
                                                                    "' and SEQANO='" . $_SESSION['seqano'] .
                                                                    "' and MATRIC='" . $row_item['MATRIC'] .
                                                                    "' AND ava ='" .$_SESSION['avaliacao'] . 
																	"'and discip='".$_SESSION['disciplina']."'";

                                                            $CUR_NOTAS = mssql_query($SQL_NOTA);

                                                            $ROW_NOTAS = mssql_fetch_assoc($CUR_NOTAS);


                                                            if (is_numeric($ROW_NOTAS[$item_nota_aluno])) {

                                                                if (isset($nota_total)) {
                                                                    $nota_total+=$ROW_NOTAS[$item_nota_aluno];
                                                                } else {
                                                                    $nota_total = $ROW_NOTAS[$item_nota_aluno];
                                                                }



                                                                echo '<td><input width="20" value=' . $ROW_NOTAS[$item_nota_aluno] . '  class="notas" name="' . utf8_encode($row_item['MATRIC']) . '-' . $item_nota_aluno . '" id="' . utf8_encode($row_item['MATRIC']) . '_' . $coluna_nota . '" ></input></td>';
                                                            } else {
                                                                echo'<td><input width="20" value="" name=' . utf8_encode($row_item['MATRIC']) . '-' . $item_nota_aluno . ' class="notas"  id="' . utf8_encode($row_item['MATRIC']) . '_' . $coluna_nota . '" ></input></td>';
                                                            }
                                                        }
                                                    }

                                                   
                                                        echo"<td><input readonly class='notas' value='" . $nota_total . "'> </input></td>";
                                                  


                                                    
                                                   

                                                    
                                                  //echo'<form  method="post" action="quadro_lancamento.php"><td><input type="submit" value="Lançamentos"></input></td><td class="form3" ><input name="matricula_aluno" id="matricula_aluno"   value='.utf8_encode($row_item['MATRIC']).'></input></form>';
                                                    
                                                    echo "</tr>";
                                                    $nota_total = 'S/L';
                                                }










                                                //	$dia_selecionado=0;
                                                /* 			
                                                  /*VERIFICANDO SE EXISTEM OUTROS DIAS JÁ LANÇADOS */
                                                /* $sql = " select 
                                                  dia as data,substring(convert(varchar(10),dia,103),1,2) as diafrq
                                                  from view_aluno_frequencia
                                                  where ano='".$_SESSION['ano']."'
                                                  and seqano='".$_SESSION['seqano']."'
                                                  and turma='".$_SESSION['turma']."'
                                                  and discip='".$_SESSION['disciplina']."'
                                                  and professor=".$_SESSION['matric']."
                                                  and sit='M' and situacao=''
                                                  and month(dia)=".$mes."
                                                  group by dia
                                                  order by dia";
                                                  $cur_dias_lancados = mssql_query($sql);

                                                  while($row_dias_lancados = mssql_fetch_array($cur_dias_lancados)){
                                                  echo "<td width='15'>".$row_dias_lancados['diafrq']."</td>";
                                                  $dia_selecionado=( $row_dias_lancados['diafrq']==$dia ? 1 : $dia_selecionado);
                                                  }
                                                  // TESTA SE O DIA SELECIONA ESTÁ DENTRO DOS DIAS JÁ GRAVADOS SE NÃO INSERE
                                                  if($dia_selecionado==0){
                                                  echo "<td width=30'>".$dia."</td>";
                                                  }
                                                  echo "</tr>";
                                                 */
                                                //$left_join='';
                                                /* $select_dia='';
                                                  $select_presenca='';
                                                  $select_aula='';

                                                  for($i=1;$i<32;$i++){
                                                  $left_join.=" left join sec_aluanofrequencia as D".$i."
                                                  on D".$i.".escola=view_aluno_turma.escola
                                                  and D".$i.".ano=view_aluno_turma.ano
                                                  and D".$i.".seqano=view_aluno_turma.seqano
                                                  and D".$i.".professor=".$_SESSION['matric']."
                                                  and D".$i.".turma=view_aluno_turma.turma
                                                  and D".$i.".discip=view_aluno_turma.discip
                                                  and D".$i.".matric=view_aluno_turma.matric
                                                  and DAY(D".$i.".DIA)=".$i."
                                                  and month(D".$i.".DIA)=".$mes."
                                                  and year(D".$i.".DIA)=".$ano;

                                                  $select_dia.="case when D".$i.".dia is not null then CONVERT(VARCHAR(10),D".$i.".dia,103) else null end as DIA".$i.",";
                                                  $select_presenca.="case when D".$i.".dia is not null then D".$i.".presenca else 1 end as PRESENCA".$i.",";
                                                  $select_aula.="case when D".$i.".aula is not null then D".$i.".aula else null end as aula".$i.($i<31 ? "," : "");
                                                  } */

//                                            $sql = " select 
//						view_aluno_turma.escola,
//						view_aluno_turma.ano,
//						view_aluno_turma.seqano,
//						view_aluno_turma.turma,
//						view_aluno_turma.nome,
//						view_aluno_turma.matric,
//						view_aluno_turma.sit,
//						view_aluno_turma.situacao,
//						view_aluno_turma.discip					
//					from view_aluno_turma 
//			         where view_aluno_turma.ano='" . $_SESSION['ano'] . "' 
//				    and view_aluno_turma.seqano='" . $_SESSION['seqano'] . "' 
//				    and view_aluno_turma.turma='" . $_SESSION['turma'] . "'
//				    and view_aluno_turma.discip='" . $_SESSION['disciplina'] . "' 
//					and view_aluno_turma.sit='M' 
//					and view_aluno_turma.situacao='' order by nome";
//
//                                            $cur_sec_aluanofrequencia = mssql_query($sql);
//
//                                            $contador = 0;
//
//                                            while ($row_sec_aluanofrequencia = mssql_fetch_array($cur_sec_aluanofrequencia)) {
//                                                $contador++;
//                                                echo "<tr><td>" . $contador . "</td>" .
//                                                "<td>" . utf8_encode($row_sec_aluanofrequencia['nome']) . "</td>" .
//                                                "<td>" . $row_sec_aluanofrequencia['matric'] . "</td>";

                                                /* for($ndias=1; $ndias < 32 ;$ndias++){
                                                  $presenca='PRESENCA'.$ndias;
                                                  $diax='DIA'.$ndias;
                                                  $aluax='aula'.$ndias;

                                                  $presenca_cheked=($row_sec_aluanofrequencia[$presenca]==1 || $row_sec_aluanofrequencia[$presenca]==null ? 'CHECKED' : '' );
                                                  $presenca_lancada=($row_sec_aluanofrequencia[$presenca]==1 ? str_repeat("P", $row_sec_aluanofrequencia[$aluax]) : str_repeat("F", $row_sec_aluanofrequencia[$aluax]));

                                                  if($row_sec_aluanofrequencia[$diax]==$_SESSION['data_frq'] OR $dia==$ndias){
                                                  echo "<td ><input type='hidden' value='0' name='".$row_sec_aluanofrequencia['matric']."'>
                                                  <input  class='presenca' ".$presenca_cheked."  name='".$row_sec_aluanofrequencia['matric']."'".
                                                  " id=".$row_sec_aluanofrequencia['matric']." type='checkbox' value='1'/></td>";

                                                  }else{
                                                  if($row_sec_aluanofrequencia[$diax]!=null){
                                                  echo "<td>".$presenca_lancada."</td>";
                                                  }
                                                  }
                                                  } */
//                                            }
                                            }
                                            echo "</table></form>";

                                            echo "<input class='but' name='bt_salvar' id='bt_salvar' type='button' value='Salvar' />
			   </a>";
			   ?>
			  
              <a class="but" href="notas_lancto_imp.php" target="_blank">Imprimir</a>
                                            
                                            </div>
                                            </div>
                                            <div id="clear"></div>
                                            </div>
</body>
                                            <?php

                                            function retorna_mes($MES) {
                                                switch ($MES) {
                                                    case 1 : $MES = 'Janeiro';
                                                        break;
                                                    case 2 : $MES = 'Fevereiro';
                                                        break;
                                                    case 3 : $MES = 'Março';
                                                        break;
                                                    case 4 : $MES = 'Abril';
                                                        break;
                                                    case 5 : $MES = 'Maio';
                                                        break;
                                                    case 6 : $MES = 'Junho';
                                                        break;
                                                    case 7 : $MES = 'Julho';
                                                        break;
                                                    case 8 : $MES = 'Agosto';
                                                        break;
                                                    case 9 : $MES = 'Setembro';
                                                        break;
                                                    case 10 : $MES = 'Outubro';
                                                        break;
                                                    case 11 : $MES = 'Novembro';
                                                        break;
                                                    case 12 : $MES = 'Dezembro';
                                                        break;
                                                }
                                                return $MES;
                                            }

//Ex.: echo retorna_mes($MES); 
//resultado  Janeiro 
                                            ?>
                                            
                                            </html>


