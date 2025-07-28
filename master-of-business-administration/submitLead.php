<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

// Helper function to fetch the first non-empty POST value
function get_post_value($keys)
{
    foreach ($keys as $key) {
        if (isset($_POST[$key]) && !empty(trim($_POST[$key]))) {
            return trim($_POST[$key]);
        }
    }
    return '';
}

if (isset($_POST)) {
    // Collect data from POST request
    $name  = get_post_value(['name', 'name2', 'name3']);
    $email = get_post_value(['email', 'email2', 'email3']);
    $phone = get_post_value(['phone', 'phone2', 'phone3']);
    $state = get_post_value(['state', 'state2', 'state3']);
    $city  = get_post_value(['city', 'city2', 'city3']);
    $course = get_post_value(['course', 'course2', 'course3']);

    $level_applying_for = $_POST['level'];
    $registered_country = 'INDIA';
    $user_registration_date = date('Y-m-d H:i:s');
    $widget_name = 'ISBMU';
    $lead_origin = "API";
    $lead_source = "Google ADS LogicLoop";
    $current_url = $_POST['current_url'];
    $utm_source = $_POST['utm_source'];
    $utm_medium = $_POST['utm_medium'];
    $utm_campaign = $_POST['utm_campaign'];
    $utm_adgroup = $_POST['utm_adgroup'];
    $utm_term = $_POST['utm_term'];
    $ip_data = $_POST['key1'];
    $key = $_POST['key'];

    $data = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'state' => $state,
        'city' => $city,
        'country' => 'India',
        'course' => $course,
        'level' => $level_applying_for,
        'registered_country' => $registered_country,
        'user_registration_date' => $user_registration_date,
        'widget_name' => $widget_name,
        'lead_origin' => $lead_origin,
        'lead_source' => $lead_source,
        'current_url' => $current_url,
        'utm_source' => $utm_source,
        'utm_medium' => $utm_medium,
        'utm_campaign' => $utm_campaign,
        'utm_adgroup' => $utm_adgroup,
        'utm_term' => $utm_term,
        'key1' => $ip_data,
        'key' => $key,
    );

    // First cURL request
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'https://insityapp.com/API/lead-data-IP.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        )
    );

    $response1 = curl_exec($curl);

    if (curl_errno($curl)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'cURL error: ' . curl_error($curl),
        ]);
        curl_close($curl);
        exit;
    }
    curl_close($curl);

    // Second cURL request
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbwUfM1oiOY4uG2fv1vRDKvlhQyOVVc__UxZaq3Hjj0ar_u0ttdR0_epF0avgJn1YekU/exec',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        )
    );

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'cURL error: ' . curl_error($curl),
        ]);
        curl_close($curl);
        exit;
    }
    curl_close($curl);

    $response_data = json_decode($response1, true);

    if (isset($response_data['status']) && $response_data['status'] === "success") {
        echo "<script type='text/javascript'> document.location = 'thank-you.php'; </script>";
    } else {
        echo "<script type='text/javascript'> document.location = 'thank-you.php'; </script>";
    }
} else {
    echo 'No form submission detected.';
}
