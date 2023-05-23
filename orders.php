<?php

include 'components/connect.php';
$database = new Database();
$conn = $database->getConnection();


session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechFusion | Orders </title>
    <link rel="shortcut icon" href="./images/logo.ico" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/customer.css">

</head>
<style>
   .row{
      font-size:1.2rem;
   }
</style>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

   <section class="placed-orders">
<br><br><br>
   <h1 class="title">Your Orders</h1>
   <br><br><br>
   <div class="row">
      <div class="col-md-12 col-md-offset-2">
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>Order ID</th>
                  <th>Customer ID</th>
                  <th>Transaction Date</th>
                  <th>Customer's Name</th>
                  <th>E-mail</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Payment Method</th>
                  <th>Ordered Products</th>
                  <th>Total Price</th>
                  <th>Order Status</th>
               </tr>
            </thead>
          
            <tbody>
               <!--mergesort-->
               <?php
include 'algorithm/mergesort.php';

if ($user_id == '') {
    echo '<p class="empty">please login to see your orders</p>';
} else {
    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
    $select_orders->execute([$user_id]);
    if ($select_orders->rowCount() > 0) {
        $orders = array();
        while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            $orders[] = $fetch_orders;
        }
        $orders = mergeSort($orders);
        
        // Search Function using Linear Search
        include 'algorithm/linearsearch.php';
        
        // Check if a search is performed
        if (isset($_POST['search'])) {
            $searchOrderId = $_POST['searchOrderId'];
            $result = linearSearch($orders, $searchOrderId);
            if ($result) {
                // Display the found order
?>
                <tr>
                    <td><?= $result['id']; ?></td>
                    <td><?= $result['user_id']; ?></td>
                    <td><?= $result['placed_on']; ?></td>
                    <td><?= $result['name']; ?></td>
                    <td><?= $result['email']; ?></td>
                    <td><?= $result['number']; ?></td>
                    <td><?= $result['address']; ?></td>
                    <td><?= $result['method']; ?></td>
                    <td><?= $result['total_products']; ?></td>
                    <td><i class="fa-solid fa-peso-sign"></i><?= $result['total_price']; ?></td>
                    <td>
                        <p>
                            <b>
                                <span style="color:<?php if ($result['payment_status'] == 'pending') { echo 'orange'; } if ($result['payment_status'] == 'cancelled') { echo 'red'; } else { echo 'green'; }; ?>">
                                    <?= $result['payment_status']; ?>
                                </span>
                            </b>
                        </p>
                    </td>
                </tr>
<?php
            } else {
                echo '<p class="empty">Order ID not found!</p>';
            }
        } else {
            // Display all orders
            foreach ($orders as $fetch_orders) {
?>
                <tr>
                    <td><?= $fetch_orders['id']; ?></td>
                    <td><?= $fetch_orders['user_id']; ?></td>
                    <td><?= $fetch_orders['placed_on']; ?></td>
                    <td><?= $fetch_orders['name']; ?></td>
                    <td><?= $fetch_orders['email']; ?></td>
                    <td><?= $fetch_orders['number']; ?></td>
                    <td><?= $fetch_orders['address']; ?></td>
                    <td><?= $fetch_orders['method']; ?></td>
                    <td><?= $fetch_orders['total_products']; ?></td>
                    <td><i class="fa-solid fa-peso-sign"></i><?= $fetch_orders['total_price']; ?></td>
                    <td>
                        <p>
                            <b>
                                <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') { echo 'orange'; } if ($fetch_orders['payment_status'] == 'cancelled') { echo 'red'; } else { echo 'green'; }; ?>">
                                    <?= $fetch_orders['payment_status']; ?>
                                </span>
                            </b>
                        </p>
                    </td>
                </tr>
<?php
            }
        }
?>
        <!-- Search form -->
        <form method="POST">
            <label for="searchOrderId">Search Order ID:</label>
            <input type="text" name="searchOrderId" id="searchOrderId" placeholder="Enter Order ID">
            <button type="submit" name="search">Search</button>
        </form>
<?php
    } else {
        echo '<p class="empty">No orders placed yet!</p>';
    }
}
?>

            </tbody>
            
         </table>
      </div>
   </div>


<!-- custom js file link  -->
<script src="js/customer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<div class="loader">
   <img src="images/he.gif" alt="">
</div>

</body>
</html>