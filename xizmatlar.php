<?php 
include("data/db.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="data/styles1.css" type="text/css" />
<title>Xizmatlar</title>


</head>

<body>
<?php
$nn=$_GET['nn'];
$xiz_n=$_GET['xizmat_name'];
$bxiz_n=$_GET['bor_xizmat_name'];
$xtson=$_GET['xtson'];
$i=1;
while ($i<=$xtson)
{
	$a[$i]=$_GET["xiz_type$i"];
	$b[$i]=$_GET["narx$i"];
	$i=$i+1;
}
if(($xiz_n!=""))
{
	$xiz_n = repp($xiz_n);
mysql_query("INSERT INTO `xizmatlar` (`id`, `xizmat_name`) VALUES (NULL, '$xiz_n'); ");	
$dbx=mysql_query("select * from `xizmatlar` where `xizmat_name` like '$xiz_n'");
$mdbx=mysql_fetch_array($dbx);
$x_id=$mdbx['id'];	

$i=1;
while($i<=$xtson)
{
	$a[$i] = repp($a[$i]);
	$b[$i] = repp($b[$i]);
	mysql_query("INSERT INTO `xizmat_type` (`id`, `xiz_name_id`, `xizmat_type`, `narxi`) VALUES (NULL, '$x_id', '$a[$i]', '$b[$i]');");
	$i++;	
}
echo"Ma`lumotlar saqlandi<br><a href=xizmatlar.php>Qaytish</a>";
exit;
}
if($bxiz_n!="")
{
$dbb=mysql_query("select * from `xizmatlar` where `xizmat_name` like '$bxiz_n'");
$mdbb=mysql_fetch_array($dbb);
$bxid=$mdbb['id'];	
$i=1;
while($i<=$xtson)
{
	$a[$i] = repp($a[$i]);
	$b[$i] = repp($b[$i]);
	
	mysql_query("INSERT INTO `xizmat_type` (`id`, `xiz_name_id`, `xizmat_type`, `narxi`) VALUES (NULL,'$bxid', '$a[$i]', '$b[$i]');");
	$i++;	
}
echo"Ma`lumotlar saqlandi<br><a href=xizmatlar.php>Qaytish</a>";
exit;
}
///////////////////////////   Yozuvlarni o`chirish
$x=$_GET['x'];
if($x!="")
{
$dbd=mysql_query("select * from `xizmat_type` where `id` = '$x'");
$mdbd=mysql_fetch_array($dbd);
$xiz_id=$mdbd['xiz_name_id'];
mysql_query("delete from `xizmat_type` where `id` = '$x'");
$dbd2=mysql_query("select * from `xizmat_type` where `xiz_name_id` = '$xiz_id'");
while($mdbd2=mysql_fetch_array($dbd2))
{
	$tek=$mdbd2['xizmat_type'];
}
if($tek=="")
{
mysql_query("delete from `xizmatlar` where `id` = '$xiz_id'");	
	
}
echo"Ma`lumotlar o`chirildi! <br><a href=xizmatlar.php>Qaytish</a>";
exit;
	
}



////////////////////////////// O1chirish tugadi
?>

<form name="form1" method="get" action="xizmatlar.php">
<div class="title1" align="center"><strong>Xizmat nomi:</strong></div><br>
Agar yangi xizmat turini kiritish kerak bo`lsa: <input type="text" name="xizmat_name" placeholder="yangi xizmat nomi" id="textfield" size="50">
<br><br>

Agar mavjud xizmat turiga qo`shish kerak bo`lsa 
  <label>Xizmatlar turini tanlang:   
              <select name="bor_xizmat_name" id="select">
              <option value=""><strong>Xizmatlar turi</strong></option>
			<?php $dat=mysql_query("select * from `xizmatlar`");  
			while ($myr=mysql_fetch_array($dat))
			{
				echo"<option>";  echo($myr['xizmat_name']);echo"</option>";

			}  ?>
              </select></label> <br><br>
<hr>
<a href="xizmatlar.php?nn=<?php $nn=$nn+1; echo($nn); ?>">Xizmat ko'rsatish turilarini qo'shish <img src="+.png" alt="Yangi xizmatlar qo`sish" width="20" height="20"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="xizmatlar.php"> Bekor qilish <img src="x.png" alt="bekor qilish" width="15" height="15"> </a><br><br>

<?php 
$k=0;
while ($k<$nn)
{
$k=$k+1;
echo"$k - ";
echo"xizmat turi: ";
echo ("<input type=text name=xiz_type");
echo($k);
echo(" size=50>");
echo" &nbsp;&nbsp;Narxi: ";
echo ("<input type=text name=narx");
echo($k);
echo(" size=20>");
echo"<br>";
}

?>
<input type="hidden" name="xtson" value="<?php  echo $nn; ?>">
<br><input type="submit" value="-----Saqlash-----">
</form>

<br>
<table  width="50%" class="tab"  border="1" ><tr class="tugma"><td>Xizmat nomi</td><td>Xizmat turi</td><td>narxi</td><td width="50">&nbsp;</td></tr>
<?php 
$dd=mysql_query("select * from `xizmat_type` ORDER BY `id` DESC");
while ($mm=mysql_fetch_array($dd))
{
$xid=$mm['xiz_name_id'];
$dd1=mysql_query("SELECT *  FROM `xizmatlar` WHERE `id` = '$xid'");
$mm1=mysql_fetch_array($dd1);
echo"<tr><td>";
echo($mm1['xizmat_name']);
echo"</td><td>";
echo($mm['xizmat_type']);
echo"</td><td>";
echo($mm['narxi']."</td><td>");
echo("<a title=o`zgartirish href=xizedit.php?x=".$mm['id'].">");
echo"<img src=data/edit.png></a>&nbsp;&nbsp;&nbsp;&nbsp;";
echo("<a title=o`chirish href=xizmatlar.php?x=".$mm['id'].">");
echo"<img src=data/delete.png></a>";


echo"</td></tr>";
	
}

?>
</table>

</body>
</html>