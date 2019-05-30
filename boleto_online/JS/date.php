<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
echo 'teste data';
$date1=date('d/m/Y');
$date2=date('d-m-Y');

if(strtotime($date1) >= strtotime($date2)){
echo '<br>'.'certo';
}
else{
echo '<br>'.'errado';
}



?>
<body>
</body>
</html>