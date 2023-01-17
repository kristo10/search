
<?php
include 'layout/header.php';
    if (isset($_POST['submit1'])) {
        if (empty($_POST['content'])) {
            echo '<br><center><strong> <br> Fill in the fields! </strong></center>';
        } else {
            $content = $_POST['content'];
            $created_at = time();
            $updated_at = time();


            $query = "INSERT INTO posts(content, created_at, updated_at) VALUES ('$content', NOW(), NOW())";
            $result = mysqli_query($con, $query);
        }
    }

    if (isset($_POST['logout'])) {
        unset($_SESSION['user']);
        $_SESSION['loggedIn'] = false;
        header('Location: login.php');
    }
?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="POST" action="index.php">
                    <div>
                        <textarea class="form-control" name="content"></textarea>
                    </div>

                    <div class="d-flex justify-content-end me-0 mt-1">
                        <button type="submit" name="submit1" class="btn btn-primary">Post</button>
                    </div>

                    <div class="mt-5">
                        <?php
                        $query1 ="SELECT * FROM posts ORDER BY id DESC";
                        $result1 = mysqli_query($con, $query1);

                        if(mysqli_num_rows($result1) > 0){
                            while ($cont = mysqli_fetch_array($result1)) {
                            ?>
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <?php echo $cont['created_at']; ?>
                                    </div>

                                    <div class="card-body">
                                        <a href="post.php?id=<?php echo $cont['id']; ?>"> <?php echo $cont['content']; ?></a>
                                    </div>
                                </div>
                            <?php
                                $b= $cont['id'];
                                $comments_result = mysqli_query($con, "SELECT * FROM comments WHERE post_id  = '$b'");
                                if(mysqli_num_rows($comments_result) > 0){
                                    while($comment = mysqli_fetch_array($comments_result)) {
                                        echo "<div style=dispaly:flex; align-items:center;>";
                                            echo "<p>".$comment['content']."</p>";
                                            echo "<p>".$comment['created_at']."</p>";
                                        echo "</div>";
                                    }
                                } else {
                                echo "No comments";
                                }
                            }
                        } else {
                            echo "No posts";
                        }
                        ?>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

<?php include 'layout/footer.php'; ?>