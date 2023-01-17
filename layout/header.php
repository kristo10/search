<?php
include __DIR__ . '/../db.php';
if (!isset($_SESSION['user']) || !isset(($_SESSION['loggedIn']))) {
    header('Location: /vet/login.php');
    exit();
}
    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home Page</title>
    <style type="text/css">
        .dropdown-toggle{
                text-decoration: none;
        }
        .dropdown{
            margin-right: 50px;
        }
        .dropdown-menu{
            margin-left: 5px;
            padding-left: 30px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo __DIR__.'/../index.php'; ?>">LOGO</a>
             <form method="GET" class="d-flex" action="search.php">
                <input class="form-control me-2" name="name" type="search" placeholder="Search" aria-label="Search">
                <button name="Search" class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="d-flex">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $user['name']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form method="POST" action="index.php">
                            <li>
                                <a href="profile.php"> Profile </a>
                            </li>
                            <button type="submit" name="logout" class="btn btn-primary">Logout</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

