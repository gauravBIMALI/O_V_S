
<?php
include("../admin_connect.php");

if (isset($_POST['deleteElectionBtn'])) {
  $election_id = mysqli_real_escape_string($connect, $_POST['election_id']);

  // Perform the deletion query
  $deleteQuery = "DELETE FROM elections WHERE id = '$election_id'";
  mysqli_query($connect, $deleteQuery) or die(mysqli_error($connect));

  // Refresh the page after deletion
  header("Location: add_election.php");
  exit;
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Add Election</title>
  <!-- Add your CSS and other meta tags here -->
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
      border-radius: 5px;
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

    /* Change button background on hover */
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
  </style>
</head>

<body>
  <?php
  // Include the header
  include("header.php");
  ?>
  <main>
    <section class="first">
      <!-- Your add_e.html content here -->
      <div class="left">
        <h2 id="add">Add new election</h2>
        <form method="post">
          <input type="text" name="election_topic" placeholder="Election topic" class="a" required> <br>

          <input type="number" name="number_of_candidates" placeholder="No. of candidates" class="a" required><br>

          <input type="text" onclick="this.type='date'" placeholder="Starting Date" name="starting_date" class="a"
            required><br>

          <input type="text" onfocus="this.type='Date'" placeholder="Ending Date" name="ending_date" class="a"
            required><br>

          <input type="submit" value="Add Election" name="addElectionBtn" id="submit">
        </form>
      </div>

      <div class="right">
        <h2>Upcomming Election</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">S no.</th>
              <th scope="col">Election Name</th>
              <th scope="col">No. of Candidates</th>
              <th scope="col">Starting Date</th>
              <th scope="col">Ending Date</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $fetchingData = mysqli_query($connect, "SELECT * FROM elections") or die(mysqli_error($connect));
            $isAnyElectionIsAdded = mysqli_num_rows($fetchingData);
            if ($isAnyElectionIsAdded > 0) {
              $sno = 1;
              while ($row = mysqli_fetch_assoc($fetchingData)) {
                $election_id = $row['id'];
                ?>
                <tr>
                  <td>
                    <?php echo $sno++; ?>
                  </td>
                  <td>
                    <?php echo $row['election_topic']; ?>
                  </td>
                  <td>
                    <?php echo $row['number_of_candidates']; ?>
                  </td>
                  <td>
                    <?php echo $row['starting_date']; ?>
                  </td>
                  <td>
                    <?php echo $row['ending_date']; ?>
                  </td>
                  <td>
                    <?php echo $row['status']; ?>
                  </td>
                  <td>
                    <a href="edit_election.php?election_id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this election?')">
                      <input type="hidden" name="election_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" class="Delete" name="deleteElectionBtn">Delete</button>
                    </form>

                   
                  </td>

                </tr>
                <?php
              }
            } else {
              ?>

              <tr>
                <td colspan="6">
                  No any election detail added yet.
                </td>
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
if (isset($_POST['addElectionBtn'])) {
  $election_topic = mysqli_real_escape_string($connect, $_POST['election_topic']);
  $number_of_candidates = mysqli_real_escape_string($connect, $_POST['number_of_candidates']);
  $starting_date = mysqli_real_escape_string($connect, $_POST['starting_date']);
  $ending_date = mysqli_real_escape_string($connect, $_POST['ending_date']);

  // $inserted_on = date("y-m-d");

  // $date1 = date_create($inserted_on);
  // $date2 = date_create($starting_date);
  // $diff = date_diff($date1, $date2);

  // if ($diff->format("%R %a days") > 0) {
  //   $status = "Inactive";
  // } else {
  //   $status = "Active";
  // }

$inserted_on = date("Y-m-d"); // Use uppercase Y for a 4-digit year.

$date1 = new DateTime($inserted_on); // Use DateTime class for proper date comparisons.
$date2 = new DateTime($starting_date);
$diff = $date1->diff($date2);

if ($diff->days > 0) { // Use ->days to access the days property.
  $status = "Inactive";
} else {
  $status = "Active";
}

  //Inserting these value in election table
  mysqli_query($connect, "Insert into elections(election_topic,number_of_candidates,starting_date,ending_date,status,inserted_on) Values('" . $election_topic . "','" . $number_of_candidates . "','" . $starting_date . "','" . $ending_date . "','" . $status . "','" . $inserted_on . "')") or die(mysqli_error($connect));

  echo '

<script>
alert ("New Election added successfully");
window.location = "add_election.php";
</script>
';
}
?>