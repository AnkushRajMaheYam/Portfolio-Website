<?php   
    require("./mailing/mailfunction.php");

    $name = $_POST["name"];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $jobLoc = isset($_POST['jobLoc']) ? $_POST['jobLoc'] : [];
    if (!is_array($jobLoc)) {
        $jobLoc = [$jobLoc];
    }
    $jobType = isset($_POST['jobType']) ? $_POST['jobType'] : '';
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $companyName = isset($_POST['companyName']) ? $_POST['companyName'] : '';

    $body = "<h2>New Contact Form Submission</h2>";
    $body .= "<ul>";
    $body .= "<li><strong>Name:</strong> " . htmlspecialchars($name) . "</li>";
    $body .= "<li><strong>Email:</strong> " . htmlspecialchars($email) . "</li>";
    $body .= "<li><strong>Phone:</strong> " . htmlspecialchars($phone) . "</li>";
    $body .= "<li><strong>Address:</strong> " . htmlspecialchars($address) . "</li>";
    $body .= "<li><strong>Job Location:</strong> " . implode(', ', array_map('htmlspecialchars', $jobLoc)) . "</li>";
    $body .= "<li><strong>Job Type:</strong> " . htmlspecialchars($jobType) . "</li>";
    $body .= "<li><strong>Company:</strong> " . htmlspecialchars($company) . "</li>";
    if ($company === 'others' && $companyName) {
        $body .= "<li><strong>Company Name:</strong> " . htmlspecialchars($companyName) . "</li>";
    }
    $body .= "<li><strong>Message:</strong> " . nl2br(htmlspecialchars($message)) . "</li>";
    $body .= "</ul>";

    $status = mailfunction("", "Company", $body); //reciever
    if($status)
        echo '<center><h1>Thanks! We will contact you soon.</h1></center>';
    else
        echo '<center><h1>Error sending message! Please try again.</h1></center>';    
?>