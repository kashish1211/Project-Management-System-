<?php 
	include('../functions.php');
    
    if (!isLoggedInManager()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['manager']);
        header("location: ../login.php");
    }
    $mid = $_SESSION['manager']['id'];
    $query = "SELECT * FROM projects WHERE m_id='$mid'";
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
                    <a class="nav-link" href="project.php">Create Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clients.php">Add new Client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_home.php?logout='1'" style="color: red;">Logout</a>
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
                <?php  if (isset($_SESSION['manager'])) : ?>
					<strong><?php echo $_SESSION['manager']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['manager']['role']); ?>)</i> 
						<br>
						
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
            <th scope='col'>Employee 1</th>
            <th scope='col'>Employee 2</th>
            <th scope='col'>Employee 3</th>
            <th scope='col'>Client</th>
            <th scope='col'>Status</th>
            
            </tr>
        </thead>";
        while($row = mysqli_fetch_array($results))
        {
            $pro_id = $row['id'];
            $employee2 = "";
            $employee3 = "";

            $client_id = $row['client_id'];
            $q = "SELECT name from clients WHERE id='$client_id' ";
            $client_name = mysqli_query($db,$q);
            $c_name = mysqli_fetch_array($client_name);

            $emp1_id = $row['emp_id1'];
            $q1 = "SELECT username from users WHERE id='$emp1_id' ";
            $emp1_name = mysqli_query($db,$q1);
            $e1_name = mysqli_fetch_array($emp1_name);

            if($row['emp_id2'] != 0){
                $emp2_id = $row['emp_id2'];
                $q2 = "SELECT username from users WHERE id='$emp2_id' ";
                $emp2_name = mysqli_query($db,$q2);
                $e2_name = mysqli_fetch_array($emp2_name);
                $employee2 = $e2_name['username'];
                
            }
            
            if($row['emp_id3'] != 0){
                $emp3_id = $row['emp_id3'];
                $q3 = "SELECT username from users WHERE id='$emp3_id' ";
                $emp3_name = mysqli_query($db,$q3);
                $e3_name = mysqli_fetch_array($emp3_name);
                $employee3 = $e3_name['username'];
            }
            
            if($employee3 == "")
            {
                $employee3 = '-';
            }

            if($employee2 == "")
            {
                $employee2 = '-';
            }

            echo "<tbody>";

                echo "<tr>";

                echo "<td>" . $row['id'] . "</td>";

                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $e1_name['username'] . "</td>";
                echo "<td>" . $employee2 . "</td>";
                echo "<td>" . $employee3 . "</td>";
                echo "<td>" . $c_name['name'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";

                echo  "<td><a href='edit_project.php?id=$pro_id'>Edit</a></td>";

                
                
                // echo "<td>" . $row['email'] . "</td>";

                echo "</tr>";
           echo "</tbody>"; 

        }

echo "</table>";
?>
        
            <!-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
            </tr> -->

        <!-- </table> -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>