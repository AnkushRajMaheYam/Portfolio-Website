
<?php
// Get all form fields
$name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';
$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
$phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
$address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : '';
$jobLoc = isset($_POST['jobLoc']) ? htmlspecialchars(trim($_POST['jobLoc'])) : '';
$jobType = isset($_POST['jobType']) ? htmlspecialchars(trim($_POST['jobType'])) : '';
$company = isset($_POST['company']) ? htmlspecialchars(trim($_POST['company'])) : '';
$companyName = isset($_POST['companyName']) ? htmlspecialchars(trim($_POST['companyName'])) : '';
$message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
// Determine the company name to display
if ($company === 'others' && !empty($companyName)) {
    $finalCompany = $companyName;
} elseif (!empty($company)) {
    $finalCompany = ucfirst($company);
} else {
    $finalCompany = '';
}

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;
    $mail->Username   = ''; // SMTP username
    $mail->Password   = ''; // SMTP password (use App Password for Gmail)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('ankushrajmaheyam@email.com'); // Add a recipient

    //Content
    $mail->isHTML(false);
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\nAddress: $address\nJob Location: $jobLoc\nJob Type: $jobType\nCompany: " . (!empty($companyName) ? $companyName : ucfirst($company)) . "\nMessage: $message";

    $mail->send();
    $companyText = !empty($finalCompany) ? ' for ' . htmlspecialchars($finalCompany) : '';
        echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You | Ankush-Raj Portfolio</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <style>
            body { background: #0a192f; color: #fff; font-family: Poppins, Arial, sans-serif; margin: 0; }
            .thank-container { min-height: 100vh; display: flex; justify-content: center; align-items: center; }
            .thank-card { background: #112240; padding: 40px 30px; border-radius: 16px; box-shadow: 0 4px 24px rgba(18,247,255,0.15); text-align: center; max-width: 500px; }
            .thank-card h1 { color: #12f7ff; font-size: 2rem; margin-bottom: 20px; font-weight: 600; }
            .thank-card p { font-size: 1.15rem; color: #fff; margin-bottom: 18px; }
            .thank-card .subtext { font-size: 1rem; color: #a8b2d1; }
            .logo { font-size: 1.5rem; color: #12f7ff; font-weight: bold; margin-bottom: 18px; }
            @media (max-width: 600px) { .thank-card { padding: 20px 10px; } }
        </style>
    </head>
    <body>
        <div class="thank-container">
            <div class="thank-card">
                <div class="logo">Ankush <span style="color:#fff;">Raj</span></div>
                <h1 style="font-size:1.3rem;font-weight:500;">Thank you <span style="color:#fff;">' . htmlspecialchars($name) . '</span> for recognizing my profile as a valuable candidate for <span style="color:#fff;">' . htmlspecialchars($finalCompany) . '</span>.</h1>
                <p class="subtext" style="font-size:0.95rem;">I truly appreciate your time and will get back to you soon.</p>
            </div>
        </div>
    </body>
    </html>';
} catch (Exception $e) {
    echo '<center><h1>Error sending message! Please try again.</h1></center>';
    // Optionally log error: $mail->ErrorInfo
}
?>
