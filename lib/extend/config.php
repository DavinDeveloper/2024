<?
$db = mysqli_connect('localhost','u404043844_binatama','U404043844_binatama','u404043844_binatama');
 
if (mysqli_connect_error()) {
	die("Database error!");
}

date_default_timezone_set('Asia/Jakarta');

$check_cfg = mysqli_query($db, "SELECT * FROM config WHERE id = '1'");
$cfg = mysqli_fetch_assoc($check_cfg);