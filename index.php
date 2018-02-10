<!doctype html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>


<?php

 ob_start();

 session_start();

 require_once 'dbconnect.php';

 

 // it will never let you open index(login) page if session is set

 if ( isset($_SESSION['user'])!="" ) {

  header("Location: home.php");

  exit;

 }

 

 $error = false;

 

 if( isset($_POST['btn-login']) ) {

 

  // prevent sql injections/ clear user invalid inputs

  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

 

  $pass = trim($_POST['pass']);

  $pass = strip_tags($pass);

  $pass = htmlspecialchars($pass);

  // prevent sql injections / clear user invalid inputs

 

  if(empty($email)){

   $error = true;

   $emailError = "Please enter your email address.";

  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Please enter valid email address.";

  }

 

  if(empty($pass)){

   $error = true;

   $passError = "Please enter your password.";

  }

 

  // if there's no error, continue to login

  if (!$error) {

   

   $password = hash('sha256', $pass); // password hashing using SHA256

 

   $res=mysqli_query($conn, "SELECT user_id, first_name, last_name, user_pass FROM users WHERE user_email='$email'");

   $row=mysqli_fetch_array($res, MYSQLI_ASSOC);

   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

   

   if( $count == 1 && $row['user_pass']==$password ) {

    $_SESSION['user'] = $row['user_id'];

    header("Location: home.php");

   } else {

    $errMSG = "Incorrect Credentials, Try again...";

   }

   

  }

 

 }

?>

<!DOCTYPE html>

<html>

<head>

<title>Login & Registration System</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="https://www.brainline.com/wp-content/uploads/2017/02/brainline_e-library.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Library
  </a>
</nav>


  <section class="jumbotron text-center" >
        <div class="container">
          <h1 class="jumbotron-heading">Login</h1>


 <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

   
             <hr />

             

            <?php

   if ( isset($errMSG) ) {



echo $errMSG; ?>

               

                <?php

   }

   ?>

           

           

             

             <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />

         

             <span class="text-danger"><?php echo $emailError; ?></span>

   

           


             <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />

         

            <span class="text-danger"><?php echo $passError; ?></span>


             <hr />
             <button type="submi" class="btn btn-light" name="btn-login">Sign In</button>
             
             <hr />
             <button type="button" class="btn btn-success"><a href="register.php">Sign Up Here...</a></button>
    </form>
         
        </div>
      </section>
      <hr>


    

<?php

$sql = "SELECT * FROM media";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '
  <main role="main" class="main">
    <div class="album py-5 ">
        <div class="container">
    <div class="row">
          ';

    while($row = $result->fetch_assoc()) {
      echo '
   
       <div class="col-md-4">
             <div class="card">
          <img class="card-img-top" src='.$row["image"].' alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">'.$row["title"].'</h5>
            <p class="card-text">"'.$row["description"].'"</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">'.$row["fk_author_id"].'</li>
            <li class="list-group-item">'.$row["type"].'</li>
            <li class="list-group-item">'.$row["ISBN"].'</li>
          </ul>
          <div class="card-body">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
            </div>
            ';
    }
       echo "
           </div>
          </div>
        </div>
      </main>";
 } else {
    echo "0 results";
}

$conn->close();

?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>