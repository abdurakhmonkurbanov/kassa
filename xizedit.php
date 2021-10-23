<?php 
include("data/db.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Xizmatlarni tahrirlash</title>
</head>

<body>
<?php 
$xid=$_GET['x'];
if ($xid!="")    //////////  Dastlabki qiymatlarni o'qish
{
$my=mysql_query("select * from `xizmat_type` where `id` = '$xid'");
$res=mysql_fetch_array($my);
?>
<form action="xizedit.php" method="get">
Xizmat turi:  <input type="text" name="xizmat_type" value="<?php echo($res['xizmat_type']); ?>"><br>
Xizmat narxi:  <input type="text" name="narxi" value="<?php echo($res['narxi']); ?>"><br>
<input type="hidden" name="xid" value="<?php  echo $xid;  ?>">
<input type="submit" value="O'zgartirish">
</form>
<?php 
}
$nxid=$_GET['xid'];
$xizty=$_GET['xizmat_type'];
$narx=$_GET['narxi'];
if ($nxid!="")
{
mysql_query("UPDATE `xizmat_type` SET `xizmat_type` = '$xizty', `narxi` = '$narx' WHERE `id` = '$nxid' LIMIT 1;");
echo"Ma`lumotlar saqlandi<br><a href=xizmatlar.php>Qaytish</a>";
}
?>
</body>
</html>