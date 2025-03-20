<?php
if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $mailFrom = htmlspecialchars(trim($_POST['mail']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Multiple recipients should be an array
    $mailTo = ['vednavoday@gmail.com', 'auritromridha18@gmail.com'];

    $headers = "From: $mailFrom\r\n";
    $headers .= "Reply-To: $mailFrom\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    $txt = "You have received an email from $name.\n\n$message";

    $success = true;
    foreach ($mailTo as $recipient) {
        if (!mail($recipient, $subject, $txt, $headers)) {
            $success = false;
        }
    }

    if ($success) {
        echo "<script>alert('Thank you for contacting us. Your message has been sent successfully.'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('There was an issue sending your message. Please try again later.'); window.history.back();</script>";
    }
} else {
    header("Location: contact.html");
    exit();
}
