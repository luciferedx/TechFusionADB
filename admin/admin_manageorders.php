<?php

include '../components/connect.php';
$database = new Database();
$conn = $database->getConnection();

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

include '../components/admin_updateStatus.php';

include '../components/admin_deleteOrders.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechFusionADMIN | Manage Orders </title>
   <link rel="shortcut icon" href="../images/logo.ico" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin.css">

</head>
<style>
   .row{
      font-size:1.2rem;
   }
   #update{
      width:100%;
      font-size:1.6rem;
      padding:0.2rem 0.2rem;
   }
   #delete{
      width:100%;
      font-size:1.5rem;
      padding:0.3rem 0.4rem;
      text-decoration:none;
   }
</style>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Manage Orders</h1>
   <div class="row">
      <div class="col-md-12 col-md-offset-2">
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>Customer ID</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Phone</th>
                  <th>Delivery Address</th>
                  <th>Products</th>
                  <th>Total Price</th>
                  <th>Payment Method</th>
                  <th>Order Status</th>
                  <th>Update Status</th>
                  <th></th>
                  <th>Delete Order</th>
                  <th></th>
               </tr>
            </thead>
          
            <tbody>
            <?php
$select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY `placed_on` ASC");
$select_orders->execute();

if ($select_orders->rowCount() > 0) {
    while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><?= $fetch_orders['user_id']; ?></td>
            <td><?= $fetch_orders['placed_on']; ?></td>
            <td><?= $fetch_orders['name']; ?></td>
            <td><?= $fetch_orders['number']; ?></td>
            <td><?= $fetch_orders['address']; ?></td>
            <td><?= $fetch_orders['total_products']; ?></td>
            <td><i class="fa-solid fa-peso-sign"></i><?= $fetch_orders['total_price']; ?></td>
            <td><?= $fetch_orders['method']; ?></td>
            <form action="" method="POST">
                <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                <td>
                    <select name="payment_status" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                        <option value="pending">pending</option>
                        <option value="cancelled">cancelled</option>
                        <option value="completed">completed</option>
                    </select>
                </td>
                <td colspan="2"><input type="submit" value="update" class="btn" name="update_payment" id="update"></td>
                <td colspan="2"><a href="admin_manageorders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" id="delete" onclick="return confirm('delete this order?');">delete</a></td>
            </form>
            <td></td>
        </tr>
        <?php
    }
} else {
    echo '<p class="empty">null</p>';
}
?>

            </tbody>
            
         </table>
      </div>
   </div>
   

</section>
<br><br><br><br><br><br><br><br><br><br><br><br>
<!-- Completed Orders -->
<section class="placed-orders">

   <h1 class="heading text-success">completed Orders</h1>
   <div class="row">
      <div class="col-md-12 col-md-offset-2">
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>Customer Name</th>
                  <th>Products</th>
                  <th>Order Date</th>
               </tr>
            </thead>
          
            <tbody>
               <?php
            $select_orders = $conn->prepare("SELECT a.name AS a, a.total_products AS b, a.placed_on AS c FROM orders AS a INNER JOIN users AS b ON (a.name = b.name) WHERE payment_status = 'completed' ORDER BY a.placed_on ASC");
            $select_orders->execute();

            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <tr>
                        <td><?= $fetch_orders['a']; ?></td>
                        <td><?= $fetch_orders['b']; ?></td>
                        <td><?= $fetch_orders['c']; ?></td>
                  </tr>
                  <?php
               }
            } else {
               echo '<p class="empty">null</p>';
            }
   ?>

            </tbody>
            
         </table>
      </div>
   </div>
   

</section>

<!-- Cancelled Orders -->
<section class="placed-orders">

   <h1 class="heading text-danger">Cancelled Orders</h1>
   <div class="row">
      <div class="col-md-12 col-md-offset-2">
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>Customer Name</th>
                  <th>Products</th>
                  <th>Order Date</th>
               </tr>
            </thead>
          
            <tbody>
            <?php
         $select_orders = $conn->prepare("SELECT a.name AS a, a.total_products AS b, a.placed_on AS c FROM orders AS a INNER JOIN users AS b ON (a.name = b.name) WHERE payment_status = 'cancelled' ORDER BY a.placed_on ASC");
         $select_orders->execute();

         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <tr>
                     <td><?= $fetch_orders['a']; ?></td>
                     <td><?= $fetch_orders['b']; ?></td>
                     <td><?= $fetch_orders['c']; ?></td>
               </tr>
               <?php
            }
         } else {
            echo '<p class="empty">null</p>';
         }
         ?>

            </tbody>
            
         </table>
      </div>
   </div>
   

</section>








<!-- custom js file link  -->
<script src="../js/admin.js"></script>

</body>
</html>