
<?php
include("../admin_connect.php");
// this code is for if user try to access do this page directly system will throw him out to login_page
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

// Check if the edit form is submitted
if (isset($_POST['updateElectionBtn'])) {
     $election_id = mysqli_real_escape_string($connect, $_POST['election_id']);
     $election_topic = mysqli_real_escape_string($connect, $_POST['election_topic']);
     $number_of_candidates = mysqli_real_escape_string($connect, $_POST['number_of_candidates']);
     $starting_date = mysqli_real_escape_string($connect, $_POST['starting_date']);
     $ending_date = mysqli_real_escape_string($connect, $_POST['ending_date']);

     // Perform the update query
     $updateQuery = "UPDATE elections SET 
                    election_topic = '$election_topic', 
                    number_of_candidates = '$number_of_candidates', 
                    starting_date = '$starting_date', 
                    ending_date = '$ending_date' 
                    WHERE id = '$election_id'";
     mysqli_query($connect, $updateQuery) or die(mysqli_error($connect));

     // Redirect back to the main page after update
     header("Location: add_election.php");
     exit;
}

// Check if the election ID is provided in the URL
if (isset($_GET['edit_election_id'])) {
     $edit_election_id = $_GET['edit_election_id'];

     // Fetch the details of the selected election
     $fetchElectionQuery = "SELECT * FROM elections WHERE id = '$edit_election_id'";
     $result = mysqli_query($connect, $fetchElectionQuery) or die(mysqli_error($connect));
     $election = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>

<head>
     <title>Edit Election</title>

     <style>
          /* * {
               margin: 0;
               padding: 0;
          }

          body {
               font-family: sans-serif;
               background-color: coral;
          }

          .first {
               display: flex;
               justify-content: space-around;
          }

          .a {
               width: 220px;
               height: 35px;
               border: 1.5px solid black;
               border-radius: 10px;
               margin: 10px 0 5px 0;
          }

          #submit {
               background-color: green;
               font-weight: bold;
               height: 25px;
               border: none;
               border-radius: 10px;
               margin-left: 20%;
               margin-top: 10px;
               width: 50%;
          } */
          body {
        font-family:sans-serif;
        background-color: coral;
        margin: 0;
        padding: 0;
    }

    main {
        padding: 10px;
    }

    h2 {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    input[type="submit"] {
        width: 200px;
        height: 25px;
        border: 1px solid black;
        border-radius: 10px;
        margin-bottom: 7px;
        padding: 5px 10px;
        font-size: 14px;
    }

    input[type="submit"] {
        background-color: green;
        font-weight: bold;
        color: #fff;
        cursor: pointer;
        width: 140px;
        margin-left: 20px;
    }

    input[type="submit"]:hover {
        background-color: #008000;
        
    }
     </style>
</head>

<body>
<?php
    // Include the header
    include("header.php");

    // Check if an election_id is provided in the URL
    if (isset($_GET['election_id'])) {
        $election_id = mysqli_real_escape_string($connect, $_GET['election_id']);

        // Retrieve the election details from the database
        $fetchingData = mysqli_query($connect, "SELECT * FROM elections WHERE id = '$election_id'") or die(mysqli_error($connect));
        $election = mysqli_fetch_assoc($fetchingData);
    } else {
        // Redirect back to add_election.php if election_id is not provided
        header("Location: add_election.php");
        exit();
    }
    ?>

    <main>
        <section>
            <h2>Edit Election</h2>
            <form method="post" action="update_election.php">
                <input type="hidden" name="election_id" value="<?php echo $election['id']; ?>">
                <label for="election_topic">Election Topic:</label>
                <input type="text" name="election_topic" value="<?php echo $election['election_topic']; ?>" required><br>

                <label for="number_of_candidates">No. of Candidates:</label>
                <input type="number" name="number_of_candidates" value="<?php echo $election['number_of_candidates']; ?>" required><br>

                <label for="starting_date">Starting Date:</label>
                <input type="date" name="starting_date" value="<?php echo $election['starting_date']; ?>" required><br>

                <label for="ending_date">Ending Date:</label>
                <input type="date" name="ending_date" value="<?php echo $election['ending_date']; ?>" required><br>

                <input type="submit" value="Update Election" name="updateElectionBtn">
            </form>
        </section>
    </main>

     <?php include("footer.php"); ?>
</body>

</html>