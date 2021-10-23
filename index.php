<?php 
include("data/db.php");
$day=date("Y-m-d");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="data/styles1.css" type="text/css" />
<title>Darmon Klinikasi</title>

</head>

<body>
<table width="80%" border="1" class="tab" align="center">
    <tbody>
    <tr>
        
       <td bgcolor="#D5FEC5" bordercolor="#006633">
    <form action="saqlash.php" method="post">
<br>
          <center> <strong> Mijozning familiyasi ismi va otasining ismi: &nbsp; &nbsp; </strong><input class="inp" size="50" name="fio" value="" placeholder="FIO" type="text"></center><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Pasport seriyasi </strong>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="13" placeholder="Passport seriya"  name="pass">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tug`ilgan yili:</strong>&nbsp;&nbsp;
<input type="text" size="5" placeholder="yil" name="ty">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Manzil:</strong>&nbsp;&nbsp;&nbsp;
<input type="text" placeholder="Manzil" name="manzil" size="40"><br>
            <br>
          <div align="center"><label>Xizmatlar turini tanlang:   
              <select name="xizname" id="select">
              <option><strong>Xizmatlar turini</strong></option>
			<?php $dat=mysql_query("select * from `xizmatlar`");  
			while ($myr=mysql_fetch_array($dat))
			{
				echo"<option>";  echo($myr['xizmat_name']);echo"</option>";

			}  ?>
              </select>
          </label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; To`lov turi: 
    
            <label>
              <input type="radio" name="cash" value="n" id="Tolovshakli_0">
              Naqt pul</label>
       
            <label>
              <input type="radio" name="cash" value="p" id="Tolovshakli_1">
              Plastik kartadan to`lov</label>
            <br>

          <br>
<br>

         <input  class="col"  type="submit"  value=" Buyurtma berish " ></div></form>

        </td>
        
       
    </tr>
</tbody></table><br>

<div align="center"><a href="delete.php"><img src="del.png" width="204" height="53"></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="edit.php"><img src="ta.png"  width="204" height="53"></a> </div><br>

<fieldset><legend>Filterlash bo`limi</legend>
<form action="index.php" method="get">

   <label>
              <select name="docname" id="select">
              <option value="">Doktorni tanlang</option>
			<?php $dat=mysql_query("select * from `doctors`");  
			while ($myr=mysql_fetch_array($dat))
			{
				echo"<option>";  echo($myr['fio']);echo"</option>";

			}  ?>
              </select>
          </label>  
          
   <label>
              <select name="xizname" id="select">
              <option value="">Xizmat turini tanlang</option>
			<?php $dat=mysql_query("select * from `xizmatlar`");  
			while ($myr=mysql_fetch_array($dat))
			{
				echo"<option>";  echo($myr['xizmat_name']);echo"</option>";

			}  ?>
              </select>
          </label>
Familiya: <input type="text" name="fam">          
     
  <input class="tugma" type="submit" value=" Qidirish yoki qidirishni bekor qilish ">
</form>
</fieldset><br>

<div align="center" class="title"> &nbsp; &nbsp; &nbsp; &nbsp; 
 <strong>Bugungi to`lovlar:</strong> &nbsp;&nbsp;<font color="#FF0000"><b>
 <?php
 $na=0;
 $pl=0;
 $db1=mysql_query("select * from `client` where `data` = '$day'");
 while($mdb1=mysql_fetch_array($db1))
 {
	if($mdb1['cash']=="n") { $na=$na+$mdb1['t_pul'];}
	 if($mdb1['cash']=="p") { $pl=$pl+$mdb1['t_pul'];}
 }
 $jp=$pl+$na;
 echo"Naqt pul tushumi:  <font color='#000000'>".$na."</font> so`m &nbsp; &nbsp; &nbsp; &nbsp; Plastik kartadan to`lov <font color='#000000'>".$pl."</font> so`m &nbsp; &nbsp; &nbsp; Jami to`lovlar <font color='#000000' size='+1'>".$jp."</font> so`m";
 ?>
 
 </b></font><hr><strong class="aniq"><font size="+2">Bugun kiritilgan mijozlar</font></strong></div>
  <table width="100%"  align="center" class="tab" border="2"><tr align="center"><td><b>Mijozning familiyasi va ismi </td><td align="center"><b>Mijozning<br>
passport seriyasi</td><td><b>Tanlangan xizmat </td><td> <b>Doktor</td><td> <b>Xizmatlar</td><td><b>To'lagan puli</b></td><td width="30"><b>Navbati</td></tr>
<?php
$fio=$_GET['fam'];
$doc=$_GET['docname'];
$xiz=$_GET['xizname'];
$s="select * from `client` where `data` = '$day'";
if($fio!="") { $s=$s." and `fio` like '%$fio%'";  }
if($doc!="") { $s=$s." and `doctors` like '$doc'";}
if($xiz!="") { $s=$s." and `xiz_name` like '$xiz'";}
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
?>


</table>         

</body>
</html>