<?php 
	  $db=mysql_connect('localhost','root','');
	  mysql_select_db("sirmed",$db);
	  
$day=date("Y-m-d");
function dateconv($dd)
{
	
$dan=substr($dd,8,2).".".substr($dd,5,2).".".substr($dd,0,4);
return $dan;
	
}
function repp($word){
	$word = str_replace(".","",$word);
	$word = str_replace(",","",$word);
	$word = str_replace("?","",$word);
	$word = str_replace("!","",$word);
	$word = str_replace(":","",$word);
	$word = str_replace(";","",$word);
	$word = str_replace("("," ",$word);
	$word = str_replace(")"," ",$word);
	$word = str_replace("'","`",$word);
	
	return($word);
}
$da=date("Y-m-d");    //Joriy sana aniqlandi
$f=fopen("1.txt","r");
$buff=fread($f,10);  // fayl ichidagi ma'lumotlar o'qildi.
fclose($f);
if ($da != $buff) 
{
	$f=fopen("1.txt","w");
	fwrite($f,$da);   //////////// Agar sana o'zgargan bo'lsa sanoqni boshidan boshla
	fclose($f);
	$updoc=mysql_query("UPDATE `doctors` SET `oxir_num` = '0'");

}

?>