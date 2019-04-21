<!DOCTYPE html>
<html>
<head>
<title> Log in Screen</title>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
html {
 height: 100%;
}
body {
  padding-top: 5%;
}
h1 {
  padding-bottom: 5%;
  font-weight: bold;
}
fieldset {
  width: 600px;
  margin: 0 auto;
}

.login-page {
  width: 360px;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 50px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  /*margin-bottom*/
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #0CD5DB;
  width: 100%;
  border: 0;
  padding: 15px;
  color: black !important;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #0EF8FF;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
h1 {
  font-size: 70px;
}

</style>
</head>

<body>
  <h1>Login</h1>

<form action="calls/loginProcess.php" method="post">
    <div class="login-page">
      <div class="form">
          <input type="text" placeholder="admin1 or admin2" required name="username"/>
          <input type="password" placeholder="s3cr3t" name="password"/>
          <button type="submit" value="Login!">login</button>
          <br><br>
      </div>
    </div>
</form>
<a href="calls/signup.php"><button class="button orange no-line-height">Register</button></a>
<br><br>
<a href="searchmovies.php" class="button">Search for a Movie</a>

</body>
</html>



