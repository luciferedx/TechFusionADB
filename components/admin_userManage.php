<?php
class DeleteUser {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function delete($userId) {
    $stmt = $this->conn->prepare("CALL DeleteUser(:userId)");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    header('location:admin_Cusaccounts.php');
  }
}

if (isset($_GET['delete'])) {
  $user = new DeleteUser($conn);
  $user->delete($_GET['delete']);
}

?>