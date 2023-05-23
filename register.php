<?php

include 'components/connect.php';
$database = new Database();
$conn = $database->getConnection();

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/register_user.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FreakFood | Register </title>
   <link rel="shortcut icon" href="./images/logo.ico" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/customer.css">

</head>

<body style="background:url(images/wallpaper.jpg);background-repeat:no-repeat;background-size:100%;">
   <br><br><br><br><br><br>
   <section class="form-container">

      <form action="" method="post" id="formregister">
         <h3 style="color:white">Register <span id="in">Now</span></h3>
         <input type="text" name="name" required placeholder="enter your name" class="box" maxlength="50">
         <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="number" name="number" required placeholder="enter your number" class="box" min="0" max="9999999999" maxlength="10">
         <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="register now" name="submit" class="btn" id="updt" style="color:white">
         <p>already have an account? <a href="login.php" style="color:white">login now</a></p>
      </form>

   </section>



   <!--js-->
   <script src="js/customer.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


</body>

</html>