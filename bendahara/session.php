<?
if (!isset($_SESSION['user'])) {
    header("Location :".cfg(url)."auth/masuk");
} else if ($user['status'] != 'Bendahara') {
    header("Location :".cfg(url));
}
?>