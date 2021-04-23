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
    
<?php 
    session_start();

    // connect to database
    $db = mysqli_connect('localhost:3308', 'root', '', 'pms');

    // variable declaration
    $username = "";
    $email    = "";
    $errors   = array(); 

    // call the register() function if register_btn is clicked
    if (isset($_POST['register_btn'])) {
        register();
    }

    // REGISTER USER
    function register(){
        // call these variables with the global keyword to make them available in function
        global $db, $errors, $username, $email;

        // receive all input values from the form. Call the e() function
        // defined below to escape form values
        $username    =  e($_POST['username']);
        $email       =  e($_POST['email']);
        $password1  =  e($_POST['password1']);
        $password2  =  e($_POST['password2']);

        // form validation: ensure that the form is correctly filled
        if (empty($username)) { 
            array_push($errors, "Username is required"); 
        }
        if (empty($email)) { 
            array_push($errors, "Email is required"); 
        }
        if (empty($password1)) { 
            array_push($errors, "Password is required"); 
        }
        if ($password1 != $password2) {
            array_push($errors, "The two passwords do not match");
        }

        // register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = $password1;//encrypt the password before saving in the database later add md5(...)

            if ($_POST['role'] == 'Manager') {
                $role = e($_POST['role']);
                $query = "INSERT INTO users (username, email, password ,role ) 
                        VALUES('$username', '$email', '$password', 'Manager')";
                echo $query;
                mysqli_query($db, $query);

                $logged_in_manager_id = mysqli_insert_id($db);
                echo $logged_in_manager_id;

                $_SESSION['manager'] = getManagerById($logged_in_manager_id);
                $_SESSION['success']  = "Welcome Manager";
                header('location: manager/manager_home.php');
            }else{
                $query = "INSERT INTO users (username, email, password ,role ) 
                        VALUES('$username', '$email', '$password', 'Employee')";
                mysqli_query($db, $query);

                // get id of the created user
                $logged_in_employee_id = mysqli_insert_id($db);

                $_SESSION['employee'] = getEmployeeById($logged_in_employee_id); // put logged in user in session
                $_SESSION['success']  = "Welcome Employee";
                header('location: employee/employee_home.php');				
            }
        }
    }

    // return user array from their id
    function getManagerById($id){
        global $db;
        $query = "SELECT * FROM users WHERE id=" . $id;
        $result = mysqli_query($db, $query);

        $manager = mysqli_fetch_assoc($result);
        return $manager;
    }

    function getEmployeeById($id){
        global $db;
        $query = "SELECT * FROM users WHERE id=" . $id;
        $result = mysqli_query($db, $query);

        $employee = mysqli_fetch_assoc($result);
        return $employee;
    }

    // escape string
    function e($val){
        global $db;
        return mysqli_real_escape_string($db, trim($val));
    }

    function display_error() {
        global $errors;

        if (count($errors) > 0){
            echo '<div class="alert alert-danger" role="alert">';
                foreach ($errors as $error){
                    echo $error .'<br>';
                }
            echo '</div>';
        }
    }



    if (isset($_POST['login_btn'])) {
        login();
    }

    // LOGIN USER
    function login(){
        global $db, $username, $errors;

        // grap form values
        $username = e($_POST['username']);
        $password = e($_POST['password']);

        // make sure form is filled properly
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        // attempt login if no errors on form
        if (count($errors) == 0) {
            $password = $password;

            $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
            $results = mysqli_query($db, $query);

            if (mysqli_num_rows($results) == 1) { // user found
                // check if user is admin or user
                $logged_in_user = mysqli_fetch_assoc($results);
                if ($logged_in_user['role'] == 'Manager') {

                    $_SESSION['manager'] = $logged_in_user;
                    $_SESSION['success']  = "You are now logged in";
                    header('location: manager/manager_home.php');		  
                }else{
                    $_SESSION['employee'] = $logged_in_user;
                    $_SESSION['success']  = "You are now logged in";

                    header('location: employee/employee_home.php');
                }
            }else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }



    function isLoggedInUser()
    {
        if (isset($_SESSION['employee'])) {
            return true;
        }else{
            return false;
        }
    }

    function isLoggedInManager()
    {
        if (isset($_SESSION['manager'])) {
            
            return true;
        }else{
            return false;
        }
    }


    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        unset($_SESSION['manager']);
        header("location: login.php");
    }

    function isManager()
    {
        if (isset($_SESSION['manager']) && $_SESSION['manager']['role'] == 'Manager' )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    if (isset($_POST['project_btn'])) {
        createProject();
    }

    

    $proname = "";
    
    function createProject()
    {
        global $db, $proname, $errors, $employee_name1, $employee_name2, $employee_name3;

        $proname = e($_POST['proname']);
	    $m_id = $_SESSION['manager']['id'];
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
            $query = "INSERT INTO projects (name, m_id, emp_id1, emp_id2, emp_id3, client_id, status) 
					  VALUES('$proname','$m_id','$row1','$row2','$row3', '$row_c', '$status')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New project successfully created!!";
            $_SESSION['manager']['m_id'] = $m_id;
			header('location: manager_home.php');
        }
     

    }



    if (isset($_POST['client_btn'])) {
        createClient();
    }

    

    $clientname = "";
    $indname = "";
    $website = "";
    $address = "";
    
    function createClient()
    {
        global $db, $clientname, $errors, $indname, $website, $address, $m_id;

        $clientname = e($_POST['clientname']);
	    $m_id = $_SESSION['manager']['id'];
        $indname = e($_POST['indname']);
        $address = e($_POST['address']);
        $website = e($_POST['website']);

        // $q = "SELECT id FROM users WHERE username = '$employee_name' ";
        // $result = mysqli_query($db,$q);

        // $row = mysqli_fetch_array($result)[0];

        if (empty($clientname)) {
            array_push($errors, "Client name is required");
        }

        if (count($errors) == 0){
            $query = "INSERT INTO clients (name, industry, address, website, m_id) 
					  VALUES('$clientname','$indname','$address', '$website', '$m_id')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New Client successfully created!!";
            $_SESSION['manager']['m_id'] = $m_id;
			header('location: manager_home.php');
        }
     

    }




    if (isset($_POST['task_btn'])) {
        createTask();
    }

    $taskname = "";
    
    function createTask()
    {
        global $db, $taskname, $errors, $emp_id, $task_status, $project_name;

        $taskname = e($_POST['taskname']);
	    $emp_id = $_SESSION['employee']['id'];
        $project_name = e($_POST['project_name']);
        $task_status = e($_POST['task_status']);

        $q1 = "SELECT id FROM projects WHERE name = '$project_name' ";
        
        $result1 = mysqli_query($db,$q1);
       
        $row1 = mysqli_fetch_array($result1)[0];
       

        if (empty($taskname)) {
            array_push($errors, "Task name is required");
        }

        if (count($errors) == 0){
            $query = "INSERT INTO tasks (name, project_id, emp_id, status) 
					  VALUES('$taskname','$row1','$emp_id', '$task_status')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New Task successfully created!!";
            $_SESSION['employee']['m_id'] = $emp_id;
			header('location: employee_home.php');
        }
     

    }



    



    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>









