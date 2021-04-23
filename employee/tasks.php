<?php 
include('../functions.php');

if (!isLoggedInUser()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['employee']);
	header("location: ../login.php");
}

$curr_empid = $_SESSION['employee']['id'];

$query = "SELECT * FROM projects WHERE emp_id1 = '$curr_empid' OR emp_id2='$curr_empid' OR emp_id3='$curr_empid'";
$result_projects = mysqli_query($db, $query);



// $query_client = "SELECT name FROM clients";
// $result_client = mysqli_query($db, $query_client);


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Project Management System</title>
  </head>
  <body>
    <div style="text-align: center; padding-top: 100px;" class="container">
    <h1>Project Management System</h1>
    <h4>Create Task</h4>
    </div>
    
  <div class="container" style="padding: 150px; padding-top: 50px;">
    <form action="tasks.php" method="post">

   
    <?php echo display_error(); ?>
    
    
    <div class="form-group">
      <label for="exampleFormControlInput1">Task Name</label>
      <input class="form-control" name="taskname" type="text" placeholder="Enter task name" value="<?php echo $taskname; ?>">
    </div>
    
    <!-- <div class="form-group">
      <label for="exampleFormControlInput1">Confirm Password</label>
      <input class="form-control" type="text"  name="password" placeholder="Enter Password">
    </div> -->


    <?php

    echo "<div class='form-group'>
          <label for='exampleFormControlSelect1'>Choose Employee 1</label>
          <select class='form-control' name='project_name' id='exampleFormControlSelect1'>
            ";
            while($row = mysqli_fetch_array($result_projects))
        {
            echo "<option>";

                

                echo  $row['name'] ;

                echo "</option>";

        }
        echo "</select>";
         echo "</div>"; 
        //  echo "$results";
        ?>


    

      <div class="form-group">
            <label for="exampleFormControlSelect1">Choose Task Status</label>
            <select class="form-control" name="task_status" id="exampleFormControlSelect1">
              <option>Complete</option>
              <option>Incomplete</option>
            </select>
      </div>





    
    <!-- <div class="form-group">
      <label for="exampleFormControlSelect1">Choose Role</label>
      <select class="form-control" name="employee_select" id="exampleFormControlSelect1">
      
      </select>
     
    </div> -->


    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" name="task_btn">Create Task</button>
      </div>
    </div>
    <!-- <div class="form-group row">
      <div class="col-sm-10">
      <p>Not a member? <a href="register.php" class="btn btn-primary">Sign In</a></p>
      </div>
    </div> -->

   
    
  </form>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>