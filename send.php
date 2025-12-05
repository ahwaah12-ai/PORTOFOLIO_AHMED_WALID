<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // تأكد إن البيانات موجودة
    if(empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        http_response_code(400);
        echo "Please fill all fields correctly.";
        exit;
    }

    $to = "ah.wa.ah12@gmail.com";
    $email_subject = "New Contact Form Message: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Subject: $subject\n".
                  "Message:\n$message\n";

    $headers = "From: $email";

    if(mail($to, $email_subject, $email_body, $headers)){
        http_response_code(200);
        echo "Message sent successfully!";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong, please try again.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
