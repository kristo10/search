<?php

include_once __DIR__ . '/../layout/header.php';

$id = $_GET['id'];
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="mt-4">
                <?php
                $query = "SELECT * FROM users1 WHERE id = '$id'";
                $result = mysqli_query($con, $query);

                $query2 = "SELECT * FROM posts WHERE id = '$id'";
                $result2 = mysqli_query($con, $query2);

                $query1 = "SELECT * FROM comments WHERE post_id = '$id'";

                $error = "";
                if (isset($_POST['Submit'])) {
                $content = $_POST['content'];
                    if (empty($content)) {
                        $error = "<center>Please write the comment</center> <br>";
                    } else {
                        $result3 = mysqli_query($con, "INSERT INTO comments( post_id,content) VALUES ('$id','$content')");
                    }
                }
                $result1 = mysqli_query($con, $query1);


                while ($name = mysqli_fetch_array($result)) {
                ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <?php
                        echo "<strong>" . $name['name'] . "</strong>" . "<br>";
                        echo "<strong>" . $name['email'] . "</strong>"
                        ?>
                        <div class="d-flex justify-content-end me-0 mt-1">
                            <button type="submit" name="submit1" class="btn btn-primary">Follow</button>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="card mt-5">
                    <div class="card-body">
                        <?php
                        echo "<br>";
                        while ($post = mysqli_fetch_assoc($result2)) {
                        ?>
                        <div>
                            <label>POST: <?php echo $post['content']; ?> </label>
                        </div>
                    </div>
                </div>
                <form method="POST" action="profile.php?id=<?php echo $_GET['id'];?>">
                    <div class="card " style="border: 0px solid">
                        <div class="card-body ">
                            <textarea name="content"></textarea>
                            <button type="submit" name="Submit"class="btn btn-primary btn-sm">Save Reply</button><br>
                            <?php
                            echo $error;
                            }
                            while ($comment = mysqli_fetch_assoc($result1)){
                            ?>
                            <label>Comment: <?php echo $comment['content'] ;?></label>
                            <?php
                            echo "<br>";
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
