<?php
use PHPMailer\PHPMailer\PHPMailer;


if(isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $message = $_POST['message'];

  
  require_once "PHPMailer/PHPMailer.php";
  require_once "PHPMailer/Exception.php";
  require_once "PHPMailer/SMTP.php";

  // Instantiate new PHPMailer
  $mail = new PHPMailer();

  // SMTP settings
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = '<Enter Sender Email>'; //Sender Email
  $mail->Password = '<Enter Sender Password>'; //Sender Email Password
  $mail->Port = 465;
  $mail->SMTPSecure = 'ssl';

  //Email settings
  $mail->isHTML(true);
  $mail->addAddress('<Enter Receiver Email>'); //Receiver Email
  $mail->setFrom($email, $name);
  $mail->Subject = ("Name: $name - Email: $email");
  $mail->Body = ("Message: <br /> $message");

  if($mail->send()) {
    $status = 'Success';
    $response = 'Email is sent!';
  }
  else {
    $status = 'Failed';
    $response = "Something is wrong: <br />" . $mail->ErrorInfo; 
  }
  
  exit(json_encode(array(
    "status" => $status, 
    "response" => $response
  )));

}
?>