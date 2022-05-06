<?php
include 'db.php';

if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['user'])) {
 	header('Location: login.php');
 	exit();
 }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mire se vjen</title>
</head>
<body>

	<center>
		<h1>Mire se vjen </h1>
	<?php
	$a = $_SESSION['user'];
	print_r($a);
	?>

		<form method="post" action="index.php">
			<br><a href="profile.php"> Profile </a>
			<br><br><button type="submit" name="submit">Logout</button>
		</form>
	</center>

	<?php
	if (isset($_POST['submit'])) {
		unset($_SESSION['user']);
		$_SESSION['loggedIn'] = false;
		header('Location: login.php');
	}
	?>

</body>
</html>

