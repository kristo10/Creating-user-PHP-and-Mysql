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
    <title>Profile</title>
</head>
<body>
    <center>
        <h1>Change Password</h1>
        <form method="post" action="profile.php">
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
                    <td><input type="password" name="newPassword"></td>
                </tr>

                <tr>
                    <th>Confirm Password</th>
                    <td><input type="password" name="confirmPassword"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><br><button type="submit" name="submit">Update</td>
                </tr>
            </table>
            <br><a href="index.php">Go back</a>
        </form>
    </center>

        <?php
        if (isset($_POST['submit'])) {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['currentPassword']) || empty($_POST['newPassword']) || empty($_POST['confirmPassword'])) {
                echo "<br><center><strong> Ploteso fushat! </strong></center>";
            }
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['currentPassword'];


                if ($password) {
                    $dbpassword = $_SESSION['user']['password'];
                    if (password_verify($password, $dbpassword)) {
                        $newPassword = $_POST['newPassword'];
                        $confirmPassword = $_POST['confirmPassword'];
                        if ($newPassword == $confirmPassword) {
                            $pass = password_hash($newPassword, PASSWORD_DEFAULT);

                            $query = "UPDATE users SET password = '$pass' , name = '$name' WHERE email = '$email'";
                            $update = mysqli_query($con,$query);
                            if ($update) {
                                echo "<br><center><strong> Update me sukses </strong></center> ";
                            } else {
                                echo "<br><center><strong> Password nuk u ndryshua me sukses </strong></center>";
                            }
                        } else {
                            echo "<br><center><strong> Gabim </strong></center>";
                        }
                    } else {
                        echo "<br><center><strong> Gabim </strong></center>";
                    }
                }
        }
        ?>
</body>
</html>





