<?
require("../../mainconfig.php");
mysqli_query($db, "UPDATE kegiatan SET status = 'hide' WHERE id = '".$_GET['1']."'");
header("Location: ".$cfg_baseurl."config/kegiatan");