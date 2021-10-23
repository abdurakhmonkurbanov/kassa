<?php 
include("data/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="data/styles1.css" type="text/css" />
<title>Doctors</title>

</head>


<body>

<?php 

$fio=$_GET['fio'];
$mutax=$_GET['mutax'];
$phone=$_GET['phone'];
$did=$_GET['x'];   /////////   doctorning id si
$xol=$_GET['y'];   /////////   Xolat o'chirishmi yoki taxrirlash
if (isset($fio)!="")
{
	$fio = repp($fio);
	if ($xol!="")
	{
		
mysql_query("UPDATE `doctors` SET `fio` = '$fio', `xiz_name` = '$mutax', `phone` = '$phone' WHERE `id` = $did LIMIT 1;");
echo("Ma`lumotlar o`zgartirildi!");
echo("<a href=doctor.php>Orqaga qaytish</a>");
exit;
	}
	else{
mysql_query("INSERT INTO `doctors` (`id`, `fio`, `xiz_name`, `phone`, `oxir_num`) VALUES (NULL, '$fio', '$mutax', '$phone', '0');");
echo("Ma`lumotlar saqlandi!");
echo("<a href=doctor.php>Orqaga qaytish</a>");
exit;
	}
}
else
{
	if($xol==2)    ///  O'chirish xolatida
	{  
$mm=mysql_query("DELETE FROM `doctors` WHERE `doctors`.`id` = $did LIMIT 1");
	echo("<b><u>Ma`lumotlar o`chirildi!</u></b>");
	}
	if ($xol==1) {  ///////////////////  O'zgartirish xolati tanlanganda
$chad=mysql_query("Select * from `doctors` where `doctors`.`id` = $did");
$nat=mysql_fetch_array($chad);
?>
<div align="center"><strong>Doktorlarni ro'yhatgan olish</strong></div>
<form action="doctor.php" method="get">
<input type="hidden" name="y" value="2" />
<input type="hidden" name="x" value="<?php  echo($did); ?>" />
Doktorning ismi familiyas: <input type="text" name="fio" size="60" value="<?php echo($nat['fio']); ?>" /><br />
Mutaxassisligi: 
<select name="mutax" id="jumpMenu">
<?php 
$dat=mysql_query("Select * from `xizmatlar`");
while ($my=mysql_fetch_array($dat))
{
echo("<option>");
echo($my['xizmat_name']);
echo("</option>");
}
?>

</select>
<br />
Xona raqami <input type="text" name="phone"  value="<?php echo($nat['phone']); ?>" /><br />
<input type="submit" value="Saqlash" />
</form>


<?php 
	exit;
	}    ///////////////////  O'zgartirish xolati tanlanganda
?>
<div align="center"><strong>Doktorlarni ro'yhatgan olish</strong></div>
<form action="doctor.php" method="get">
Doktorning ismi familiyas: <input type="text" name="fio" size="60" /><br />
Mutaxassisligi: 
<select name="mutax" id="jumpMenu">
<?php 


$dat=mysql_query("Select * from `xizmatlar`");
while ($my=mysql_fetch_array($dat))
{
echo("<option>");
echo($my['xizmat_name']);
echo("</option>");
}




?>

</select>
<br />
Xona raqami <input type="text" name="phone" /><br />
<input type="submit" value="Saqlash" />
</form>
<?php } ?><br />

<table  width="50%" class="tab"  border="1" ><tr class="tugma"><td>Doktorning familiyasi</td><td>mutaxasisligi</td><td>Xona raqami </td><td width="50">&nbsp;</td></tr>

<?php 
$dd=mysql_query("select * from `doctors`");
while ($mm=mysql_fetch_array($dd))
{
	echo"<tr><td>";
echo($mm['fio']);
echo"</td><td>";
echo($mm['xiz_name']);
echo"</td><td>";
echo($mm['phone']);
echo"</td><td>";
echo("<a title=o`zgartirish href=doctor.php?x=".$mm['id']."&y=1>");
echo"<img src=data/edit.png></a>&nbsp;&nbsp;&nbsp;&nbsp;";
echo("<a title=o`chirish href=doctor.php?x=".$mm['id']."&y=2>");
echo"<img src=data/delete.png></a>";

echo"</td></tr>";
}


?>
</table>
</body>
</html>