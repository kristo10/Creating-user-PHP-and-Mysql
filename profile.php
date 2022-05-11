<?php
include 'db.php';
if (!isset($_SESSION['user']) || !isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}
    if (isset($_POST['submit'])) {
         if (empty($_POST['name']) || empty($_POST['email'])) {
             echo '<br><center><strong>Fill in the fields!</strong></center>';
         } else {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $id = $_SESSION['user']['id'];

            $query = "UPDATE users1 SET name = '$name', email = '$email' WHERE id = '$id'";
            $updated = mysqli_query($con, $query);

         }
         $password = $_POST['currentPassword'];
        if ($password) {
            $password = $_POST['currentPassword'];
            $dbpassword = $_SESSION['user']['password'];
            if (password_verify($password, $dbpassword)) {
                $newtPassword = $_POST['newtPassword'];
                $confirmPassword = $_POST['confirmPassword'];
                if ($newtPassword == $confirmPassword) {
                    $pass = password_hash($newtPassword, PASSWORD_DEFAULT);

                    $query = "UPDATE users1 SET password = '$pass' WHERE id = '$id'";
                    $update = mysqli_query($con, $query);
                    if ($update) {
                        echo "<br><center><strong> Update successfully </strong></center> ";
                    } else {
                        echo '<br><center><strong> Update not successfully </strong></center>';
                    }
                 } else {
                    echo '<br><center><strong> Not change </strong></center>';
                 }
            } else {
                echo '<br><center><strong> Error password </strong></center>';
            }
        }
        $query1 = "SELECT * FROM users1 WHERE id = '$id'";
        $session = mysqli_query($con, $query1);
        $user = mysqli_fetch_assoc($session);
        $_SESSION['user'] = $user;
     }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Updated Profile</title>
</head>
<body>

    <center>
        <h1>Updated Profile</h1>
        <form method="POST" action="profile.php">
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" value="<?php echo $_SESSION['user']['name'];?>"></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" value="<?php echo $_SESSION['user']['email'];?>"></td>
                </tr>

                <tr>
                    <th>Current Password</th>
                    <td><input type="password" name="currentPassword"></td>
                </tr>

                <tr>
                    <th>New Password</th>
                    <td><input type="password" name="newtPassword"></td>
                </tr>

                <tr>
                    <th>Confirm Password</th>
                    <td><input type="password" name="confirmPassword"></td>
                </tr>

                 <tr>
                    <td><input type="hidden" name="id"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><button type="submit" name="submit"> Update</button></td>
                </tr>
            </table><br>
            <a href="index.php"> Go back </a>
        </form>
    </center>

</body>
</html>
