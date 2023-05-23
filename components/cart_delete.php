<?php
class CartItemDeleter {
    private $conn;
  
    public function __construct($conn) {
      $this->conn = $conn;
    }
  
    public function delete($cartId) {
      $deleteCartItem = $this->conn->prepare("DELETE FROM `cart` WHERE id = ?");
      $deleteCartItem->execute([$cartId]);
      $message[] = 'cart item deleted!';
    }
  }
  
  if (isset($_POST['delete'])) {
    $cartItemDeleter = new CartItemDeleter($conn);
    $cartItemDeleter->delete($_POST['cart_id']);
  }
  

?>