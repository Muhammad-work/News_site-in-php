c<?php
if (isset($_POST['sumbit'])) {
    include("config.php");
    $userid = $_GET['id'];
    $categoryname = mysqli_real_escape_string($con,$_POST['cat_name']);
    $sql = "UPDATE news_site.category SET Category_name = '$categoryname' WHERE category_id = $userid";
    $runsql = mysqli_query($con , $sql) or die("Query Felid!");
    header("Location: category.php");
}
?>

<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                include("config.php");

                $userid = $_GET['id'];

                $sql = "SELECT * FROM news_site.category WHERE category_id = '$userid'";
                $runsql = mysqli_query($con, $sql) or die("Query Feild!");

                if (mysqli_num_rows($runsql) > 0) {

                    while ($row = mysqli_fetch_assoc($runsql)) {
                ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>