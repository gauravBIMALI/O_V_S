<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="admin_registration.css" />
  </head>

  <body>
    <div class="center">
      <h1>Sign-Up</h1>
      <form action="admin_db_registration.php" method="post" enctype="multipart/form-data">
        <div class="a">
          <input type="text" name="username" placeholder="Username" required />
        </div>
        <div class="a">
          <input
            type="number" name="phone" placeholder="Phone Number" required
          />
        </div>
        
        <div class="a">
          <input type="password" name="password" placeholder="Password" />
        </div>
        <div class="a">
          <input type="password" name="cpassword" placeholder="Confirm Password" />
        </div>
        

        <div class="member">
          Already a member? <a href="admin_login.php">Click Here</a>
        </div>

        <input
          type="submit" style="background-color: cornflowerblue; width: 30%"
        />
      </form>
    </div>
  </body>
</html>
