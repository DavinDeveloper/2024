<?php
session_start();
require("../libs/main/config.php");

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