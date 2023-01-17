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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Updated Profile</title>

<style type="text/css">

    .w-h2{
        margin-left: 880px;
        margin-bottom: 50px;
        margin-top: 70px;
    }
    .df{
     margin-left: 780px;
     margin-right: 780px;
     border: 1px solid white;
     box-shadow: 20px 20px 50px 15px grey;
     border-radius: 7px;
     margin-top: 10px;
     padding-top: 20px;
     padding-bottom: 15px;
     padding-left: 32px;
     margin-bottom: 150px;
    }

    .first{
        border: 1px solid grey;
        background-color: white;
        text-align: center;
        margin-bottom: 35px;
        margin-left: 45px;
        padding-bottom: 10px;
        margin-top: 15px;
        border-radius: 5px;
        width: 400px;
        padding-top: 10px;
    }

    label {
        padding-left: 45px;
    }

    .w-100{
        width: 90% !important;
    }

    .go{
        text-align: center;
        margin-right: 25px;
    }
</style>
</head>
<body>
        <div class="w-h2">
            <h1>Updated Profile</h1>
        </div>
        <form method="POST" action="profile.php">
            <div class="df">
                <label>Name </label><br>
                <input type="text" name="name" class="first" value="<?php echo $_SESSION['user']['name'];?>"><br>

                <label> Email </label><br>
                <input type="email" name="email" class="first" value="<?php echo $_SESSION['user']['email'];?>"><br>

                <label> Current Password </label><br>
                <input type="password" class="first" name="currentPassword"><br>

                <label> New Password </label><br>
                <input type="password" class="first" name="newtPassword"><br>

                <label> Confirm Password </label><br>
                <input type="password" class="first" name="confirmPassword"><br>
            <div>
                <button type="submit" name="submit" class="btn btn-primary w-100"> Update</button>
            </div><br>

            <div class="go">
                <a href="index.php"> Go back </a>
            </div>
        </form>
</body>
</html>
