<?php
    // Include the database connection file
    include("admin_connect.php");


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Escape the user inputs to prevent SQL injection
        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password);

        // Fetch the user record from the database based on the provided username and password
        $query = "SELECT * FROM admin1 WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) > 0) {
 
            session_start();
            $_SESSION['admin_username'] = $username;

            // Redirect the user to a dashboard or home page
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Incorrect username or password
            echo '<script>
                    alert("Incorrect username or password");
                </script>';
        }
    }
?>

