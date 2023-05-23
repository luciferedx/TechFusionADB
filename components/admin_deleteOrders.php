<?php
class DeleteOrder {
    private $conn;
  
    public function __construct($conn) {
      $this->conn = $conn;
    }
  
    public function delete($orderId) {
      $deleteOrder = $this->conn->prepare("DELETE FROM `orders` WHERE id = ?");
      $deleteOrder->execute([$orderId]);
      header('location:admin_manageorders.php');
    }
  }
  
  if (isset($_GET['delete'])) {
    $order = new DeleteOrder($conn);
    $order->delete($_GET['delete']);
  }
  

?>