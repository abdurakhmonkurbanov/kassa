<?php 
session_start();
include("data/db.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

    <script src="date/datetimepicker_css.js"></script>
<link rel="stylesheet" href="data/styles1.css" type="text/css" />
<title>Arxiv</title>
</head>

<body>
<div class="title" align="center"><b>Axriv bo'limi</b></div>
<br>
<fieldset><legend>Sanani ko'rsating</legend>
        <form method="get" action="arxiv.php">
        <label for="demo1"></label>
       dan: <input type="Text" id="demo1" name="dan" maxlength="25" size="25"/>
        <img src="data/cal.gif" onclick="javascript:NewCssCal('demo1')" style="cursor:pointer"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="demo2"></label>
        gacha: <input type="Text" id="demo2" name="gacha" maxlength="25" size="25"/>
        <img src="data/cal.gif" onclick="javascript:NewCssCal('demo2')" style="cursor:pointer"/>

        <br>
<input type="submit" value="Ekranga chiqarish">        </form></fieldset>
<?php 
$dan=$_GET['dan'];
$gacha=$_GET['gacha'];
if (($dan!="") and ($gacha!=""))     ////////////////////  sana oralig'ini tanlash
{
echo("<br><font class=col2> Tanlangan muddat&nbsp;&nbsp;&nbsp;<b>".$dan."</b> dan <b>".$gacha."</b> gacha </font><br><br>");
?>

<?php 
$docname=$_GET['docname'];
$xizname=$_GET['xizname'];
$fam=$_GET['fam'];

?>
<fieldset><legend>Tanlangan sana bo'yicha filterlash bo`limi</legend>
<form action="arxiv.php" method="get">

   <label>
              <select name="docname" id="select">
              <option value="1">Doktorni tanlang</option>
			<?php $dat=mysql_query("select * from `doctors`");  
			while ($myr=mysql_fetch_array($dat))
			{
				echo"<option>";  echo($myr['fio']);echo"</option>";

			}  ?>
              </select>
          </label>  
          
   <label>
              <select name="xizname" id="select">
              <option value="2">Xizmat turini tanlang</option>
			<?php $dat=mysql_query("select * from `xizmatlar`");  
			while ($myr=mysql_fetch_array($dat))
			{
				echo"<option>";  echo($myr['xizmat_name']);echo"</option>";

			}  ?>
              </select>
          </label>
Familiya: <input type="text" name="fam">          
     <input type="hidden" name="dan" value="<?php echo($dan);  ?>">
     <input type="hidden" name="gacha" value="<?php echo($gacha);  ?>">     
  <input class="tugma" type="submit" value="Filterlash yoki filterlashni bekor qilish">
  <?php 
                    
$dan1=$dan;
$gacha1=$gacha;    ////////////////////////  Filterni bekor qilish uchun
$dan=substr($dan,6,4)."-".substr($dan,3,2)."-".substr($dan,0,2);
$gacha=substr($gacha,6,4)."-".substr($gacha,3,2)."-".substr($gacha,0,2);   /////////////////  Bazadagi formatlarga o'tkazildi
$myda=mysql_query("SELECT *  FROM `client` WHERE `data` >= '$dan'   and  `data` <= '$gacha' ORDER BY `client`.`id`  DESC");    ///// Hech qanday shartsiz kunlar orasidagi xisobotlar  
  ?>
</form>
</fieldset><br>

<?php 
 
//////////////////////   Shartlar boshlandi
if (($docname!=1) and ($xizname==2) and ($fam==""))        /////  doctor bo'yich
{
$myda=mysql_query("select * from `client` where `data` >= '$dan'   and  `data` <= '$gacha' and `doctors` = '$docname'  ORDER BY `client`.`id`  DESC");
echo("Tanlangan Doktor: &nbsp;&nbsp;<b>".$docname."</b><br>");
}
if (($docname==1) and ($xizname!=2) and ($fam==""))		//   xizmat nomi bo'yicha
{
$myda=mysql_query("select * from `client` where `data` >= '$dan'   and  `data` <= '$gacha' and `xiz_name` = '$xizname'  ORDER BY `client`.`id`  DESC");
echo("Tanlangan Xizmat turi:&nbsp;&nbsp;&nbsp;&nbsp;<b>".$xizname."</b><br>");
}

if (($docname==1) and ($xizname==2) and ($fam!=""))			//   familiya  bo'yicha
{
$myda=mysql_query("SELECT *  FROM `client` WHERE `data` >= '$dan'   and  `data` <= '$gacha' and `fio` LIKE '%$fam%'  ORDER BY `client`.`id`  DESC");
echo("Kiritilgan mijozning familiyasi va ismi tiri<b>".$fam."</b><br>");

}

?>
 <div align="center" class="title">Natijalar<br> </div>
<table width="100%" class="tab" border="1"><tr class="tug1"><td><strong>Mijozning familiyasi va ismi</strong> </td><td align="center"><strong>Mijozning<br>
passport seriyasi</strong></td><td><strong>Tanlangan xizmat</strong> </td><td> <strong>doktor</strong></td><td> <strong>xizmat tipi</strong></td><td><b>To'lagan puli</b></td><td width="70"><strong>Sanasi</strong></td></tr>

<?php

$i=1;  $na=0;  $pl=0;
while ($myr=mysql_fetch_array($myda))    ///////////////////   ekranga chiqarish
{
	$dd=dateconv($myr['data']);
	echo"<tr><td>".$myr['fio']."</td><td>".$myr['passport']."</td><td>".$myr['xiz_name']."</td><td>".$myr['doctors']."</td><td>".$myr['xizmat_type']."</td><td>".$myr['t_pul']."</td><td>".$dd."</td></tr>";	

	if ($myr['cash']=="n"){ $na=$na+(int)$myr['t_pul'];};
	if ($myr['cash']=="p"){ $pl=$pl+(int)$myr['t_pul'];};

} 

echo("<tr><td colspan=9 align=center><font size=3 color=#ff00><b>Jami: &nbsp;&nbsp;&nbsp;&nbsp; <font color=#0000ff> Naqt pul: $na &nbsp; &nbsp; Plastikdan $pl </font> &nbsp;&nbsp;so`m</b></font></td></tr>");
     ////////////////Ikkinchi filterlash
}/////////////////////////// Sana oralig'ini tanlash tugadi

?>
</table>
</body>
</html>