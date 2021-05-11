<?php ?>
<!DOCTYPE html>
<html>
<head><title>Welcome to the Public Libarary website</title></head>

<body>
<h3> Login</h3>
<form action="admin.php"method="POST">
	Username: <input type="text" name= "userid">
	<br>
	Password: <input type= "password" name= "password">
	<br><br>
  <button type="submit" name="login" value="login">login</button>
</form>
<form action="member.php"method="POST">
	Username: <input type="text" name= "userid">
	<br>
	Password: <input type= "password" name= "password">
	<br><br>
  <button type="submit" name="login" value="login">login</button>
</form>

</body>
</html>
