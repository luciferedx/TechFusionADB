<?php
class CartUpdate {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function updateQuantity($cartId, $qty) {
    $stmt = $this->conn->prepare("CALL UpdateQuantity(:cartId, :qty)");
    $stmt->bindParam(":cartId", $cartId);
    $stmt->bindParam(":qty", $qty);
    $stmt->execute();
  }
}

if (isset($_POST['update_qty'])) {
  $cart = new CartUpdate($conn);
  $cart->updateQuantity($_POST['cart_id'], $_POST['qty']);
}

  
?>