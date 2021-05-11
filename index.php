<?php ?>
<!DOCTYPE html>
<html>
<head><title>Welcome to the Public Libarary website</title></head>

<body>
<h3> Admin Login</h3>
<form action="adminLogin.php"method="POST">
	Username: <input type="text" name= "adminid">
	<br>
	Password: <input type= "password" name= "adminPass">
	<br><br>
  <button type="submit" name="login" value="login">login</button>
</form>
<br><br>
<h4> Member Login<h4>
<form action="custLogin.php"method="POST">
	Username: <input type="text" name= "memid">
	<br>
	Password: <input type= "password" name= "memPass">
	<br><br>
  <button type="submit" name="login" value="login">login</button>
</form>

</body>
</html>
