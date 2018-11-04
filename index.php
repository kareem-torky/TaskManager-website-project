<?php
$dir = getcwd();
require($dir. '/session.php');
require($dir. '/connect.php');
require($dir. '/head.php');
?>

<body>
    
<div class="container">
   <div class="row">
       <div class="col-lg-2"><!-- PlaceHolder --></div>
       <div class="col-lg-8 main-box">
           <h2 class="text-center">Welcome to Task Manager website</h2>
           <p class="text-center">
               <a role="button" class="btn btn-info btn-lg" id="sign-up-btn" href="signup.php">
                   Sign up
               </a>
           </p>
           <br />
           
           <h5  class="text-center">Already have an account ?</h5>
           <p class="text-center">
               <a role="button" class="btn btn-info btn-lg" id="log-in-btn" href="login.php">
                   Log in
               </a>
           </p>           
       </div>
   </div>
</div>

<?php
require($dir. '/closing.php');
?>