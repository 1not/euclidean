<!DOCTYPE html>
<html>
    
<body>
    
<?php

if(isset($_GET['email']))
{
    $email_to = "euclideanstudios@gmail.com";
    $email_subject = "Message";
    
    function died($error)
    {
        echo $error."<br /><br />";
        echo "Go back and fix these errors.<br /><br />";
        die();
    }
    
    if(!isset($_GET['name']) || !isset($_GET['email'])) 
    {
        died('Something went wrong!');
    }
    
    $name = $_GET['name'];
    $email = $_GET['email'];
    $message = $_GET['message'];
    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp, $email_from))
    {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }
        $string_exp = "/^[A-Za-z .'-]+$/";
    
    if(!preg_match($string_exp,$name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
    
    if(strlen($error_message) > 0) 
    {
        died($error_message);
    }
    
    $email_message = "Form details below.\n\n";
    
    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }
    
    $email_message .= "Name: ".clean_sstring($name)."\n";
    $email_message .= "Email: ".clean_sstring($email)."\n";
    $email_message .= "Message: ".clean_sstring($message)."\n";
    
    //email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'Euclidean: /' . phpversion();
    mail($email_to, $email_subject, $email_message, $headers);
}
?>
    
Your message was successfully sent!
    
</body>

</html>
