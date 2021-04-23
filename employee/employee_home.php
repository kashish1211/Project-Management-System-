<?php 
	include('../functions.php');
    if (!isLoggedInUser()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['employee']);
        header("location: ../login.php");
    }

    $eid = $_SESSION['employee']['id'];
    $query = "SELECT * FROM projects WHERE emp_id1='$eid' OR emp_id2 = '$eid' OR emp_id3 = '$eid'";
    $results = mysqli_query($db, $query);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tasks.php">Create Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="view_tasks.php">View Your Tasks</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- <h5 class="card-title">Special title treatment</h5> -->
                <p class="card-text">
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="error success" >
                            <h3>
                                <?php 
                                    echo $_SESSION['success']; 
                                    unset($_SESSION['success']);
                                ?>
                            </h3>
                        </div>
                    <?php endif ?>
                </p>
                <?php  if (isset($_SESSION['employee'])) : ?>
					<strong><?php echo $_SESSION['employee']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['employee']['role']); ?>)</i> 
						<br>
						<a href="employee_home.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
                
            </div>
        </div>


        <?php
        echo "<table class='table table-hover'>
        <thead>
            <tr>
            <th scope='col'>Serial Number</th>
            <th scope='col'>Project Name</th>
            <th scope='col'>Assigned Manager</th>
            
            </tr>
        </thead>";
        while($row = mysqli_fetch_array($results))
        {
            $manager_id = $row['m_id'];
            $q = "SELECT username from users WHERE id='$manager_id' ";
            $manager_name = mysqli_query($db,$q);
            $m_name = mysqli_fetch_array($manager_name);
            echo "<tbody>";

                echo "<tr>";

                echo "<td>" . $row['id'] . "</td>";

                echo "<td>" . $row['name'] . "</td>";

                echo "<td>" . $m_name['username'] . "</td>";

                // echo "<td>" . $row['email'] . "</td>";

                echo "</tr>";
           echo "</tbody>"; 

        }

echo "</table>";
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>