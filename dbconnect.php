<?php


 // this will avoid mysql_connect() deprecation error.

 error_reporting( ~E_DEPRECATED & ~E_NOTICE );

 

 

 define('DBHOST', 'localhost');

 define('DBUSER', 'root');

 define('DBPASS', '');

 define('DBNAME', 'cr10_omar_altayyar_biglibrary');

 

 $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);



 

 if ( !$conn ) {

  die("Connection failed : " . mysqli_error());

 }



 

 


 ?>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </body>
</html>

