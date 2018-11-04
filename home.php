<?php
$dir = getcwd();
require($dir. '/session.php');
require($dir. '/connect.php');

// prevent the user from going to this page without login or signup
if(!isset($_SESSION['username'])){
    header("Location: index.php");
}
// Add To list behaviour
if(isset($_POST['add'])){
  $task = htmlspecialchars($_POST['add']);
  
  $stmt = $db->prepare("INSERT INTO tasks (task, name) VALUES (:task, :name)");
  $stmt->bindParam(':task', $task);
  $stmt->bindParam(':name', $_SESSION['username']);
  $stmt->execute();
  
}

// Delete task
if(isset($_GET['del'])){
  $task_id = $_GET['del'];
  
  $stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
  $stmt->bindParam(':id', $task_id);
  $stmt->execute(); 
  
}

// Clear All behaviour
if(isset($_POST['clear_all'])){
  $stmt = $db->prepare("DELETE FROM tasks WHERE name = :name");
  $stmt->bindParam(':name', $_SESSION['username']);
  $stmt->execute(); 
}

// Display tasks for this user
$stmt = $db->prepare("SELECT id,task,added_at FROM tasks WHERE name = :name");
$stmt->bindParam(':name', $_SESSION['username']);
$stmt->execute();

$user_tasks_ids = array();
$user_tasks = array();
$user_tasks_time = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  $user_tasks_ids[] = $row['id'];
  $user_tasks[] = $row['task'];
  $user_tasks_time[] = $row['added_at'];
}

$tasks_vs_ids = array_combine($user_tasks, $user_tasks_ids);
$tasks_vs_time = array_combine($user_tasks, $user_tasks_time);


// Log Out behaviour
if(isset($_POST['log_out'])){
  session_destroy();
  header("Location: index.php");
}


require($dir. '/head.php');
?>

<body>  
 <div class="container">
    <div class="row">
        <div class="col-lg-2"><!-- PlaceHolder --></div>
        <div class="col-lg-8 main-box">
          <!-- Error message area -->
          <div class="error-msg">
            <p class="text-center"><big><?= $_SESSION['error_msg'] ?></big></p>
          </div>
          
          <!-- Header -->
          <h5 class="text-center"><?php echo("welcome ". $_SESSION['username']); ?></h5>
          
          <!-- Add to list form -->
          <form class="form-inline my-4 my-lg-4" action="home.php" method="post">
            <input class="form-control mr-sm-2" type="search" aria-label="Add" id="add" name="add" required>
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Add to List</button>
          </form>
          
          <!-- Tasks table -->
          <div class="table-box">
           <table class="table table-sm">
               <thead>
                   <tr>
                       <th>Num.</th>
                       <th>Task</th>
                       <th>Added at</th>
                       <th>Delete</th>
                   </tr>
               </thead>
               
               <tbody>
                   
                   <?php
                   
                     $i = 0;
                     foreach( $user_tasks as $user_task ) {
                       $i++;
                       echo("<tr><td>". $i. "</td>");
                       echo("<td>". $user_task. "</td>");
                       
                       $current_task_time = $tasks_vs_time["$user_task"];
                       echo("<td>". $current_task_time. "</td>");
                       
                       $current_task_id = $tasks_vs_ids["$user_task"];
                       echo("<td><a role='button' href='home.php?del=$current_task_id' class='btn btn-sm'>
                                  <b>X</b>
                                 </a></td></tr>");
                     }
                   ?>
               </tbody>
           </table>
          </div>
          
          <!-- Clear All and log Out buttons -->
          <form action="home.php" method="post">
              <p class="text-center">
                <button class="btn btn-info" type="submit" name="clear_all">Clear All</button>
                <button class="btn btn-info" type="submit" name="log_out">Log Out</button>
              </p>
          </form>
        </div>
    </div>
 </div>

<?php
require($dir. '/closing.php');
?>