
<?php
include 'layout/header.php';

?>
 <div class="container mt-4">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="mt-4">
                    <?php
                        if (isset($_GET['Search'])) {
                            $search = $_GET['name'];
                            $min_length = 1;
                            if (strlen($search) < $min_length) {
                                header('Location: index.php');
                            } else {
                                $query = mysqli_query($con,"SELECT * FROM users1 WHERE name LIKE '%$search%' AND email LIKE '%$search%' ");
                                    while ($row = mysqli_fetch_array($query)){
                                    ?>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <a href="user/profile.php?id=<?php echo $row['id']; ?>"> <?php echo $row['name'] . "<br>"; ?> </a>
                                        <?php
                                        echo $row['email'];
                                        echo "<br>";
                                    ?>
                                        <div class="d-flex justify-content-end me-0 mt-1">
                                            <button type="submit" name="submit1" class="btn btn-primary">Follow</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                            }
                        }
                     ?>
            </div>
        </div>
    </div>
</div>
