<?php

class AddressUpdater {
   private $conn;
   private $userId;
 
   public function __construct($conn, $userId) {
     $this->conn = $conn;
     $this->userId = $userId;
   }
 
   public function update($lotBlock, $phaseBarangay, $city, $region, $zipCode) {
     $address = "$lotBlock, $phaseBarangay, $city, $region, $zipCode";
     $address = filter_var($address, FILTER_SANITIZE_STRING);
 
     $updateAddress = $this->conn->prepare("START TRANSACTION;

     UPDATE `users` SET address = ? WHERE id = ?;
     
     IF ROW_COUNT() = 1 THEN
         COMMIT;
         SELECT 'Update successful!';
     ELSE
         ROLLBACK;
         SELECT 'Update failed!';
     END IF;");
     $updateAddress->execute([$address, $this->userId]);
   }
 }
 
 if (isset($_POST['submit'])) {
   $addressUpdater = new AddressUpdater($conn, $user_id);
   $addressUpdater->update($_POST['LotBlock'], $_POST['PhaseBarangay'], $_POST['City'], $_POST['region'], $_POST['ZipCode']);
   header('location:home.php');
 }

?>