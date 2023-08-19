<?php
session_start();
include("user_connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Header</title>
    <style>  
    * {
      padding: 0;
      margin: 0;
      font-family: sans-serif;
    }

    nav {
      display: flex;
      justify-content: space-around;
      align-items: center;
      background-color: rgb(66, 65, 64);
      height: 60px;
    }

    nav ul {
      display: flex;
      justify-content: center;
      font-weight: bold;
    }

    nav ul li {
      list-style: none;
      margin: 0px 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: black;
    }

    nav ul li a:hover {
      color: rgb(243, 235, 235);
      font-size: 1.05rem;
    }

    .left {
      font-size: 20px;
      font-weight: bold;
      text-transform: capitalize;
    }

          footer {
     margin-top: 10px;
    background-color:rgb(66, 65, 64);
    color: #fff;
    text-align: center;
    padding: 05px;
}
.footer {
    max-width: 800px;
    margin: 0 auto;
}
.footer p {
    margin: 5px;
}
/* css to table */
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
    .c_photo {
      width: 70px;
      height: 70px;
      border: 1px solid black;
      border-radius: 100%;
    }
    </style>
</head>
<body>

    <header>
    <nav>
       <div class="left"> Online Voting System </div>
      <div class="right">
        <ul>
         <li><a href="#">Home</a></li>
          <li><a href="../user/user_dashboard/user_profile.php">My profile</a></li> 
          <li><a href="../user/user_dashboard/user_logout.php">Logout</a></li>
        </ul>
      </div>
    </nav>   
    </header>
<h2>Votter pannel</h2>
<?php 
$fetchingActiveElection = mysqli_query($connect,"SELECT * FROM elections where status = 'Active'") or die(mysqli_error($connect)) ;
$totalActiveElection = mysqli_num_rows($fetchingActiveElection);

if ($totalActiveElection>0) {
  while ($data=mysqli_fetch_assoc($fetchingActiveElection)) {
    $election_id = $data['id'];
    $election_topic = $data['election_topic'];
    ?>
  <table class="table">
<thead>
  <tr>
    <th colspan="4" >Election Name: <?php echo strtoupper($election_topic); ?> </th>
  </tr>
  <tr>
    <th> Photo </th>
    <th> Candidate Details</th>
    <th>No. of votes</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
  <?php 
  $fetching_candidate= mysqli_query($connect,"SELECT * FROM elections where election_id= '".$election_id."' ") or die(mysqli_error($connect));

  while ($candidateData=mysqli_fetch_assoc($fetching_candidate)) {
    $candidate_id= $candidateData['id'];
    $candidate_photo= $candidateData['candidate_photo'];
    $candidate_detail=$candidateData['candidate_detail'];
    ?>
<tr>
  <td><img src="<?php  echo $candidate_photo?>" class="c_photo"></td>
  <td></td>
  <td>

  </td>
</tr>
    <?php
    
    
  }
  ?>
</tbody>
</table>
<?php
  }
}
else {
  echo"No any election available at the moment.";
}


?>

    <footer>
<div class="footer">
     <p>&copy; 2023 Online Voting System. All rights reserved.</p>
     <p>Contact us: abc@onlinevotingsystem.com</p>
     <p>Developed by: XYZ from Himalaya Darsan Collage</p>
     <p>Location:Biratnagar,Nepal</p>
  </div>
</footer>
</body>
</html>
