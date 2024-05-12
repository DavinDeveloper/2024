<?
session_start();
require("../lib/config.php");

session_destroy();
unset($_COOKIE[$cookie_name]);
setcookie($cookie_name, null, -1,'/');

$cookie_name = 'cloudpad';
unset($_COOKIE[$cookie_name]);
setcookie($cookie_name, null, -1,'/');

$cookie_name = 'PHPSESSID';
unset($_COOKIE[$cookie_name]);
setcookie($cookie_name, null, -1,'/');

$cookie_name = '__cfduid';
unset($_COOKIE[$cookie_name]);
setcookie($cookie_name, null, -1,'/');

header("Location: ".cfg(url));