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

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFusion | Search</title>
    <link rel="shortcut icon" href="./images/logo.ico" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/customer.css">

</head>

<body>

    <!-- header section starts  -->
    <?php include 'components/user_header.php'; ?>
    <!-- header section ends -->

    <!-- search form section starts  -->

    <section class="search-form">
        <form method="post" action="">
            <input type="text" name="search_box" placeholder="search here..." class="box">
            <button type="submit" name="search_btn" class="fas fa-search"></button>
        </form>
    </section>

    <!-- search form section ends -->


    <section class="products" style="min-height: 100vh; padding-top:0;">

        <div class="box-container">

            <?php
            if (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
                $search_box = $_POST['search_box'];

                $search_term = '%' . $search_box . '%';
                $select_products = $conn->prepare("CALL search_products(?)");
                $select_products->bindParam(1, $search_term);

                $select_products->execute();
                $found = false;
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    $name = $fetch_products['name'];
                    if (stripos($name, $search_box) !== false) {
                        $found = true;
                        ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                            <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                            <a href="category.php?category=<?= $fetch_products['category']; ?>"
                                class="cat"><?= $fetch_products['category']; ?></a>
                            <div class="name"><?= $fetch_products['name']; ?></div>
                            <div class="flex">
                                <div class="price"><span><i class="fa-solid fa-peso-sign"></i></span><?= $fetch_products['price']; ?></div>
                                <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                            </div>
                        </form>
            <?php
                    }
                }
                if (!$found) {
                    echo '<p class="empty">no products added yet!</p>';
                }
            }
            ?>



        </div>

    </section>

    <!-- custom js file link  -->
    <script src="js/customer.js"></script>

</body>

</html>
