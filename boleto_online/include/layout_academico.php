

<title>layot_academico.php</title>
<form name="form1" method="post" action="">
  <table width="92%" border="1">
    <tr>
      <th width="11%" scope="col">Parcela/item</th>
      <th width="14%" scope="col">ano/semestre</th>
      <th width="10%" scope="col">vencimento</th>
      <th width="11%" scope="col">mensalidade</th>
      <th width="12%" scope="col">dat. pagamento</th>
      <th width="10%" scope="col">desconto</th>
      <th width="12%" scope="col">valor pago</th>
      <th width="8%" scope="col">multa</th>
      <th width="5%" scope="col">juros</th>
    </tr>
    <tr>
      <td scope="col">'.$parcel.'-'.$item.' </td>
      <td scope="col">'.$ano.'-'.$seqano.'</td>
      <td scope="col">'.$datven.'</td>
      <td scope="col">'.$valmen.'</td>
      <td scope="col">'.$datpagto.'</td>
      <td scope="col">&quot;'.$valdes.'&quot;</td>
      <td scope="col">&quot;'.$valorpago.'&quot;</td>
      <td scope="col">&quot;'.$multa.'&quot;</td>
      <td scope="col">&quot;'.$juros.'&quot;</td>
      <td width="7%" scope="col"><input type="submit" name="detalhar" id="detalhar" value="2º Via">
        </td>
    </tr>
  </table>
</form>
