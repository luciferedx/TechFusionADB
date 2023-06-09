<?php
class UserSignUp {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function signUp($name, $email, $number, $pass, $cpass) {
    try {
      // Begin a transaction
      $this->conn->beginTransaction();

      // Prepare the statement
      $stmt = $this->conn->prepare("CALL RegUser(:name, :email, :number, :pass, :cpass)");

      // Bind the named parameters
      $stmt->bindParam(":name", $name);
      $stmt->bindParam(":email", $email);
      $stmt->bindParam(":number", $number);
      $stmt->bindParam(":pass", $pass);
      $stmt->bindParam(":cpass", $cpass);

      // Set the parameter values
      $name = $_POST['name'];
      $email = $_POST['email'];
      $number = $_POST['number'];
      $pass = $_POST['pass'];
      $cpass = $_POST['cpass'];

      // Execute the statement
      $stmt->execute();

      // Fetch the result
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Close the statement
      $stmt->closeCursor();

      // Check if a user was inserted
      if (count($result) > 0) {
        // Commit the transaction
        $this->conn->commit();

        $_SESSION['user_id'] = $result[0]['id'];
        header('location: home.php');
      } else {
        // Rollback the transaction
        $this->conn->rollback();

        echo "Failed to sign up. Please try again.";
      }
    } catch (PDOException $e) {
      // Rollback the transaction on exception
      $this->conn->rollback();

      echo "An error occurred: " . $e->getMessage();
    }
  }
}

if (isset($_POST['submit'])) {
  $userSignUp = new UserSignUp($conn);
  $userSignUp->signUp($_POST['name'], $_POST['email'], $_POST['number'], $_POST['pass'], $_POST['cpass']);
}
?>
