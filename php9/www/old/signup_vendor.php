<?php 
    session_start();
    $_SESSION['tryagain'] = 'signup_vendor.php';
    if(isset($_SESSION['signup_failed'])){
      echo "<script type='text/javascript'>alert('Username or business address is not unique.');</script>";
    }
  ?>
<form action="verify_signup.php" method="POST" enctype="multipart/form-data">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter a unique username" name="uname" required><br>

    <label for="fullname"><b>Business name</b></label>
    <input type="text" placeholder="Enter full name" name="fullname" required><br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required><br>

    <input type="hidden" name="utype" value="vendor"
    >
    <label for="address"><b>Business address</b></label>
    <input type="text" placeholder="Enter address" name="wc">

    <label for="fileup"><b>Upload profile picture</b></label>
    <input type="file" name="fileup" id="fileToUpload">

    <a href="homepage.php">Log in sites</a>
    <button type="submit" class="signupbtn" name="signup">Sign Up</button>

  </div>
</form> 