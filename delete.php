<?php 
include("data/db.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="data/styles1.css" type="text/css" />
<title>delete</title>
</head>

<body>
<?php 
$mid=$_GET['id'];
$fio=$_GET['fam'];

if (isset($mid)!="")
{
$mm=mysql_query("DELETE FROM  `client` WHERE `client`.`id` = $mid LIMIT 1");
}
?>
<h2><div align="center" class="title">Diqqat tanlangan ma`lumotlar o'chiriladi<br> <a href="index.php">Asosiy panelga o'tish</a></div></h2>
<fieldset><legend>Filterlash bo`limi</legend>
<form action="delete.php" method="get">

            
   
Familiya: <input type="text" name="fam">          
     
  <input class="tugma" type="submit" value="Qidirish"> <a href=delete.php> Filterni bekor qilish</a>
</form>
</fieldset>
<table width="100%" class="tab" border="1"><tr class="tugma"><td>Mijozning familiyasi va ismi </td><td align="center">Mijozning<br>
passport seriyasi</td><td>Tanlangan xizmat </td><td> doktor</td><td> xizmat tipi</td><td>Tug'ilgan yili</td><td>Yashash manzili</td><td><b>To'lagan puli</b></td><td width="30">Navbati</td></tr>

<?php 
if ($fio!="")
{
$da=date("Y-m-d"); 
$dao=mysql_query("SELECT *  FROM `client` WHERE `fio` LIKE '%$fio%' AND `data` = '$da'  ORDER BY `client`.`id`  DESC");
$i=1;
while ($mro=mysql_fetch_array($dao))
{
$id=$mro['id'];
$fio1=$mro['fio'];
$passp=$mro['passport'];
$txn=$mro['xiz_name'];
$doc11=$mro['doctors'];
$xt=$mro['xizmat_type'];
$ty1=$mro['t_y'];
$man=$mro['manzil'];
$tp1=$mro['t_pul'];
$navb1=$mro['navbat'];
echo"<tr><td><a href='delete.php?id=$id'>$fio1</a></td><td><a href='delete.php?id=$id'>$passp</a></td><td><a href='delete.php?id=$id'>$txn</a></td><td><a href='delete.php?id=$id'>$doc11</a></td><td><a href='delete.php?id=$id'>$xt</a></td><td><a href='delete.php?id=$id'>$ty1</a></td><td><a href='delete.php?id=$id'>$man</a></td><td><b><a href='delete.php?id=$id'>$tp1</a></b></td><td><a href='delete.php?id=$id'>$navb1</a></td></tr>";	

}

}
else 
{
$da=date("Y-m-d"); 
$dao=mysql_query("SELECT * FROM `client` WHERE `data` = '$da'  ORDER BY `client`.`id`  DESC");
$i=1;
while ($mro=mysql_fetch_array($dao))
{
$id=$mro['id'];
$fio1=$mro['fio'];
$passp=$mro['passport'];
$txn=$mro['xiz_name'];
$doc11=$mro['doctors'];
$xt=$mro['xizmat_type'];
$ty1=$mro['t_y'];
$man=$mro['manzil'];
$tp1=$mro['t_pul'];
$navb1=$mro['navbat'];
echo"<tr><td><a href='delete.php?id=$id'>$fio1</a></td><td><a href='delete.php?id=$id'>$passp</a></td><td><a href='delete.php?id=$id'>$txn</a></td><td><a href='delete.php?id=$id'>$doc11</a></td><td><a href='delete.php?id=$id'>$xt</a></td><td><a href='delete.php?id=$id'>$ty1</a></td><td><a href='delete.php?id=$id'>$man</a></td><td><b><a href='delete.php?id=$id'>$tp1</a></b></td><td><a href='delete.php?id=$id'>$navb1</a></td></tr>";	

}

}


?>
</table>

</body>
</html>