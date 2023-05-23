<?php

class Order {
    private $conn;
    private $userId;
  
    public function __construct($conn, $userId) {
      $this->conn = $conn;
      $this->userId = $userId;
    }
  
    public function place($name, $number, $email, $method, $address, $totalProducts, $totalPrice) {
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $number = filter_var($number, FILTER_SANITIZE_STRING);
      $email = filter_var($email, FILTER_SANITIZE_STRING);
      $method = filter_var($method, FILTER_SANITIZE_STRING);
      $address = filter_var($address, FILTER_SANITIZE_STRING);
  
      $checkCart = $this->conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $checkCart->execute([$this->userId]);
  
      if ($checkCart->rowCount() > 0) {
        if ($address == '') {
          $message[] = 'please add your address!';
        } else {
          $insertOrder = $this->conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
          $insertOrder->execute([$this->userId, $name, $number, $email, $method, $address, $totalProducts, $totalPrice]);
  
          $deleteCart = $this->conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
          $deleteCart->execute([$this->userId]);
        }
      } else {
        $message[] = 'your cart is empty';
      }
    }
  }
  
  if (isset($_POST['submit'])) {
    $order = new Order($conn, $user_id);
    $order->place($_POST['name'], $_POST['number'], $_POST['email'], $_POST['method'], $_POST['address'], $_POST['total_products'], $_POST['total_price']);
    header('location:home.php');  
  }
  

?>