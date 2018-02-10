
<?php

 ob_start();

 session_start();

 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {

  header("Location: index.php");

  exit;

 }

 // select logged-in users detail




 

 $res=mysqli_query($conn, "SELECT * FROM users where user_id=".$_SESSION['user']);

 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome- <?php echo $userRow['first_name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    
  </head>
  <body>
  	<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="https://www.brainline.com/wp-content/uploads/2017/02/brainline_e-library.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Library
  </a>
  <a id="signout" href="logout.php?logout">Sign Out</a>
</nav>


<div id="wtext">
  <h1>Welocme <?php echo $userRow['first_name']; ?> :) </h1>
</div>

<div class="all">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="home" aria-selected="ALL">All</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#book" role="tab" aria-controls="profile" aria-selected="false">Book</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#dvd" role="tab" aria-controls="contact" aria-selected="false">DVD</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#cd" role="tab" aria-controls="contact" aria-selected="false">CD</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
    
    <?php

$sql1 = "SELECT * FROM media";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
  echo '
  <main role="main" class="main">
    <div class="album py-5 " style="background-color: #fff;">
        <div class="container">
    <div class="row">
          ';

    while($row1 = $result1->fetch_assoc()) {
      echo '
   
       <div class="col-md-4">
             <div class="card">
          <img class="card-img-top" src='.$row1["image"].' alt="Card image cap" width="40px">
          <div class="card-body">
            <h5 class="card-title">'.$row1["title"].'</h5>
            <hr>
            <p class="card-text">"'.$row1["description"].'"</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">'.$row1["fk_author_id"].'</li>
            <li class="list-group-item">'.$row1["type"].'</li>
            <li class="list-group-item">'.$row1["ISBN"].'</li>
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



?>


  </div>
  <div class="tab-pane fade" id="book" role="tabpanel" aria-labelledby="profile-tab">


        <?php

          $sql2 = "SELECT * FROM media WHERE type='book'";
          $result2 = $conn->query($sql2);

          if ($result2->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 " style="background-color: #fff;">
                  <div class="container">
              <div class="row">
                    ';

              while($row2 = $result2->fetch_assoc()) {
                echo '
             
                 <div class="col-md-4">
                       <div class="card">
                    <img class="card-img-top" src='.$row2["image"].' alt="Card image cap" width="40px">
                    <div class="card-body">
                      <h5 class="card-title">'.$row2["title"].'</h5>
                      <p class="card-text">"'.$row2["description"].'"</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">'.$row2["fk_author_id"].'</li>
                      <li class="list-group-item">'.$row2["type"].'</li>
                      <li class="list-group-item">'.$row2["ISBN"].'</li>
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

          

          ?>
    
  </div>
  <div class="tab-pane fade" id="cd" role="tabpanel" aria-labelledby="contact-tab">
        <?php

          $sql3 = "SELECT * FROM media WHERE type='cd'";
          $result3 = $conn->query($sql3);

          if ($result3->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 " style="background-color: #fff;">
                  <div class="container">
              <div class="row">
                    ';

              while($row3 = $result3->fetch_assoc()) {
                echo '
             
                 <div class="col-md-4">
                       <div class="card">
                    <img class="card-img-top" src='.$row3["image"].' alt="Card image cap" width="40px">
                    <div class="card-body">
                      <h5 class="card-title">'.$row3["title"].'</h5>
                      <p class="card-text">"'.$row3["description"].'"</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">'.$row3["fk_author_id"].'</li>
                      <li class="list-group-item">'.$row3["type"].'</li>
                      <li class="list-group-item">'.$row3["ISBN"].'</li>
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

          ?>






  </div>
  <div class="tab-pane fade" id="dvd" role="tabpanel" aria-labelledby="contact-tab">
     <?php

          $sql4 = "SELECT * FROM media WHERE type='dvd'";
          $result4 = $conn->query($sql4);

          if ($result4->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 " style="background-color: #fff;">
                  <div class="container">
              <div class="row">
                    ';

              while($row4 = $result4->fetch_assoc()) {
                echo '
             
                 <div class="col-md-4">
                       <div class="card">
                    <img class="card-img-top" src='.$row4["image"].' alt="Card image cap" width="40px">
                    <div class="card-body">
                      <h5 class="card-title">'.$row4["title"].'</h5>
                      <p class="card-text">"'.$row4["description"].'"</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">'.$row4["fk_author_id"].'</li>
                      <li class="list-group-item">'.$row4["type"].'</li>
                      <li class="list-group-item">'.$row4["ISBN"].'</li>
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

          ?>




  </div>
</div>
</div>
    




           

             

           

   

         

   

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php ob_end_flush(); ?>