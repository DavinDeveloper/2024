<?
session_start();
$db = mysqli_connect('localhost','u1574150_haji','u1574150_haji','u1574150_haji');
 
if (mysqli_connect_error()) {
	die("Database error!");
}

date_default_timezone_set('Asia/Jakarta');

function cfg($config) {
    global $db;
    $check_config = mysqli_query($db, "SELECT * FROM website WHERE config = '$config'");
    $data_config = mysqli_fetch_assoc($check_config);
    $echo_config = $data_config['content'];
    return $echo_config;
    // echo $echo_config;
}

define('API_KEY', 'nLHR5yvuBWfxIYY0fyNeDIl1AejLvh');
define('API_SENDER', '6281214262156');
define('API_URL', 'https://davin.gateaway.my.id/send-message');
function whatsapp($phone, $message) {
    $data = [
        'api_key' => API_KEY,
        'sender'  => API_SENDER,
        'number'  => $phone,
        'message' => $message
    ];
    $curl = curl_init();               
    curl_setopt_array($curl, array(
      CURLOPT_URL => API_URL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
}

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
    $user = mysqli_fetch_assoc($check_user);
    if (mysqli_num_rows($check_user) == 0) {
        header("Location: ".cfg(url)."auth/keluar");
    }
}
?>