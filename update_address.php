<?php

include 'components/connect.php';
$database = new Database();
$conn = $database->getConnection();

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

include 'components/address_update.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FreakFood | Update Address </title>
   <link rel="shortcut icon" href="./images/logo.ico" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/customer.css">

</head>

<body>
   <!-- header section starts  -->
   <?php include 'components/user_header.php' ?>
   <!-- header section end  -->

   <section class="form-container">

      <form action="" method="post">
         <h3>your address</h3>
         <input type="text" class="box" placeholder="Lot, Block" required maxlength="50" name="LotBlock">
         <input type="text" class="box" placeholder="Phase, Barangay" required maxlength="50" name="PhaseBarangay">
         <input type="text" class="box" placeholder="City/Municipality" required maxlength="50" name="City">
         <input type="text" class="box" placeholder="Region" required maxlength="2" name="region">
         <input type="number" class="box" placeholder="Zip Code" required max="999999" min="0" maxlength="6" name="ZipCode">
         <input type="submit" value="save address" name="submit" class="btn" id="updt" style="color:white">
      </form>

   </section>



   <!-- custom js file link  -->
   <script src="js/customer.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

   <div class="loader">
      <img src="images/he.gif" alt="">
   </div>
</body>

</html>