<?
if (!isset($_SESSION['user'])) {
    header("Location :".cfg(url)."auth/masuk");
}