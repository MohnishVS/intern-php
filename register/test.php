<?php 
  include('config.php');
    $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":username", $param_username);
    $stmt->bindParam(":email", $param_email);
    $stmt->bindParam(":password", $param_password);
                        
    $param_username = "gnani";
    $param_email = "gnani@gmail.com";
    $param_password = "1234";
    $stmt->execute();
?>