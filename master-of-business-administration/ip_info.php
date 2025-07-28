<?php
date_default_timezone_set('Asia/Kolkata');
function getClientIp()
{
    $ipaddress = '';

    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED']) && !empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && !empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR']) && !empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED']) && !empty($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    if (strpos($ipaddress, ',') !== false) {
        $ipaddress = explode(',', $ipaddress)[0];
    }

    return $ipaddress;
}

$clientIp = getClientIp();
$currentTimestamp = date('Y-m-d H:i:s');
$geoapifyApiKey = '4ccdf266b4654a4eb1cfdd38427bef87';
$geoapifyCurl = curl_init();

curl_setopt_array(
    $geoapifyCurl,
    array(
        CURLOPT_URL => 'https://api.geoapify.com/v1/ipinfo?ip=' . $clientIp . '&apiKey=' . $geoapifyApiKey,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    )
);

$geoapifyResponse = curl_exec($geoapifyCurl);
curl_close($geoapifyCurl);
$geoapifyResponseArray = json_decode($geoapifyResponse, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'JSON decode error: ' . json_last_error_msg();
    exit;
}

$city = $geoapifyResponseArray['city']['name'] ?? 'Unknown';
$state = $geoapifyResponseArray['state']['name'] ?? 'Unknown';
$country = $geoapifyResponseArray['country']['name'] ?? 'Unknown';
$scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
$url = $scheme . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$time = time();
$alphabets = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomAlphabets = substr(str_shuffle($alphabets), 0, 4);
$key = "GADS_" . $randomAlphabets . $time;
$jsonKey = json_encode($key);

$emailData = array(
    "city" => $city,
    "state" => $state,
    "country" => $country,
    "ip" => $clientIp,
    "url" => $url,
    "key" => $key,
    
);

$jsonData = json_encode($emailData);

$url = "https://insityapp.com/API/storeip.php";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}


echo "<script>
var ipData = $jsonData;
var key = $jsonKey;
localStorage.setItem('ipData', JSON.stringify(ipData));
localStorage.setItem('key', JSON.stringify(key));
</script>";
// echo $response;
// echo $jsoch = json_encode($response);