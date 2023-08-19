<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Header</title>
    <style>  * {
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
    
    </style>
</head>
<body>

    <header>
    <nav>
     
       <div class="left">Online Voting System
       <!--  <?php echo $_SESSION['admin_username'];?> -->
      </div>
      <div class="right">
        <ul>
         <li><a href="../admin_dashboard.php">Home</a></li>
          <li><a href="add_election.php">Add election</a></li> 
          <li><a href="add_candidate.php">Add candidate</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </nav>   
    </header>
</body>
</html>
