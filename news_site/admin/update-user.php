<?php
if (isset($_POST['submit'])) {
    include("config.php");

    $userid = $_POST['user_id'];
    $fname = mysqli_real_escape_string($con, $_POST["f_name"]);
    $lname = mysqli_real_escape_string($con, $_POST["l_name"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $role = mysqli_real_escape_string($con, $_POST["role"]);

    $sql = "UPDATE news_site.user SET first_name = '$fname', last_name =  '$lname', username =  '$username', role =  $role WHERE user_id = $userid";
    $runsql = mysqli_query($con, $sql);

    header("Location: users.php");
};

?>

<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                include("config.php");

                $userid = $_GET['id'];

                $sql = "SELECT * FROM news_site.user WHERE user_id = '$userid'";
                $runsql = mysqli_query($con, $sql) or die("Query Field!");

                if (mysqli_num_rows($runsql) > 0) {

                    while ($row = mysqli_fetch_assoc($runsql)) {

                ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="">
                                    <?php
                                    if ($row['role'] == 1) {
                                        echo '<option value="0">normal User</option>
                                        <option value="1" selected>Admin</option>';
                                    } else {
                                        echo '<option value="0" selected>normal User</option>
                                        <option value="1" >Admin</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                        <!-- /Form -->
                <?php }
                }
                mysqli_close($con);

                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>