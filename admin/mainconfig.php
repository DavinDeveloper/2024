<?php
$db = mysqli_connect('localhost','u404043844_binatama','U404043844_binatama','u404043844_binatama');
if (mysqli_connect_error()) {
	die("Database error!");
}

date_default_timezone_set('Asia/Jakarta');

$check_cfg = mysqli_query($db, "SELECT * FROM config WHERE id = '1'");
$cfg = mysqli_fetch_assoc($check_cfg);
$check_website = mysqli_query($db, "SELECT * FROM website WHERE target = 'admin'");
$data_website = mysqli_fetch_assoc($check_website);

$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
$data_user = mysqli_fetch_assoc($check_user);

$cfg_webname = $data_website['webname']." ".$cfg['name'];
$cfg_baseurl = $cfg['url'].$data_website['target']."/";
$home = $cfg['url'];