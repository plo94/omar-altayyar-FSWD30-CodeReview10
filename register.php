<?php

 ob_start();

 session_start(); // start a new session or continues the previous

 if( isset($_SESSION['user'])!="" ){

  header("Location: home.php"); // redirects to home.php

 }

 include_once 'dbconnect.php';


 $error = false;


 if ( isset($_POST['btn-signup']) ) {

 

  // sanitize user input to prevent sql injection

  $name = trim($_POST['name']);

  $name = strip_tags($name);

  $name = htmlspecialchars($name);

 

  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

 

  $pass = trim($_POST['pass']);

  $pass = strip_tags($pass);

  $pass = htmlspecialchars($pass);

 

  // basic name validation

  if (empty($name)) {

   $error = true;

   $nameError = "Please enter your full name.";

  } else if (strlen($name) < 3) {

   $error = true;

   $nameError = "Name must have atleat 3 characters.";

  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {

   $error = true;

   $nameError = "Name must contain alphabets and space.";

  }

 

  //basic email validation

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Please enter valid email address.";

  } else {

   // check whether the email exist or not

   $query = "SELECT user_email FROM users WHERE user_email='$email'";

   $result = mysqli_query($conn, $query);

   $count = mysqli_num_rows($result);

   if($count!=0){

    $error = true;

    $emailError = "Provided Email is already in use.";

   }

  }


  // password validation

  if (empty($pass)){

   $error = true;

   $passError = "Please enter password.";

  } else if(strlen($pass) < 6) {

   $error = true;

   $passError = "Password must have atleast 6 characters.";

  }

 

  // password encrypt using SHA256();

  $password = hash('sha256', $pass);

 

  // if there's no error, continue to signup

  if( !$error ) {

   

   $query = "INSERT INTO users(first_name,user_email,user_pass) VALUES('$name','$email','$password')";

   $res = mysqli_query($conn, $query);

   

   if ($res) {

    $errTyp = "success";

    $errMSG = "Successfully registered, you may login now";

    unset($name);

    unset($email);

    unset($pass);

   } else {

    $errTyp = "danger";

    $errMSG = "Something went wrong, try again later...";

   }

   

  }

 

 

 }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Hello, world!</title>
  </head>
  <body class="text-center">
    
 

    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <img class="mb-4" src="https://www.brainline.com/wp-content/uploads/2017/02/brainline_e-library.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal"> Sign Up</h1>
      <label for="inputEmail" class="sr-only">Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
      <span class="text-danger"><?php echo $nameError; ?></span>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
      <span class="text-danger"><?php #echo $emailError; ?></span>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
      <span class="text-danger"><?php echo $passError; ?></span>
      <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
      <div class="">
      <p class="mt-5 mb-3 text-muted">Library</p>
      </div>
      <div class="alert">
              <?php echo $errMSG; ?>
              <button type="button" class="btn btn-success"><a href="index.php">Sign in Here...</a></button>

             </div>
    </form>


   

       



           

            <?php

   if ( isset($errMSG) ) {

   

    ?>




 <?php

   }

   ?>

           

       

           

 

             <!--<input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php #echo $name ?>" />

       

                <span class="text-danger"><?php #echo $nameError; ?></span>


           

     

       

   

             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php #echo $email ?>" />

     

                <span class="text-danger"><?php #echo $emailError; ?></span>-->

       

           

       

             

         

           <!--  <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />

             

                <span class="text-danger"><?php echo $passError; ?></span>

       

             <hr />

 

           


             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>


             <hr />


           

             <a href="index.php">Sign in Here...</a>

     

   

    </form>-->





   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php ob_end_flush(); ?>