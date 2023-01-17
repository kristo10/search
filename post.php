<?php
include 'layout/header.php';
$id = $_GET['id'];

  $result = "SELECT * FROM posts WHERE id = '$id'";
  $queryRow = mysqli_query($con, $result);
  $postData = mysqli_fetch_assoc($queryRow);

    $query = "SELECT * FROM comments WHERE post_id = '$id'";

    if (isset($_POST['Submit'])) {
        $content = $_POST['content'];
        $created_at = time();
        $updated_at = time();
        $result = mysqli_query($con, "INSERT INTO comments( post_id,content,created_at,updated_at) VALUES ('$id','$content', NOW(), NOW())");
    }

    $commentQuery = mysqli_query($con, $query);
?>


<div class="container mt-4">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h5><?php echo $postData['content']; ?></h5>
            <form method="POST" action="post.php?id=<?php echo $_GET['id']; ?>">
                <div>
                    <textarea name="content" class="form-control" value="<?php echo $postData['content']; ?>"></textarea>
                </div>

                <div class="d-flex justify-content-end me-0 mt-1">
                    <button type="submit" class="btn btn-primary" name="Submit">Comment</button>
                </div>

                <div>
                    <label>Comment</label>
                </div>
                <?php
                    while ($comment = mysqli_fetch_array($commentQuery)){
                ?>

                <div>
                    <label><?php echo $comment['content']; ?></label>
                </div>

                <?php
                }
                ?>
            </form>
        </div>
    </div>
</div>


