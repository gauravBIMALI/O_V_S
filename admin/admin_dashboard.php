<?php
include("admin_connect.php");

// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: admin_login.php");
//     exit();
// }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Home Page</title>
  <style>
    * {
      padding: 0;
      margin: 0;
      font-family: sans-serif;
    }
    body{
    background-color: coral;
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
      padding-bottom: 12px;
    }
    
    /* below code is for footer section */
   

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
    margin: 2px;
}
.a_pannel{
  text-decoration:brown;
  font-size: 15px;
  color: white;
  font-weight: bold;
}  
     /* table css */
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

.table tbody td:last-child button:hover {
  background-color: #0056b3;
}
.edit{
    
background-color: gray;
padding: 5px;
border-radius: 5px;
text-decoration: none;
color: black;
}
.Delete{
background-color: green;
padding: 5px;
color: black;
border-radius: 5px;
text-decoration: none;
}
.first{
  margin :3% 5% 5% 5%;
  /* margin-right: 5%; */
}
    
  </style>

</head>

<body>
  <header>
    <nav>
      <div class="left"> <p class="a_pannel" >This is admin pannel</p> 
            Welcome to Online Voting System:
    </div>
      <div class="right">
        <ul>
         <li><a href="">Home</a></li>
          <li><a href="../admin/admin_dashboard/add_election.php">Add election</a></li> 
          <li><a href="../admin/admin_dashboard/add_candidate.php">Add candidate</a></li>
          <li><a href="../admin/admin_dashboard/logout.php">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>
    
  <!-- Body section  -->

  <main class="first" >
    <section >

    <div >
        <h2>Election Detail</h2>
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
        $fetchingData = mysqli_query($connect,"SELECT * FROM elections") or die(mysqli_error($connect));
        $isAnyElectionIsAdded= mysqli_num_rows($fetchingData);
        if ($isAnyElectionIsAdded > 0) {
            $sno=1;
            while ($row = mysqli_fetch_assoc($fetchingData)) {
             ?>
             <tr>
                <td> <?php echo $sno++; ?> </td>
                <td> <?php echo $row['election_topic']; ?> </td>
                <td> <?php echo $row['number_of_candidates']; ?> </td>
                <td> <?php echo $row['starting_date']; ?> </td>
                <td> <?php echo $row['ending_date']; ?> </td>
                <td> <?php echo $row['status']; ?> </td>
                <td>
                    <a href="#" class="edit">Edit</a>
                    <a href="#" class="Delete">Delete</a>
                </td>
                	
             </tr>
             <?php
            }
        }
        
        else {
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

    <!-- body section end  -->


 <footer>
  <div class="footer">
     <p>&copy; 2023 Online Voting System. All rights reserved.</p>
     <p>Developed by: XYZ from Himalaya Darsan Collage</p>
     <p>Contact Us: onlinevoting12@gmail.com</p>
     <p>Location:Biratnagar,Nepal</p>
     

  </div>
  
</footer>
</body>

</html>
