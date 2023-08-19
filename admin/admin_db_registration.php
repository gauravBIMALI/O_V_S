<?php
    include("admin_connect.php");
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];

    if ($password == $cpassword) {
        // Escape the user inputs to prevent SQL injection
        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password);
        $phone = mysqli_real_escape_string($connect, $phone);

        // $insert = mysqli_query($connect, "INSERT INTO admin1 (username, phone, password) VALUES ('$username', '$phone', '$password')");

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = mysqli_query($connect, "INSERT INTO admin1 (username, phone, password) VALUES ('$username', '$phone', '$hashed_password')");
        
        if ($insert) {
            echo '<script>
                    alert("Registration successful!");
                    window.location = "admin_login.php";
                  </script>';
        } else {
            echo '
                <script>
                alert("Some error occurred");
                </script>
            ';
        }
    } else {
        echo '<script>
                alert("Passwords do not match");
                window.location = "admin_registration.php";
              </script>';
    }
?>
