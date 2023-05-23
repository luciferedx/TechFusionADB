

<header class="header">
<link rel="stylesheet" href="../css/admin.css">

   <section class="flex">
   <a href="admin_dashboard.php" class="logo" id="logo" style="text-decoration: none"><i class="fa-solid fa-microchip"></i>TechFusion <span>ADMIN</span></a>
      

      <nav class="navbar" >
         
         <a href="admin_dashboard.php" style="text-decoration: none">Dashboard</a>
         <a href="admin_manageproducts.php" style="text-decoration: none">Products</a>
         <a href="admin_manageorders.php" style="text-decoration: none">Orders</a>
         <a href="admin_Cusaccounts.php" style="text-decoration: none">Users</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" ><i class="fa-solid fa-user-shield"></i></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <div class="flex-btn">
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>