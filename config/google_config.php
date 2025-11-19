<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php'; // Load environment variables

// Cấu hình Google Client từ .env
$clientID = env('GOOGLE_CLIENT_ID');
$clientSecret = env('GOOGLE_CLIENT_SECRET');
$redirectUri = env('GOOGLE_REDIRECT_URI');

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// URL đăng nhập
$login_url = $client->createAuthUrl();
?>
