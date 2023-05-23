<?php

include '../components/connect.php';
$database = new Database();
$conn = $database->getConnection();

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

include '../components/admin_userManage.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechFusionADMIN | Customer Accounts </title>
   <link rel="shortcut icon" href="../images/logo.ico" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- user accounts section starts  -->

   <section class="accounts">

      <h1 class="heading">Customer Accounts</h1>

      <div class="box-container">

         <?php
         $select_account = $conn->prepare("SELECT * FROM `users`");
         $select_account->execute();
         if ($select_account->rowCount() > 0) {
            while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="row">

                  <div class="box container-fluid col-md-" id="userBox">


                     <h3>Customer ID : <span><?= $fetch_accounts['id']; ?></span> </h3>
                     <h3>Customer Name : <span><?= $fetch_accounts['name']; ?></span> </h3>
                     <h3>Customer Phone : <span><?= $fetch_accounts['number']; ?></span> </h3>
                     <h3>Customer Address : <span><?= $fetch_accounts['address']; ?></span> </h3>
                     <h3>Customer E-mail : <span><?= $fetch_accounts['email']; ?></span> </h3>
                  </div>
                  <a href="admin_Cusaccounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('delete this account?');">delete</a>
                  <br><br>
            <?php
            }
         } else {
            echo '<p class="empty">no accounts available</p>';
         }
            ?>

               </div>
      </div>

   </section>

   <!-- user accounts section ends -->







   <!-- custom js file link  -->
   <script src="../js/admin.js"></script>

</body>

</html>