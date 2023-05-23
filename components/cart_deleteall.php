<?php
class CartDeleteAll {
    private $conn;
    private $userId;
  
    public function __construct($conn, $userId) {
      $this->conn = $conn;
      $this->userId = $userId;
    }
  
    public function deleteAll() {
      $deleteCartItem = $this->conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $deleteCartItem->execute([$this->userId]);
      $message[] = 'deleted all from cart!';
    }
  }
  
  if (isset($_POST['delete_all'])) {
    $cart = new CartDeleteAll($conn, $user_id);
    $cart->deleteAll();
  }
  
?>