<?php 
include("data/db.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Delete</title>
</head>

<body>
<?php 
$xid=$_GET['x'];   /////////////////   O'zgartirish boshlandi
$narx=$_GET['narxi'];
if ($yanginid!="")
{
mysql_query("delete from `xizmat_type` where `xiz_name_id` = '$yanginid' and `xizmat_type_id` = '$yangixid' LIMIT 1;");

echo"Ma`lumotlar o`chirildi!<br><a href=xizmatlar.php>Qaytish</a>";
}
?>
</body>
</html>