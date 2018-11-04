<?php
$dir = getcwd();
require($dir. '/session.php');
require($dir. '/connect.php');

if(isset($_POST['username']) && isset($_POST['password'])) {
  
  $username = htmlspecialchars($_POST['username']);
  $password = $_POST['password'];
  
  // Fetch data for this username from database
  $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $fetched_username = $row['username'];
    $fetched_password = $row['password'];
  }
  
  // check if this username exists, and if the password is correct
  if(!isset($fetched_username)){
    $_SESSION['error_msg'] = 'username is not correct !';
  } else if (isset($fetched_password) && !password_verify($password, $fetched_password)){
    $_SESSION['error_msg'] = 'password is not correct';
  } else {
    $_SESSION['username'] = $username;  
    header('Location: home.php');
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
         
         <form id="log-in-form" name="log-in-form" action="login.php" method="post">
           <div class="form-group">
             <label for="username">Username :</label>
             <input type="text" class="form-control" id="username" name="username" required>
           </div>
           
           <div class="form-group">
             <label for="pass">Password :</label>
             <input type="password" class="form-control" id="password" name="password" required>
           </div>
           
           <br />
           <p class="text-center">
             <button type="submit" class="btn btn-info btn-lg">Log In</button>
           </p>
         </form>                      
       </div>
   </div>
</div>



<?php
require($dir. '/closing.php');
?>