<?php

include '../components/connect.php';
$database = new Database();
$conn = $database->getConnection();



session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechFusionADMIN | Dashboard </title>
    <link rel="shortcut icon" href="../images/logo.ico" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body style="background:url(gear..jpg);background-repeat:no-repeat;background-size:cover"> 

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">TechBoard</h1>

   <div class="box-container">

 <br><br>
   <div class="row">
   <div class="box container-fluid col-md-5">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <h3><i class="fa-solid fa-cart-shopping"></i> <?= $numbers_of_orders; ?></h3>
      <p style="color:black">Total Orders</p>
      <a href="admin_manageorders.php" class="btn">View <br> orders </a>
   </div> <br><br>

   <div class="box container-fluid col-md-5">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><i class="fa-solid fa-desktop"></i> <?= $numbers_of_products; ?></h3>
      <p style="color:black">Total Products</p>
      <a href="admin_manageproducts.php" class="btn">View <br> Products</a>
   </div><br><br>

   <div class="box container-fluid col-md-5">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><i class="fa-solid fa-user"></i>&nbsp;<?= $numbers_of_users; ?></h3>
      <p style="color:black">Total Users</p>
      <a href="admin_Cusaccounts.php" class="btn">View <br> Users</a>
   </div><br><br>
   
   <div class="box container-fluid col-md-5">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         }
      ?>
      <h3><i class="fa-solid fa-peso-sign"></i> <?= $total_pendings; ?><span>/-</span></h3>
      <p style="color:black">Pending Orders</p>
      <a href="Admin_manageorders.php" class="btn">View Pending <br> Orders</a>
   </div>
   </div>
   

   

   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom js file link  -->
<script src="../js/admin.js"></script>

</body>
</html>