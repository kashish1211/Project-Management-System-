<?php 
include('../functions.php');

if (!isManager()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['manager']);
	header("location: ../login.php");
}


$data_emp1=""; 
$data_emp2="";
$data_emp3="";

$query = "SELECT * FROM users WHERE role='Employee'";
$results1 = mysqli_query($db, $query);
$results2 = mysqli_query($db, $query);
$results3 = mysqli_query($db, $query);

$query_client = "SELECT name FROM clients";
$results_client = mysqli_query($db, $query_client);


$pro_id = $_GET['id'];
$query_pro = "SELECT * FROM projects WHERE id='$pro_id'";
$pro_results = mysqli_query($db, $query_pro);
$data = mysqli_fetch_array($pro_results);


$employee1_id = $data['emp_id1'][0];
$emp1_name = "SELECT * FROM users WHERE role='Employee' AND id='$employee1_id'";
$emp1_result = mysqli_query($db, $emp1_name); 
$data_emp1 = mysqli_fetch_array($emp1_result);


if($data['emp_id2'] != NULL){
  $employee2_id = $data['emp_id2'][0];
  $emp2_name = "SELECT * FROM users WHERE role='Employee' AND id='$employee2_id'";
  $emp2_result = mysqli_query($db, $emp2_name); 
  $data_emp2 = mysqli_fetch_array($emp2_result);

}

if($data['emp_id2'] != NULL){
  $employee3_id = $data['emp_id3'][0];
  $emp3_name = "SELECT * FROM users WHERE role='Employee' AND id='$employee3_id'";
  $emp3_result = mysqli_query($db, $emp3_name); 
  $data_emp3 = mysqli_fetch_array($emp3_result);

}


$client_id = $data['client_id'][0];
$client_name = "SELECT * FROM clients WHERE id='$client_id'";
$client_result = mysqli_query($db, $client_name); 
$data_client = mysqli_fetch_array($client_result);





if(isset($_POST['edit_project_btn']))
{
  
  // global $db, $proname, $errors, $employee_name, $id;
          $id = $pro_id;
          $proname = e($_POST['proname']);
          // $m_id = $_SESSION['manager']['id'];
          $employee_name1 = e($_POST['employee_select1']);
          $employee_name2 = e($_POST['employee_select2']);
          $employee_name3 = e($_POST['employee_select3']);
          $client_name = e($_POST['client_select']);
          $status = e($_POST['status']);

          $q1 = "SELECT id FROM users WHERE username = '$employee_name1' ";
          $q2 = "SELECT id FROM users WHERE username = '$employee_name2' ";
          $q3 = "SELECT id FROM users WHERE username = '$employee_name3' ";
          $q_client = "SELECT id FROM clients WHERE name = '$client_name' ";
          $result1 = mysqli_query($db,$q1);
          $result2 = mysqli_query($db,$q2);
          $result3 = mysqli_query($db,$q3);
          $result_client = mysqli_query($db,$q_client);

          $row1 = mysqli_fetch_array($result1)[0];
          $row2 = mysqli_fetch_array($result2)[0];
          $row3 = mysqli_fetch_array($result3)[0];
          $row_c = mysqli_fetch_array($result_client)[0];

          

          if (empty($proname)) {
              array_push($errors, "Project name is required");
          }

          if (count($errors) == 0){
              $edit = "UPDATE projects SET name = '$proname', emp_id1 = '$row1', emp_id2 = '$row2', emp_id3 = '$row3', client_id = '$row_c', status = '$status' WHERE id = '$id' ";
              mysqli_query($db, $edit);
              // $_SESSION['success']  = "Project Updated successfully!!";
              // $_SESSION['manager']['m_id'] = $m_id;
              header('location: manager_home.php');
            
          }
          
  }



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
    <h4>Edit Project</h4>
    </div>
    
  <div class="container" style="padding: 150px; padding-top: 50px;">
    <form  method="post">

   
    <?php echo display_error(); ?>
    
    
    <div class="form-group">
      <label for="exampleFormControlInput1">Project Name</label>
      <input class="form-control" name="proname" type="text" placeholder="<?php echo $data['name']; ?>" value="<?php echo $data['name']; ?>">
    </div>
    
    <!-- <div class="form-group">
      <label for="exampleFormControlInput1">Confirm Password</label>
      <input class="form-control" type="text"  name="password" placeholder="Enter Password">
    </div> -->


    <?php

      $e1_name = $data_emp1['username'];
      if($data_emp2!="")
      {
        $e2_name = $data_emp2['username'];
      }
      // $e2_name = $data_emp2['username'];
      if($data_emp3!=""){
        $e3_name = $data_emp3['username'];

      }
      
      $client_n = $data_client['name'];
     

    echo "<div class='form-group'>
          <label for='exampleFormControlSelect1'>Select Employee 1</label>
          <select class='form-control' name='employee_select1' id='exampleFormControlSelect1'>
            ";
            
            echo "<option selected='selected' value='".$e1_name."'>".$e1_name."</option>";
            echo "</option>";
            // echo "$emp1_name";
            while($row = mysqli_fetch_array($results1))
        {
            
            echo "<option>";

                

                echo  $row['username'] ;

                echo "</option>";

        }
        echo "</select>";
         echo "</div>"; 



         echo "<div class='form-group'>
          <label for='exampleFormControlSelect1'>Select Employee 2</label>
          <select class='form-control' name='employee_select2' id='exampleFormControlSelect1'>
            ";
            
            echo "<option selected='selected' value='".$e2_name."'>".$e2_name."</option>";
            echo "</option>";
            // echo "$emp_name";
            while($row = mysqli_fetch_array($results2))
        {
            
            echo "<option>";

                

                echo  $row['username'] ;

                echo "</option>";

        }
        echo "</select>";
         echo "</div>";



         echo "<div class='form-group'>
          <label for='exampleFormControlSelect1'>Select Employee 3</label>
          <select class='form-control' name='employee_select3' id='exampleFormControlSelect1'>
            ";
            
            echo "<option selected='selected' value='".$e3_name."'>".$e3_name."</option>";
            echo "</option>";
            // echo "$emp_name";
            while($row = mysqli_fetch_array($results3))
        {
            
            echo "<option>";

                

                echo  $row['username'] ;

                echo "</option>";

        }
        echo "</select>";
         echo "</div>";



         echo "<div class='form-group'>
          <label for='exampleFormControlSelect1'>Select Client</label>
          <select class='form-control' name='client_select' id='exampleFormControlSelect1'>
            ";
            
            echo "<option selected='selected' value='".$client_n."'>".$client_n."</option>";
            echo "</option>";
            // echo "$emp_name";
            while($row = mysqli_fetch_array($results_client))
        {
            
            echo "<option>";

                

                echo  $row['name'] ;

                echo "</option>";

        }
        echo "</select>";
         echo "</div>";
        ?>

<div class="form-group">
            <label for="exampleFormControlSelect1">Choose Status</label>
            <select class="form-control" name="status" id="exampleFormControlSelect1" >
            <?php 

            $curr_status = $data['status'];
            
            
            echo "<option selected='selected' value='".$curr_status."'>".$curr_status."</option>"; ?>
              <option>Active</option>
              <option>Inactive</option>
            </select>
      </div>





    
    <!-- <div class="form-group">
      <label for="exampleFormControlSelect1">Choose Role</label>
      <select class="form-control" name="employee_select" id="exampleFormControlSelect1">
      
      </select>
     
    </div> -->


    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" name="edit_project_btn">Update project</button>
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