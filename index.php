<?php 
  // Message Vars
  $msg = '';
  $msgClass = '';

  // Check for Submit
  if (filter_has_var(INPUT_POST, 'submit')) {
    // Get the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Check Required Fields
    if (!empty($email) && !empty($name) && !empty($message)) {
      // Passed
      // Check Email Validation
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          // FAILED
        $msg = 'Please fill in a Valid Email';
        $msgClass = 'alert-danger'; 
      } else { 
        // Passed
        // Recipient Email
        $toEmail = 'usmanquadryl@gmail.com'; 
        $subject = 'Contact Request From' .$name;
        $body = '<h2> Contact Request </h2>
              <h4>Name</h4><p> '.$name.' </p>
              <h4>Email</h4><p>'.$email.'</p>
              <h4>Message</h4><p>'.$message.'</p>
              ';

              //Email Headers
              $headers = "MIME-VERSION: 1.0" ."\r\n";
              $headers .= "Contact-Type:text/html;charset=UTF-8" ."\r\n";

              // Additional Headers
              $headers .= "From:" .$name. "<".$email. ">". "\r\n";

              if (mail($toEmail, $subject, $body, $headers)) {
                // Email Sent
                $msg = 'Your email was not sent';
                $msgClass = 'alert-danger';
              }
      }
    } else {
     // Failed 
      $msg = 'Please fill in all fields';
      $msgClass = 'alert-danger'; 
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact Us </title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-success">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">My Website</a>
      </div>
    </div>
  </nav>   
  <div class="container">
      <?php if($msg != ''): ?>
          <div class= "alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
      <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
      <div class="form-group">
        <label>Name</label>
        <input type="text" name = "name" class ="form-control" value = "<?php echo isset($_POST['name']) ? $name : '';?>">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="text" name = "email" class ="form-control" value = "<?php echo isset($_POST['email']) ? $email : '';?>">
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea name = "message" class ="form-control"> <?php echo isset($_POST['message']) ? $message : '';?> </textarea>
        <br>
        <button type = "submit" name = "submit" class = "btn btn-primary">Submit</button>
      </div>
    </form>
  </div>




    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>