<?php
class OrderStatus {
    private $conn;
  
    public function __construct($conn) {
      $this->conn = $conn;
    }
  
    public function updatePaymentStatus($orderId, $paymentStatus) {
      $updateStatus = $this->conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
      $updateStatus->execute([$paymentStatus, $orderId]);
    }
  }
  
  if (isset($_POST['update_payment'])) {
    $order = new OrderStatus($conn);
    $order->updatePaymentStatus($_POST['order_id'], $_POST['payment_status']);
  }
  

?>