<?php
require 'vendor/autoload.php';

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

session_start();

if (!isset($_SESSION['secret'])) {
    echo "No secret key found! Please go back and scan the QR code.";
    exit;
}

$secret = $_SESSION['secret'];
$g = new GoogleAuthenticator();


$isValid = null;
// Check if the form is submitted
if (isset($_GET['auth_code'])) {
    $userInputCode = $_GET['auth_code'];
    $isValid = $g->checkCode($secret, $userInputCode);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Google Authenticator Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Google Authenticator Verification</h3>
            </div>
            <div class="card-body text-center">

                <!-- Display result if code is checked -->
                <?php if ($isValid === true): ?>
                    <div class="alert alert-success" role="alert">
                        Authentication Successful!
                    </div>
                <?php elseif ($isValid === false): ?>
                    <div class="alert alert-danger" role="alert">
                        Authentication Failed! Please try again.
                    </div>
                <?php endif; ?>

            
                <form action="verify.php" method="GET" class="mt-4">
                    <div class="mb-3">
                        <label for="auth_code" class="form-label text-danger fw-bold">Enter the different Code from the App, check again its working or not :)</label>
                        <input type="text" class="form-control" id="auth_code" name="auth_code" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Verify Code</button>
                </form>

                <a href="index.php" class="btn btn-secondary mt-3">Go Back</a>
            </div>
        </div>
    </div>
</body>
</html>
