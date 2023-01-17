<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Login</title>
<style type="text/css">

        body {
                background-color: #f0f2f5;
            }

        .cs {
            margin: 9px;
            margin-bottom: 250px;
            box-shadow: 20px 20px 50px grey;
            margin-left: 850px;
            margin-right: 850px;
            padding-bottom: 30px;
            padding-top: 15px;
            margin-top: 240px;
            border-radius: 7px;
            background-color: white;
        }

        .bo{
            padding-top: 15px;
            margin-left: 20px;
            width: 90%;
            padding-left: 10px;
            padding-bottom: 4px;
            margin-bottom: 10px;
            border-radius: 7px;
            border-color: white;
            border: 1px solid #dddfe2;
            font-size: 17px;
        }


        .w-100 {
            width: 90%!important;
            margin-left:20px;
            background-color: #1877f2;
            padding: 9px;
            font-size: 20px;
        }

        .forget{
            margin-left:160px;
            text-decoration: none;
            font-size: 16px;
        }

        hr{
            width: 90%;
            margin-left: 20px;

        }

        .btn-success{
            width: 50%;
            background-color: #42b72a;
            margin-left: 110px;
            padding: 9px;
            font-size: 20px;
        }
    </style>
</head>
<body>
        <form method="POST" action="login.php" class="cs">
            <div>
                <input type="email" name="email" class = "bo" placeholder="Email or phone number">
            </div>

            <div>
                <input type="password" name="password" class="bo" placeholder="Password">
            </div><br>

            <div>
                <button type="submit" name="submit" class="btn btn-primary w-100"><strong> Login </strong> </button>
            </div><br>

            <div>
                <a href="" class="forget">Forgot Password</a>
            </div><hr>

            <div>
                <button type="submit" name="create" class="btn btn-success" ><strong>Create new account</strong></button>
            </div>
        </form>
   <?php

   if (isset($_POST['submit'])) {
       if (empty($_POST['email']) || empty($_POST['password'])) {
           echo '<br><center><strong> Fill in the fields! </strong></center>';
       } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "SELECT * FROM users1 WHERE email = '$email'";
            $result = mysqli_query($con, $query);

            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                while ($user = mysqli_fetch_assoc($result)) {
                    $dbpassword = $user['password'];
                    if (password_verify($password, $dbpassword)) {
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['user'] = $user;
                        header('Location: index.php');
                    } else {
                        echo '<br><center><strong> Error </center></strong>';
                    }
                }
            } else {
                echo '<br><center><strong> This account not exist';
            }
       }
   }
   if (isset($_POST['create'])) {
       header('Location: register.php');
   }

   ?>
</body>
</html>