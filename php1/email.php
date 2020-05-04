<?php
if(isset($_POST['subutton']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    
    $txt="Name:".$name. "\r\n" ."Email:".$email. "\r\n" ."Message:".$message. "\r\n";

    $to="dlatiwari707@gmail.com";

    $subject="Contact:form for Nirbhaycommunication";
 
    $headers = "From: webmaster@example.com" . "\r\n" .
"CC:dlatiwari707@gmail.com"; 
    
    
if(mail($to,$subject,$txt,$headers))
{
    echo 'Email sent success.';
}else{
    echo 'Fail to send email.';
}
}

?>
