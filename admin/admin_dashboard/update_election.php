<?php
// update_election.php

// Include the admin_connect.php file to establish a database connection
include("../admin_connect.php");

if (isset($_POST['updateElectionBtn'])) {
    $election_id = mysqli_real_escape_string($connect, $_POST['election_id']);
    $election_topic = mysqli_real_escape_string($connect, $_POST['election_topic']);
    $number_of_candidates = mysqli_real_escape_string($connect, $_POST['number_of_candidates']);
    $starting_date = mysqli_real_escape_string($connect, $_POST['starting_date']);
    $ending_date = mysqli_real_escape_string($connect, $_POST['ending_date']);

    // Perform the update query
    $query = "UPDATE elections SET election_topic = '$election_topic', 
              number_of_candidates = '$number_of_candidates',
              starting_date = '$starting_date', 
              ending_date = '$ending_date' 
              WHERE id = '$election_id'";

    if (mysqli_query($connect, $query)) {
        // Redirect back to add_election.php after successful update
        header("Location: add_election.php");
        exit();
    } else {
        echo "Error updating election: " . mysqli_error($connect);
    }
}

// Close the database connection
mysqli_close($connect);
?>
