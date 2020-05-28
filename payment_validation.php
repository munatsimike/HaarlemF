<?php
// Define variables and initialize with empty values
$name = $surname = $email = "";
$name_err = $surname_err = $email_err =  $confirm_email_err = "";

// Processing form data when form is submitted
if(isset($_POST['paymentbtn'])){
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter  your name.";
    } else{
          $name = trim($_POST["name"]);
    }
    if(empty(trim($_POST["surname"]))){
        $surname_err = "Please enter  your surname.";
    } else{
          $surname = trim($_POST["surname"]);
    }
    // Validate email
    if(empty(trim($_POST["email"])) || filter_var(!$_POST["email"], FILTER_VALIDATE_EMAIL )){
      $email_err = "Please enter a valid email";

    } else{
        $email= trim($_POST["email"]);
    }
    if($email != $_POST['confirm_email']){
      $_confirm_email_err = "email address does not match";
    }

    if(empty($name_err) && empty($surname_err) && empty($email_err) && empty($confirm_email_err)){
      $_SESSION['name'] = $name;
      $_SESSION['surname'] = $surname;
      $_SESSION['email'] = $email;
      // send transecation to database;
      echo  "<script type='text/javascript'>
         if(!alert('Payment Successfull')) document.location = 'pdfInvoice.php';
      </script>";

      }

}
