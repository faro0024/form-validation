<?php

// Check if submit button is clicked
// by checking if $_GET["submit-data"] has value

// isset($variable_to_be_checked)
// if the value of variable $variable_to_be_checked is NULL
// isset() returns false. In every other case isset() returns true.
  
// if submit button is clicked
if (isset($_GET["submit-data"])) {
    
    /*
    // print entire $_GET array
    echo "<pre>\$_GET ";
    print_r($_GET);
    echo "</pre>";
    */
    
    $errors = NULL;
    $valid = false;
    
    // validate the fullname
    if (trim($_GET["fullname"])) {
        $fn = filter_var($_GET["fullname"], FILTER_SANITIZE_STRING);
    } else {
        $errors = "<p>Full name?</p>";
    }
    
    
    // here you want to do the same thing for your email
    if (trim($_GET["email"])) {
        
        // if you get here, it means there is some value.
        // Now you need to check if that value is 
        // email in proper format!
        // if filter_var() returns true, email IS OK!
        if (filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
            $em = $_GET["email"];
        } else {
            // remove the email from $_GET array
            $_GET["email"] = NULL;
            
            // create error-message
            $errors .= "<p>Invalid email!</p>"; 
         }
    }else {
        $errors .= "<p>your email?</p>";
    }
     
    
    // here you want to do the same thing for your message
    
     if (filter_var($_GET["message"],FILTER_SANITIZE_STRING)) {
        $msg = $_GET["message"];
    } else {
        $errors = "<p>Message?</p>";
    }
    
    // Create the feedback
    if (isset($fn) && isset($em) && isset($msg)){
        $valid = true;
        $feedback = "<p>Hello {$fn}! Thank you for your message : {$msg} . </p>
        <p> We are going to email you at {$em} if any change happens in your program.</p>";
    }   
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Example Form</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <? 
    </head>
    <body>
         <nav>
      <ul>
        <li class="nav-item"><a href="#" class="nav-item-link">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-item-link">Blog</a></li>
        <li class="nav-item"><a href="#" class="nav-item-link">Contact</a></li>
      </ul>
    </nav>
        <div class="wrapper">
        <form action="example-form.php" method="get">
            <fieldset>
                <legend>FORM ASSIGNMENT</legend>
        
                <div class="box1">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" value="<?php if (isset($valid) && (!$valid)) { echo $_GET["fullname"]; } ?>">
                </div>
                <div class="box1">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php if (isset($valid) && (!$valid))
                    { echo $_GET["email"]; } ?>">
                </div>
                
                <div class="box2">
                    <label for="message">Message</label>
                    <textarea type="text" name="message" value="<?php if (isset($valid) && (!$valid))
                    { echo $_GET["message"];} ?>"></textarea>
                </div>
                <div class="box">
                    <input type="submit" value="SUBMIT DATA" name="submit-data">
                </div>
            
                         <?php
        // Do your printing here
        
        // if feedback exists, print it
        if (isset($feedback)) {
            echo $feedback;
        }
        
        if (isset($errors)) {
            echo $errors;   
        }
        ?>
            </fieldset>
        </form>
        </div>
        
    <footer>
    <ul>
      <li class="nav-item"><a href="#" class="nav-item-link"><i class="fab fa-facebook-messenger"></i><br>Facebook Messenger</a></li>
      <li class="nav-item"><a href="#" class="nav-item-link"><i class="fab fa-amazon"></i>
      <br>Amazon</a></li>
      <li class="nav-item"><a href="#" class="nav-item-link"><i class="fab fa-behance-square"></i><br>Behance</a></li>
      <li class="nav-item"><a href="#" class="nav-item-link"><i class="fab fa-twitter-square"></i><br>Twitter</a></li>
    </ul>
  </footer>
       
        
    </body>
</html>