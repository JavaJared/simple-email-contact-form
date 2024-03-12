<?php
// Define variables and initialize with empty values
$name = $email = $subject = $message = "";
$name_err = $email_err = $subject_err = $message_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email address.";
    } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $email_err = "Invalid email format.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Validate subject
    if(empty(trim($_POST["subject"]))){
        $subject_err = "Please enter a subject.";
    } else{
        $subject = trim($_POST["subject"]);
    }

    // Validate message
    if(empty(trim($_POST["message"]))){
        $message_err = "Please enter your message.";
    } else{
        $message = trim($_POST["message"]);
    }

    // Check input errors before sending the email
    if(empty($name_err) && empty($email_err) && empty($subject_err) && empty($message_err)){
        
        // Recipient email address
        $to = "your@email.com";
        // Create email headers
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: ". $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Sending email
        if(mail($to, $subject, $message, $headers)){
            echo '<p class="success">Message sent successfully!</p>';
        } else{
            echo '<p class="error">Unable to send email. Please try again.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
    <style>
        .error {color: #FF0000;}
        .success {color: #00FF00;}
    </style>
</head>
<body>

<h2>Contact Us</h2>
<p>Please fill in this form and send us.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error"><?php echo $name_err;?></span><br><br>
    Email: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error"><?php echo $email_err;?></span><br><br>
    Subject: <input type="text" name="subject" value="<?php echo $subject;?>">
    <span class="error"><?php echo $subject_err;?></span><br><br>
    Message: <textarea name="message" rows="5" cols="40"><?php echo $message;?></textarea>
    <span class="error"><?php echo $message_err;?></span><br><br>
    <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>
