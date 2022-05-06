
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>

	<center>
		<h1>Login</h1>
		<form method="post" action="login.php">
			<table>
				<tr>
					<th>Email</th>
					<td><input type="email" name="email"></td>
				</tr>

				<tr>
					<th>Password</th>
					<td><input type="password" name="password"></td>
				</tr>

				<tr>
					<td></td>
					<td><button type="submit" name="submit">Login</button></td>
				</tr>
			</table>
		</form>
	</center>

	<?php
	include 'db.php';
	$gabim = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['email']) || empty($_POST['password'])) {
			$gabim = 'Email/Password gabim';
			echo '<br><center><strong>' . $gabim . '</strong><center>';
		} else {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$query = "SELECT * FROM users WHERE email ='$email'";
			$result = mysqli_query($con,$query);

			$rows = mysqli_num_rows($result);

			if ($rows == 1) {
				while($user = mysqli_fetch_assoc($result)){
					$dbpassword = $user['password'];
					if (password_verify($password, $dbpassword)){
						$_SESSION['loggedIn'] = true;
						$_SESSION['user'] = $user;
						header("Location: index.php");
					} else {
						$gabim = '<br><center><strong>Gabim</strong></center';
						echo $gabim;
					}
				}
			}
		}
	}
	?>


</body>
</html>
