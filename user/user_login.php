<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Online Voting-Login</title>
  <link rel="stylesheet" href="user_login.css" />
</head>

<body>
  <div class="center">
    <h1>Online Voting System-Login</h1>
    <form action="user_db_login.php" method="post">
      <div class="txt_field">
        <input type="text" name="username" required />

        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required />

        <label>Password</label>
      </div>
      <!-- <div class="dropbox">
        <select id="dropbox" name="role">
          <option value="1" style="background-color:aqua;">Voter</option>
          <option value="2" style="background-color:aqua; ">Group</option>
        </select>
      </div> -->
      <button id="login" type="submit">Login</button>

      <div class="signup_link">Not a member? <a href="user_registration.php" target="_blank">SignUp</a></div>
    </form>
  </div>
</body>

</html>