<?php
// Include the database connection file (connect.php)
include "user_connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $roll = $_POST["roll"];
    $password = $_POST["password"];

    // Handle the uploaded image
    $target_dir = "user_photo/"; // Directory where the image will be uploaded
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain image file formats
    if (
        $imageFileType != "jpg" &&
        $imageFileType != "png" &&
        $imageFileType != "jpeg" &&
        $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // You may redirect the user back to the registration form or handle the error accordingly
    } else {
        // If everything is ok, try to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // File uploaded successfully, now insert the data into the database

            // Prepare the SQL statement to insert data into the "user" table using prepared statements
            $stmt = $connect->prepare("INSERT INTO user (username, phone, roll, password, photo) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $phone, $roll, $password, $target_file);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "Registration successful. Data inserted into the database.";
                // You may redirect the user to a success page or any other appropriate action
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
            // You may redirect the user back to the registration form or handle the error accordingly
        }
    }
}
?>
