<?php
include("../admin_connect.php");

// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: admin_login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html>

<head>
  <title>Add Candidate</title>
  
  <style>
    * {
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

    #a {
      background-color: white;
      padding-left: 8px;
      padding-top: 8px;
      width: 212px;
      height: 27px;
      border: 1.5px solid black;
      border-radius: 10px;
      margin: 7px 0 5px 0;
    }

    #submit {

      background-color: green;
      font-weight: bold;
      height: 25px;
      border: none;
      border-radius: 10px;
      margin-left: 15%;
      margin-top: 10px;
      width: 40%;
    }

    /* table css */
    /* Apply some basic styling to the table */
    .table {
      width: 100%;
      border-collapse: collapse;
      font-family: Arial, sans-serif;
      color: #333;
    }

    /* Style the table header */
    .table thead tr {
      background-color: #f2f2f2;
    }

    .table thead th {
      padding: 12px;
      font-weight: bold;
      text-align: left;
      border-bottom: 2px solid #ddd;
    }

    .table tbody td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .table tbody td:last-child button {
      padding: 6px 12px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

  
    .table tbody td:last-child button:hover {
      background-color: #0056b3;
    }

    .edit {

      background-color: gray;
      padding: 5px;
      border-radius: 5px;
      text-decoration: none;
      color: black;
    }

    .Delete {
      background-color: green;
      padding: 5px;
      color: black;
      border-radius: 5px;
      text-decoration: none;
    }

    .c_photo {
      width: 70px;
      height: 70px;
      border: 1px solid black;
      border-radius: 100%;
    }
    
  </style>
</head>

<body>
  <?php
  // Include the header
  include("header.php");
  ?>
  <main>
    <section class="first">

      <!-- form section -->
      <div class="left">
        <h2 id="add">Add new candidates</h2>
        <form action="#" method="post" enctype="multipart/form-data">

          <select name="election_id" class="a" required>
            <option value="">Select Election</option>

            <?php
            $fetchingElections = mysqli_query($connect, "SELECT * FROM elections") or die(mysqli_error($connect));
            $isElectionIsAdded = mysqli_num_rows($fetchingElections);
            if ($isElectionIsAdded > 0) {
              while ($row = mysqli_fetch_assoc($fetchingElections)) {

                $election_id = $row['id'];

                $election_name = $row['election_topic'];
               
                // checking number of candidates
                // $allowedCandidate= $row['number_of_candidates'];
                // $fetchingCandidate = mysqli_query($connect,"SELECT * FROM candidate_detail WHERE election_id = '".$election_id."' ");
                 
                ?>

                <option value="">
                  <?php echo $election_id ?>
                  <p>-</p>
                    <?php echo $election_name; ?>
                   
                </option>
               
              <?php
              
               }

            } else {
              ?>
            <option value="">Please Add Election First</option>
            <?php

            }

            ?>

          </select>
          <br>
          <input type="text" name="candidate_name" placeholder="name of Candidate " class="a"><br>

          <input type="file" name="candidate_photo" id="a"><br>

          <input type="text" placeholder="Candidate details" name="candidate_detail" class="a"><br>

          <input type="submit" value="Add candidate" name="addCandidateBtn" id="submit">
        </form>
      </div>

      <div class="right">
        <h2>Candidates Details</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">S no.</th>
              <th scope="col">Photo</th>
              <th scope="col">Name</th>
              <th scope="col">Details</th>
              <th scope="col">Election</th>
              <!-- <th scope="col">Action</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            $fetchingData = mysqli_query($connect, "SELECT * FROM candidate") or die(mysqli_error($connect));
            $isAnyCandidateAdded = mysqli_num_rows($fetchingData);

            if ($isAnyCandidateAdded > 0) {
              $sno = 1;
              while ($row = mysqli_fetch_assoc($fetchingData)) {
                $election_id = $row['election_id'];
                $fetchingElectionName = mysqli_query($connect, "SELECT * FROM elections WHERE id = '" . $election_id . "'") or die(mysqli_error($connect));
                $execFetchingNameQuery = mysqli_fetch_assoc($fetchingElectionName);
                $election_name = $execFetchingNameQuery['election_topic'];
                $candidate_photo = $row['candidate_photo'];
                ?>
                <tr>
                  <td>
                    <?php echo $sno++; ?>
                  </td>
                  <td><img src="<?php echo $candidate_photo ?>" class="c_photo"></td>
                  <td>
                    <?php echo $row['candidate_name']; ?>
                  </td>
                  <td>
                    <?php echo $row['candidate_detail']; ?>
                  </td>
                  <td>
                    <?php echo $election_name ?>
                  </td>
                  <!-- <td>
                    <a href="#" class="edit">Edit</a>
                    <a href="#" class="Delete">Delete</a>
                  </td> -->
                </tr>
                <?php
              }

            } else {
              ?>
            <tr>
              <td colspan="7">No candidate added yet.</td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

    </section>
  </main>
  <?php
  // Include the footer
  include("footer.php");
  ?>
</body>

</html>

<!-- php code  -->

<?php
include("../admin_connect.php");
if (isset($_POST['addCandidateBtn'])) {
  $election_id = mysqli_real_escape_string($connect, $_POST['election_id']);
  $candidate_name = mysqli_real_escape_string($connect, $_POST['candidate_name']);
  $candidate_detail = mysqli_real_escape_string($connect, $_POST['candidate_detail']);
  $inserted_on = date("y-m-d");

  //photo
  $target_folder = "../candidate_photo/";
  $candidate_photo = $target_folder . rand(1111, 9099) . $_FILES['candidate_photo']['name'];
  $c_tmp_name = $_FILES['candidate_photo']['tmp_name'];
  $c_photo_type = strtolower(pathinfo($candidate_photo, PATHINFO_EXTENSION));
  $allowed_type = array("jpg", "png", "jpeg");
  $image_size = $_FILES['candidate_photo']['size'];

  // echo "Candidate Detail: " . $candidate_detail . "<br>";
  // // //condtn of img
  if ($image_size < 1000000) {
    if (in_array($c_photo_type, $allowed_type)) {
      if (move_uploaded_file($c_tmp_name, $candidate_photo)) {
        mysqli_query($connect, "Insert into candidate(election_id,candidate_name,candidate_detail,candidate_photo,inserted_on) Values('" . $election_id . "','" . $candidate_name . "','" . $candidate_detail . "','" . $candidate_photo . "','" . $inserted_on . "')") or die(mysqli_error($connect));
        echo '
        <script>
        alert ("Image upload successfully");
        window.location = "add_candidate.php";
        </script>
        ';
      } else {
        echo '
        <script>
        alert ("Image upload failes");
        window.location = "add_candidate.php";
        </script>
        ';
      }
    } else {
      echo '
        <script>
        alert ("Invalid file type,jpg,png,jpeg only");
        window.location = "add_candidate.php";
        </script>
        ';
    }
  } else {
    echo '
            <script>
            alert ("image maximum size is 1mb");
            window.location = "add_candidate.php";
            </script>
            ';
  }
}
?>