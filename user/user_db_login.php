<!-- <?php
// Include the database connection file (user_connect.php)
include "user_connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL statement to check if the user exists with the provided credentials
    $stmt = $connect->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set from the executed statement
    $result = $stmt->get_result();

    // Check if the user exists and the password matches
    if ($result->num_rows === 1) {
        // User credentials are valid, proceed with login
        session_start();
        $_SESSION["username"] = $username;

        // Redirect the user to the user_dashboard.php page
        header("Location: user_dashboard.php");
        exit; // Ensure that the script stops executing after the redirect
    } else {
       
        echo "Invalid username or password.";
        
    }
   
    $stmt->close();
}
?> -->


 <?php
    session_start();
    include("user_connect.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    
     $check = mysqli_query($connect, "select * from user where username='$username' and password='$password' ");

    if (mysqli_num_rows($check)>0) {
        $userdata=mysqli_fetch_array($check);
        $_SESSION['userdata']=$userdata;
        header("Location: user_dashboard.php");
        
        // echo'
        // <script>
        // window.location = "dashboard.php";
        // </script> ';
    }
    else{
        // echo "Invalid username or password.";
        // header("Location: user_login.php");
        echo '
        <script>
             alert("invalid crediantials");
             window.location=" user_login.php";
        </script>
        ';
    }
?> 
