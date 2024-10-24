<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->

                <?php
                include("config.php");

                if (isset($_POST['save'])) {
                    $fname = mysqli_real_escape_string($con, $_POST["fname"]);
                    $lname = mysqli_real_escape_string($con, $_POST["lname"]);
                    $username = mysqli_real_escape_string($con, $_POST["user"]);
                    $password = mysqli_real_escape_string($con, md5($_POST["password"]));
                    $role = mysqli_real_escape_string($con, $_POST["role"]);

                    $sql = "SELECT username FROM news_site.user where username = '$username'";
                    $runsql = mysqli_query($con, $sql) or die("query Feild!");

                    if (mysqli_num_rows($runsql) > 0) {
                        echo "<p style='color:red; text-align: center; margin: 10px 0px;'>User already Exists</p>";
                    } else {

                        $sql = "INSERT INTO news_site.user (first_name, last_name, username, password, role) 
                            VALUES ('$fname', '$lname', '$username', '$password', $role)";

                        if (mysqli_query($con, $sql)) {
                            header("Location: users.php");
                        };
                    }
                }
                mysqli_close($con);
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>