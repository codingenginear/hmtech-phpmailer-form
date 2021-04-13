<?php
include "sendEmail.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="styles.css" media="all">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
  <title>PHPMailer Form</title>
</head>
<body>
  <div class="container">
    <div class="container-header">
        <h4 class="sent-notification">Send us an email!</h4>
    </div>
    <form action="index.php" method="POST" class="form" id="form">
      <div class="form-group">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" tabindex="1" required>
      </div>
      <div class="form-group">
        <label for="email" class="form-label">Your Email</label>
        <input type="email" required class="form-control" id="email" name="email" placeholder="Email" tabindex="2" >
      </div>
      <div class="form-group">
        <label for="phoneNumber" class="form-label">Phone</label>
        <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" tabindex="3" required>
      </div>
      <div class="form-group">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" tabindex="3" required>
      </div>
      <div class="form-group">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" rows="5" cols="50" id="message" name="message" placeholder="Leave a note!" tabindex="4"></textarea>
      </div>
      <div class="form-btn">
          <button type="submit" class="btn" onclick="sendEmail(event)">Send Message!</button>
      </div>
    </form>
  </div>
  
  <!-- jQuery script tag -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
    <!-- jQuery and Ajax JavaScript post to php backend and validation -->
    <script type="text/javascript">
        function sendEmail(event) {
          event.preventDefault();
          let name = $("#name");
          let email = $("#email");
          let phoneNumber = $("#phoneNumber");
          let address = $("#address");
          let message = $("#message");
          
          if (isNotEmpty(name) && validateEmail(email, email.val()) && isNotEmpty(phoneNumber) && isNotEmpty(address) && isNotEmpty(message)) {
            $.ajax({
              url: 'sendEmail.php',
              method: 'POST',
              dataType: 'json',
              data: {
                  name: name.val(),
                  email: email.val(),
                  phoneNumber: phoneNumber.val(),
                  address: address.val(),
                  message: message.val()
                },
              success: function(response) {
                  $("#form")[0].reset();
                  $(".sent-notification").text("Thank you, this message has been sent.");
              },
              error: function(xhr, status, error) {
                  console.log(error);
              }
                
            }) 
          }
          else {
            $(".sent-notification").text("Form has not been sent, please enter your information correctly.");
          }
        }

        function isNotEmpty(inputField) {
          if(inputField.val() == "") {
            inputField.css('borderBottom', '4px solid #9F2929');
            return false;
          }
          else 
          {
            inputField.css('border', '');
            return true;
          }
        }

        function validateEmail(mailInputField, mailInputFieldVal) {
          if (mailInputFieldVal.includes('@')) {
            return true;
          }
          else {
            mailInputField.css('borderBottom', '4px solid #9F2929');
            return false;
          }
        }
    </script>
</body>
</html>