<?php

$dir = getcwd();
require($dir. '/session.php');
require($dir. '/connect.php');

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm-password'])) {
  
  $username = htmlspecialchars($_POST['username']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];
  
  // Checking the username here
  $stmt = $db->prepare("SELECT COUNT(username) FROM users WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  
  $result = $stmt->fetchAll(PDO::FETCH_NUM);
  
  if($result[0][0] == '1') {
   $_SESSION['error_msg'] = "This username is already used, Try another one";
  } else {
   
    if($password != $confirm_password){
      $_SESSION['error_msg'] = "Passwords are not matched";
    } else {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
      
      $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $hashed_password);
      $stmt->execute();
      
      $_SESSION['username'] = $username; 
      header('Location: home.php');      
    }
  }  
}

require($dir. '/head.php');
?>

<body>   
<div class="container">
   <div class="row">
       <div class="col-lg-2"><!-- PlaceHolder --></div>
       <div class="col-lg-8 main-box">
         <div class="error-msg">
            <p class="text-center"><big><?= $_SESSION['error_msg'] ?></big></p>
         </div>
         
         <form id="sign-up-form" name="sign-up-form" action="signup.php" method="post">
           <div class="form-group">
             <label for="username">Username :</label>
             <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" maxlength="20" required>
           </div>
           
           <div class="form-group">
             <label for="signup-pass">Password :</label>
             <input type="password" class="form-control" id="password" name="password" maxlength="20" required>
           </div>
           
           <div class="form-group">
             <label for="signup-confirm-pass">Confirm password :</label>
             <input type="password" class="form-control" id="confirm-password" name="confirm-password" maxlength="20" required>
           </div>
         
           <br />
           <p class="text-center">
             <button type="submit" class="btn btn-info btn-lg">Sign Up</button>
           </p>
         </form>       
       </div>
   </div>
</div>

<?php
require($dir. '/closing.php');
?>