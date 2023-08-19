<!-- <?php
session_start();
if ( isset($_SESSION['userdata'])) {
  header("location: user_login.php");
}
 $userdata = $_SESSION['userdata'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>My Profile</title>
</head>
<body>
<?php
  // Include the header
  include("user_header.php");
  ?>
   <main>
<div class="profile-pic">
     <img src="../user_photo/" >
</div>
<div class="profile">
<b>Username: <?php echo $userdata["username"];?> </b><br><br>
<b>Phone No. : <?php echo $userdata["phone"];?> </b><br><br>
<b>Roll No. : <?php echo $userdata["roll"];?> </b><br><br>
</div>
   

   </main>

     <?php
  // Include the footer
  include("user_footer.php");
  ?>

</body>
</html> -->

<?php
    session_start();

    // Check if the user is logged in. If not, redirect to the login page.
    if (!isset($_SESSION['userdata'])) {
        header("Location: ../user_login.php");
        exit();
    }

    // Retrieve user data from the session.
    $userdata = $_SESSION['userdata'];

    // Display the user information.
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $userdata['username']; ?>!</h1>
    <p>phone: <?php echo $userdata['phone']; ?></p>
    <!-- You can display other user information here as needed. -->
    <a href="logout.php">Logout</a>
</body>
</html>
