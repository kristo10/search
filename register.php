<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
    <style type="text/css">

        body{
            background-color: #f0f2f5;
        }
        .w-h1{
            margin-left: 950px;
            margin-bottom: 50px;
            margin-top: 100px;
        }

        .df{
            margin: 90px;
            margin-bottom: 250px;
            box-shadow: 20px 20px 50px grey;
            margin-left: 850px;
            margin-right: 850px;
            padding-bottom: 30px;
            padding-top: 15px;
            margin-top: 20px;
            border-radius: 7px;
            background-color: white;
        }

        .first{
            padding-top: 15px;
            margin-left: 20px;
            width: 90%;
            padding-left: 10px;
            padding-bottom: 4px;
            margin-bottom: 18px;
            border-radius: 7px;
            border-color: white;
            border: 1px solid #dddfe2;
            font-size: 17px;
        }

        label{
            padding-left: 25px;
        }

        .w-100{
            width: 90%!important;
            margin-left:20px;
            background-color: #1877f2;
            padding: 9px;
            font-size: 20px;
        }

        .go{
            text-align: center;
            margin-right: 25px;
        }
    </style>
</head>
<body>
    <div class="w-h1">
        <h1>Register</h1>
    </div>
    <form method="post" action="register.php">
        <div class="df">
            <label>Name</label><br>
            <input type="text" class="first" name="name"><br>

            <label>Email</label><br>
            <input type="email" class="first" name="email"><br>

            <label>Password</label><br>
            <input type="password" class="first" name="password"><br>

            <label>Confirm Password</label>
            <input type="password" class="first" name="confirmPassword"><br>
        <div><br>
            <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>
        </div><br>
        <div class="go">
            <a href="login.php"> Login </a>
        </div>
        </form>
    <?php
    include 'db.php';
    if (isset($_POST['submit'])) {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirmPassword'])) {
            echo '<br><center><strong> Fill in the fields! </strong></center>';
        } else {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $created_at = time();
            $updated_at = time();
            $confirmPassword = $_POST['confirmPassword'];

            if ($password == $confirmPassword) {
                $pass = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users1(name, email, password, created_at, updated_at) VALUES ('$name', '$email', '$pass', NOW(), NOW())";
                $result = mysqli_query($con, $query);

                header('Location: login.php');
            } else {
                echo '<br><center><strong> Error </strong></center>';
            }
        }
    }
    ?>
</body>
</html>