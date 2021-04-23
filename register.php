<?php include('functions.php') ?>
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
    <h4>Register now</h4>
    </div>
    
  <div class="container" style="padding: 150px; padding-top: 50px;">
    <form action="register.php" method="post">

    <?php echo display_error(); ?>

   
    
    <div class="form-group">
      <label for="exampleFormControlInput1">Username</label>
      <input class="form-control" name="username" type="text" placeholder="Enter Username" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Email address</label>
      <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Enter email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Password</label>
      <input class="form-control" type="text"  name="password1" placeholder="Enter Password">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Confirm Password</label>
      <input class="form-control" type="text"  name="password2" placeholder="Confirm Password">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Choose Role</label>
      <select class="form-control" name="role" id="exampleFormControlSelect1">
        <option>Manager</option>
        <option>Employee</option>
      </select>
    </div>


    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" name="register_btn">Sign in</button>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
      <p>Already a member? <a href="login.php" class="btn btn-primary">Login In</a></p>
      </div>
    </div>

   
    
  </form>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>