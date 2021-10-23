<?php 
include("data/db.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="data/styles1.css" type="text/css" />
<title>Ro'yxatga olish</title>
</head>

<body >
<table align="center" width="80%" border="1"><tr><td align="center">
<?php  
$fio=$_POST['fio'];
if ($fio=="") {  echo" Ma`lumotlar to`liq emas! &nbsp;&nbsp;&nbsp;<a href=index.php>Asosiy panelga o`tish</a>"; exit();}

$ty=$_POST['ty'];
$manzil=$_POST['manzil'];
$passp=$_POST['pass'];
$xizname=$_POST['xizname'];
$cash=$_POST['cash'];
/////////////////////////   saqlash jarayoni uchun
$dname=$_POST['dname'];
$raq2=$_POST['raq'];
if ($cash=="")
{
echo"To`lov shaklini tanlamadingiz!";	
 echo"  &nbsp;&nbsp;&nbsp;<a href=index.php>Asosiy panelga o`tish</a>"; exit();
}
$k=0;
$rr="";	$jj=0;
while ($raq2>=$k)
{
	$arr[$k]=$_POST['na'.$k];
	$nnar[$k]=$_POST['nar'.$k];

	if ($arr[$k]!=""){
	$rr=$rr.$arr[$k].", ";
	$jj=$jj+(int)$nnar[$k];}
	
	$k=$k+1;
}
$y=1;
	$xtype="";
while ($raq2>=$y)
{
$xtype=$xtype+$b[$y];
$y=$y+1;
}

if (isset($nnar[1])=="")
{
?>

<form method="POST" action="saqlash.php">
Mijozning ismi familiyasi: <b> <font  color="#0000FF"><?php echo($fio);?></font></b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
Tug'ilgan yili: <b><font  color="#0000FF"><?php echo($ty);?></font></b><br><br>
Yashash manzili: <b><font  color="#0000FF"><?php echo($manzil);?></font></b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
Xizmat turi <b><font  color="#0000FF"><?php echo($xizname);?></font></b> &nbsp; &nbsp; &nbsp; &nbsp; To`lov turi:<font  color="#0000FF"> <b>
<?php 
	if($cash=="n") 
		{ 
		echo "Naqd"; 
		} 
	else 
		{ 
		echo "Plastik karta orqali"; 
		}   
?> </b></font><br>
<p>

<?php  
$dat=mysql_query("SELECT *  FROM `xizmatlar` WHERE `xizmat_name` LIKE '$xizname'");
$myr=mysql_fetch_array($dat);
$num=$myr['id'];

?>
  <table align="left"  class="tab" border="1" width="100%">
  <tr><td align="center"><strong>Tanlangan doktor</strong></td><td align="center"><strong>Xizmat ko'rsatish turi</strong></td><td>narxi</td></tr>
  
  <tr><td valign="top">   
  
      <?php  
	  $dat2=mysql_query("SELECT *  FROM `doctors` WHERE `xiz_name` LIKE '$xizname'");
	  $d=1;
	  while ($myr2=mysql_fetch_array($dat2))
	  {
	  ?>    <label>
        <input type="radio" name="dname" value="<?php echo($myr2['fio']); ?>" id="doctors_0">
        <?php echo($myr2['fio']); ?></label>
      <br>
      <?php   } ?>
   
  </td> <td valign="top">

  <?php 
  $dat1=mysql_query("SELECT *  FROM `xizmat_type` WHERE `xiz_name_id` = '$num'");
  $raq=mysql_num_rows($dat1);
  $i=1;
  while ($myr1=mysql_fetch_array($dat1))
  {  
  $s=($myr1['xizmat_type']);
  $narr=($myr1['narxi']);
   echo" <label><input type=checkbox name='na$i'  value='$s'  id=xizmattype_0>$s  </label><input name='nar$i' type=hidden value=$narr> <br>";
   $i=$i+1;
  }  ?>
  
</td><td>

  <?php 
  $dat1=mysql_query("SELECT *  FROM `xizmat_type` WHERE `xiz_name_id` = '$num'");
  $i=1;
  
  while ($myr1=mysql_fetch_array($dat1))
  {  
  ?>
  
    <label class="">
    <?php  echo($myr1['narxi']);   $i=$i+1; ?></label><br>
  
    <?php }  ?>
</td><tr></table><br>
<!---   Jo'natishlar --->
<input type="hidden" name="fio" value="<?php echo($fio); ?>">
<input type="hidden" name="pass" value="<?php echo($passp); ?>">
<input type="hidden" name="ty" value="<?php echo($ty); ?>">
<input type="hidden" name="manzil" value="<?php echo($manzil); ?>">
<input type="hidden" name="xizname" value="<?php echo($xizname); ?>">
<input type="hidden" name="raq" value="<?php echo($raq); ?>">
<input type="hidden" name="cash" value="<?php echo($cash); ?>">
<br>
<br>
<br>
<br>

<input type="submit" value="Saqlash">
</form>
</td></tr></table>
<?php 
}
else   /////////////////////////////  Saqlash
{
	
	
//	

$da=date("Y-m-d");    //Joriy sana aniqlandi
$f=fopen("1.txt","r");
$buff=fread($f,10);  // fayl ichidagi ma'lumotlar o'qildi.
fclose($f);
if ($da != $buff) 
{
	$f=fopen("1.txt","w");
	fwrite($f,$da);   //////////// Agar sana o'zgargan bo'lsa sanoqni boshidan boshla
	fclose($f);
	$da3=mysql_query("SELECT *  FROM `doctors`");
    while ($my3=mysql_fetch_array($da3))
	{
	$did=$my3['id'];
	$updoc=mysql_query("UPDATE  `doctors` SET `oxir_num` = '0' WHERE `doctors`.`id` = '$did' LIMIT 1");
	}
}

$dat3=mysql_query("SELECT *  FROM `doctors` WHERE `fio` LIKE '$dname'");
$myr3=mysql_fetch_array($dat3);;
	$nav=$myr3['oxir_num'];
	$nav=$nav+1;
	$tim=date("h:i");               ////////////////////
if ($dname=="") {  echo" Kechirasiz siz doktorni tanlamadingiz! &nbsp;&nbsp;&nbsp;<a href=index.php>Asosiy panelga o`tish</a>"; exit();}	
	/////  Yozishni boshlash
	$fio = repp($fio);
	$manzil = repp($manzil);
 $res=mysql_query("INSERT INTO  `client` (`id`, `fio`, `passport`, `xiz_name`, `doctors`, `navbat`, `xizmat_type`, `t_y`, `manzil`, `t_pul`, `cash`, `data`, `time`) VALUES (NULL, '$fio', '$passp', '$xizname', '$dname', '$nav', '$rr', '$ty', '$manzil', '$jj', '$cash', '$da', '$tim');");
 
////  Bazaga yozish tugadi
		  $da3=mysql_query("SELECT *  FROM `doctors` WHERE `fio` LIKE '$dname'");
       	  $my3=mysql_fetch_array($da3);
		  $did=$my3['id'];
	 $updoc=mysql_query("UPDATE  `doctors` SET `oxir_num` = '$nav' WHERE `doctors`.`id` = '$did' LIMIT 1");
?>
<h3><div align="center" class="title1">Malumotlar saqlandi! &nbsp; &nbsp; &nbsp; &nbsp;   <a href="index.php"> < < < Asosiy panelga o'tish</a></div></h3>
  <table width="100%" bordercolor="#3366FF" align="center" class="tab" border="2"><tr class="title1"><td>Mijozning familiyasi va ismi </td><td align="center">Mijozning<br>
passport seriyasi</td><td>Tanlangan xizmat </td><td> Doktor</td><td> Xizmatlar</td><td><b>To'lagan puli</b></td><td width="30">Navbati</td></tr>

<?php   
$fio=$_GET['fio'];
$doc=$_GET['docname'];
$xiz=$_GET['xizname'];
$s="select * from `client` where `data` = '$day'";
$s=$s." ORDER BY `id` DESC";
$dbmain=mysql_query($s);
$tp=0;
 $na=0;
 $pl=0;
while($mdb=mysql_fetch_array($dbmain))
{
	echo"<tr><td><a href='client.php?id=".$mdb['id']."'>".$mdb['fio']."</a></td><td><a href='client.php?id=".$mdb['id']."'>".$mdb['passport']."</a></td><td><a href='client.php?id=".$mdb['id']."'>".$mdb['xiz_name']."</a></td><td><a href='client.php?id=".$mdb['id']."'>".$mdb['doctors']."</a></td><td><a href='client.php?id=".$mdb['id']."'>".$mdb['xizmat_type']."</a></td><td><a href='client.php?id=".$mdb['id']."'>".$mdb['t_pul']."</a></td><td><a href='client.php?id=".$mdb['id']."'>".$mdb['navbat']."</a></td></tr>";	  
$tp=$tp+$mdb['t_pul'];
	 if($mdb['cash']=="n") { $na=$na+$mdb['t_pul'];}
	 if($mdb['cash']=="p") { $pl=$pl+$mdb['t_pul'];}
}
echo "<tr><td colspan=7 align='center'>Jami: <font color='#FF0000' size='+1'><b>".$tp."</b></font> Shundan ".$na." so`m naqt  &nbsp; &nbsp; ".$pl." so`m plastik kartadan to`lov amalga oshirilgan</td></tr>";
}
?>

</table>


</body>
</html>