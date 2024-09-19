<?php
require 'vendor/autoload.php';

use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

session_start();


$g = new GoogleAuthenticator();
$secret = $g->generateSecret();

$_SESSION['secret'] = $secret; 
$websiteName = "phpmaster.in";
$useremail = "sajid.phpmaster@gmail.com";

// Generate the QR Code URL using the email, secret, and website name
$qrCodeUrl = GoogleQrUrl::generate($useremail, $secret, $websiteName);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Google Authenticator Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Google Authenticator Setup</h3>
            </div>
            <div class="card-body text-center">
                <p>Scan this QR Code using the Google Authenticator app.</p>
                <img src="<?= $qrCodeUrl ?>" alt="QR Code" class="img-fluid mb-3">
                
                <!-- Form to submit the OTP code from the Google Authenticator app -->
                <form action="verify.php" method="GET" class="mt-4">
                    <div class="mb-3">
                        <label for="auth_code" class="form-label">Enter the Code from the App</label>
                        <input type="text" class="form-control" id="auth_code" name="auth_code" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Verify Code</button>
                </form>

                <!-- Refresh button to regenerate the QR code -->
                <form action="index.php" method="GET" class="mt-4">
                    <button type="submit" class="btn btn-warning">Refresh QR Code</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
