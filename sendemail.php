<?php
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Thank you for contact us. As early as possible  we will contact you '
	);
	// if (condition) {
	// 	# code...
	// }
    $name       = @trim(stripslashes($_POST['name']));
    $email      = @trim(stripslashes($_POST['email']));
    $subject    = @trim(stripslashes($_POST['subject']));
    $message    = @trim(stripslashes($_POST['message']));

    $email_from = $email;
    $email_to = 'email@email.com';//replace with your email

    $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

    $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

    echo json_encode($status);
    die;


		// $to = 'demo@spondonit.com';
    // $firstname = $_POST["fname"];
    // $email= $_POST["email"];
    // $text= $_POST["message"];
    // $phone= $_POST["phone"];
    //
    //
    //
    // $headers = 'MIME-Version: 1.0' . "\r\n";
    // $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //
    // $message ='<table style="width:100%">
    //     <tr>
    //         <td>'.$firstname.'  '.$laststname.'</td>
    //     </tr>
    //     <tr><td>Email: '.$email.'</td></tr>
    //     <tr><td>phone: '.$phone.'</td></tr>
    //     <tr><td>Text: '.$text.'</td></tr>
    //
    // </table>';
    //
    // if (@mail($to, $email, $message, $headers))
    // {
    //     echo 'The message has been sent.';
    // }else{
    //     echo 'failed';
    // }
