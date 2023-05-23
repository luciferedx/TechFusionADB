
<header class="header">

   <section class="flex">

      <a href="home.php" class="logo" id="logo"  style="text-decoration:none"><i class="fa-regular fa-microchip"></i> TechFusion</a>
      <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>

      <nav class="navbar" id="hed">
         <a href="home.php" style="text-decoration:none">Home</a>
         <a href="home.php#about" style="text-decoration:none">About</a>
         <a href="menu.php" style="text-decoration:none">Parts</a>
         <a href="orders.php" style="text-decoration:none">Orders</a>
         <a href="cart.php"  style="text-decoration:none"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
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
            <a href="profile.php" class="btn" id="loginow" style="color:white;">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn" id="loginow" style="text-decoration:none">logout</a>
         </div>
         <?php
            }else{
         ?>
            <p class="name">Please login first!</p>
            <a href="login.php" class="btn" id="loginsa">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>

