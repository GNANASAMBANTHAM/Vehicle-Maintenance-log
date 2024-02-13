<!-- index2 page -->

<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="index.css">
      <!-- <link rel="icon" type="image" href="car2.png"> -->
      <title>Home Page</title>
   </head>
   <style>
      .login-box a.exit-link {
      position: absolute;
      bottom: 10px;
      right: 10px;
      display: inline-block;
      }
      .login-box a.exit-link img {
      width: 30px;  /* Adjust the width as needed */
      height: 30px; /* Adjust the height as needed */
      }
   </style>
   <body>
      <div class="login-box">
         <h2>Santro TN10H7713</h2>
         <form action="">
            <a href="fuel/fuel.php">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Fuel Details
            </a>
            <br><br>
            <a href="repair/repair.php">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Repair Details
            </a>
         </form>
         <br>
         <a href="index.php" class="exit-link">
         <img src="logout.png" alt="Exit">
         </a>
      </div>
   </body>
</html>