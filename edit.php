<?php   
include("data/db.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="data/styles1.css" type="text/css" />
<title>Editor</title>
</head>

<body>
<h2><div align="center" class="title">Tahrirlash paneli<br> <a href="index.php">Asosiy panelga o'tish</a></div></h2>
<?php 
$cid=$_GET['id'];
$cid1=$_GET['cid'];
$fio=$_GET['fio'];
$pass=$_GET['pass'];
$ty=$_GET['ty'];
$manzil=$_GET['manzil'];
$dname=$_GET['dname'];
$xson1=$_GET['xson'];
$kk=0;
$jj=0;
$rr="";
while ($kk<=$xson1)
{
	$arr[$kk]=$_GET['na'.$kk];
	$nnar[$kk]=$_GET['nar'.$kk];
	if ($arr[$kk]!=""){
	$rr=$rr.$arr[$kk]."; ";
	$jj=$jj+(int)$nnar[$kk];}
	
	$kk=$kk+1;	
}

if ($fio!="")  ////////////////// Agar ma'lumotlar saqlash uchun bo'lsa
{
	
	//////////////////  O'zgartirishlar
	///////////////////////////////////////////  Navbatni belgilash
	$myy=mysql_query("select * from `client` where `client`.`id` = $cid1 ");
	$myy1=mysql_fetch_array($myy);
	$dfio=$myy1['doctors'];
	if ($dfio!=$dname)		/////   Agar mijoz doctorini o'zgartirgan bo'lsa navbat berish	
	{
	$dat3=mysql_query("SELECT *  FROM `doctors` WHERE `fio` LIKE '$dname'");
	$myr3=mysql_fetch_array($dat3);;
	$nav=$myr3['oxir_num'];
	$did=$myr3['id'];
	$nav=$nav+1;
	mysql_query("UPDATE  `client` SET `fio` = '$fio',  `doctors` = '$dname', `xizmat_type` = '$rr', `t_pul` = '$jj', `navbat` = '$nav' WHERE `id` = $cid1 LIMIT 1;");  
	mysql_query("UPDATE  `doctors` SET `oxir_num` = '$nav' WHERE `id` = '$did' LIMIT 1;");
	}   
	else 
	{
	mysql_query("UPDATE  `client` SET `fio` = '$fio',  `doctors` = '$dname', `xizmat_type` = '$rr', `t_pul` = '$jj'  WHERE `id` = $cid1 LIMIT 1;");   
	}
echo "<span class=tab>O`zgartirishlar saqlandi!<br>";
echo("To`lanadigan pul:  <b>".$jj."</b>  so`m<br></span>");	
	echo "<table width=100% class=tab border=1><tr class=tugma><td>Mijozning familiyasi va ismi </td><td>Tanlangan xizmat </td><td> doktor</td><td> xizmat tipi</td><td>Tug'ilgan yili</td><td>Yashash manzili</td><td>To'lagan puli</td><td>Navbati</td></tr>";
	$da=date("Y-m-d");
$dao=mysql_query("SELECT * FROM `client` WHERE `data` = '$da'  ORDER BY `client`.`id`  DESC");
while ($mro=mysql_fetch_array($dao))
{
$cid=$mro['id'];
$fio1=$mro['fio'];
$txn=$mro['xiz_name'];
$doc11=$mro['doctors'];
$xt=$mro['xizmat_type'];
$ty1=$mro['t_y'];
$man=$mro['manzil'];
$tp1=$mro['t_pul'];
$navb1=$mro['navbat'];
echo"<tr><td><a href='edit.php?id=$cid'>$fio1</a></td><td><a href='edit.php?id=$cid'>$txn</a></td><td><a href='edit.php?id=$cid'>$doc11</a></td><td><a href='edit.php?id=$cid'>$xt</a></td><td><a href='edit.php?id=$cid'>$ty1</a></td><td><a href='edit.php?id=$cid'>$man</a></td><td><b>$tp1</b></td></td><td><a href='edit.php?id=$cid'>$navb1</a></td></tr>";	
}
}
else {      //////////////////   Agar ma'lumotlar mavjud bo'lsa 


if ($cid=="")
{
	 ?>
<table width="100%" class="tab" border="1"><tr class="tugma"><td>Mijozning familiyasi va ismi </td><td>Tanlangan xizmat </td><td> doktor</td><td> xizmat tipi</td><td>Tug'ilgan yili</td><td>Yashash manzili</td><td>To'lagan puli</td><td>Navbati</td></tr>
	 
	 
	 <?php
$da=date("Y-m-d");
$dao=mysql_query("SELECT * FROM `client` WHERE `data` = '$da'  ORDER BY `client`.`id`  DESC");
while ($mro=mysql_fetch_array($dao))
{
$cid=$mro['id'];
$fio1=$mro['fio'];
$txn=$mro['xiz_name'];
$doc11=$mro['doctors'];
$xt=$mro['xizmat_type'];
$ty1=$mro['t_y'];
$man=$mro['manzil'];
$tp1=$mro['t_pul'];
$navb1=$mro['navbat'];
echo"<tr><td><a href='edit.php?id=$cid'>$fio1</a></td><td><a href='edit.php?id=$cid'>$txn</a></td><td><a href='edit.php?id=$cid'>$doc11</a></td><td><a href='edit.php?id=$cid'>$xt</a></td><td><a href='edit.php?id=$cid'>$ty1</a></td><td><a href='edit.php?id=$cid'>$man</a></td><td><b>$tp1</b></td></td><td><a href='edit.php?id=$cid'>$navb1</a></td></tr>";	
}
}       //////     Clientning idsi bo'sh bo'lsa
else    ////       taxrirlash formasi
{
	$da=date("Y-m-d");
$dao=mysql_query("SELECT * FROM `client` WHERE `data` = '$da' and `id` = '$cid'  ORDER BY `client`.`id`  DESC");

$mr=mysql_fetch_array($dao);
$xizname=$mr['xiz_name'];
$num=$cid;
	
	?>
	<form>
	Familiya va ism: <input type="text" name="fio" value="<?php echo($mr['fio']); ?>"> <br>
	Passport seriyasi: <input type="text" name="pass" value="<?php echo($mr['passport']); ?>"> <br>
    Tug`ilgan yili: <input type="text" name="ty" value="<?php echo($mr['t_y']); ?>"> <br>
	Manzili: <input type="text" name="manzil" value="<?php echo($mr['manzil']); ?>"> <br> 
    Doktor: <u><b> <?php  echo($mr['doctors']); ?></b></u><br>    
    Xizmat turi: <u><b><?php  echo($mr['xiz_name']); ?></b></u><br>
    Tanlangan xizmatlar: <u><b><?php  echo($mr['xizmat_type']); ?></b></u><br>
<table align="left"  class="tab" border="1" width="50%">
  <tr><td align="center"><strong>Tanlangan doktor</strong></td><td align="center"><strong>Xizmat ko'rsatish turi</strong></td><td>narxi</td></tr>
  
  <tr><td valign="top">   
      <label>
      <?php  
	  $dat2=mysql_query("SELECT *  FROM `doctors` WHERE `xiz_name` LIKE '$xizname'");
	  
	  $d=1;
	  while ($myr2=mysql_fetch_array($dat2))
	  {
	  ?>
        <input type="radio" name="dname" value="<?php echo($myr2['fio']); ?>" id="doctors_0">

        <?php  echo($myr2['fio']); ?></label>
      <br>
      <?php   } 
	  $xnum=$myr2['id'];
	  ?>
   
  </td> <td valign="top">

  <?php      ///////////////////////////////   Qiyini tanlangan xizmat turlari
  
  $dd=mysql_query("select * from xizmatlar where `xizmat_name` like '$xizname'");
  $mydd=mysql_fetch_array($dd);
  $xid=$mydd['id'];
  $dat1=mysql_query("SELECT *  FROM `xizmat_type` WHERE `xiz_name_id` = '$xid'");
  $raq=mysql_num_rows($dat1);
  $i=1;
  $xson=0;
  while ($myr1=mysql_fetch_array($dat1))
  {  
  $s=($myr1['xizmat_type']);
  $narr=($myr1['narxi']);
   echo" <label><input type=checkbox name='na$i'  value='$s'  id=xizmattype_0>$s  </label><input name='nar$i' type=hidden value=$narr> <br>";
   $xson=$xson+1;
   $i=$i+1;
  }  ?>
  
</td><td>

  <?php 
  $dat1=mysql_query("SELECT *  FROM `xizmat_type` WHERE `xiz_name_id` = '$xid'");
  $i=1;
  
  while ($myr1=mysql_fetch_array($dat1))
  {  
  ?>
  
    <label class="aniq">
    <?php  echo($myr1['narxi']);   $i=$i+1; ?></label><br>
  
    <?php }  ?>
</td><tr></table>
<br>
<br>
<br>
<br>
<br>
<input name="xson" type="hidden" value="<?php  echo($xson); ?>">
<input name="cid" type="hidden" value="<?php  echo($cid); ?>">
 <input type="submit" value="Saqlash">  
	</form>
	<?php 
	
}
}

?>


</table>

</body>
</html>