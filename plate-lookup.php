<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['plate'])) {
    echo json_encode(['error' => 'Missing plate']);
    exit;
}

$plate = urlencode($_GET['plate']);
$apiKey = '43f5538f-572f-4899-a3f2-1d0434aa0817'; // ← your sandbox key
$url = "https://sandbox.ukvehicledata.co.uk/api/datapackage/vehicledata?key=$apiKey&licencePlate=$plate&include=mot-history";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($response === false || $httpcode !== 200) {
    echo json_encode(['error' => 'cURL error', 'details' => $error ?: "HTTP $httpcode"]);
} else {
    echo $response;
}
