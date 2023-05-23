
<header class="header">

   <section class="flex">

      <a href="home.php" class="logo" id="logo"><i class="fa-regular fa-microchip"></i>TechFusion</a>
      <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="menu.php">Menu</a>
         <a href="orders.php">Orders</a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
      </nav>

      <div class="icons">
         
         <a href="search.php"><i class="fas fa-search"></i></a>
         
         <div id="user-btn" class="fa-solid fa-user-lock"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile" id="pro">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name">Customer ID : # <?= $fetch_profile['id']; ?></p>
         <p class="name">Customer Name : <?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn" id="loginow" style="color:white">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn" id="loginow">logout</a>
         </div>
         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>



<section class="placed-orders">

   <h1 class="heading">Your Orders</h1>
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
            <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
               <tr>
               <td><?= $fetch_orders['id'];?></td>
               <td><?= $fetch_orders['user_id'];?></td>
               <td><?= $fetch_orders['placed_on']; ?></td>
               <td><?= $fetch_orders['name']; ?></td>
               <td><?= $fetch_orders['email']; ?></td>
               <td><?= $fetch_orders['number']; ?></td>
               <td><?= $fetch_orders['address']; ?></td>
               <td><?= $fetch_orders['method']; ?></td>
               <td><?= $fetch_orders['total_products']; ?></td>
               <td><i class="fa-solid fa-peso-sign"></i><?= $fetch_orders['total_price']; ?></td>
               <td><p>Payment Status : <b><span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'orange'; }if($fetch_orders['payment_status'] == 'cancelled'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </b></p></td>
               </form>
               <td></td>
               </tr>
               <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>
            </tbody>
            
         </table>
      </div>
   </div>