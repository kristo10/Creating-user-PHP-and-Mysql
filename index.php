<?php
include 'db.php';
if (!isset($_SESSION['user']) || !isset(($_SESSION['loggedIn']))) {
    header('Location: login.php');
    exit();
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <center>
        <h1>Home Page</h1>
        <?php
            $a = $_SESSION['user'];
        ?>
        <P>WELCOME</P>
        <?php echo $a['name']; ?>

        <form method="POST" action="index.php">
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
<?php
}
?>