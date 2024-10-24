<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                include("config.php");
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $limit = 3;
                $offset = ($page - 1) * 3;
                $sql = "SELECT * FROM news_site.category LIMIT $offset,$limit";
                $runsql = mysqli_query($con, $sql) or die("Connection field!");


                if (mysqli_num_rows($runsql) > 0) {
                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($runsql)) { ?>
                                <tr>
                                    <td class='id'><?php echo $row['category_id'] ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['post'] ?></td>
                                    <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        </tbody>
                    <?php } ?>
                    </table>
                <?php
                } else {
                    echo "<h2>No Recods </h2>";
                }
                    $sql1 = "SELECT * FROM news_site.user";
                    $result1 = mysqli_query($con, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        $total_page = mysqli_num_rows($result1);
                        $total_recods = ceil($total_page / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo "<li><a href='category.php?page=" . ($page - 1) . "'>Prev</a></li>";
                        }

                        for ($i = 1; $i <= $total_recods; $i++) {
                            $active = $i == $page ? 'active' : '';
                            echo "<li class='$active'><a href='category.php?page=$i'>$i</a></li>";
                        }
                        if ($total_recods > $page) {
                            echo "<li><a href='category.php?page=" . ($page + 1) . "'>Next</a></li>";
                        }
                        echo " </ul>";
                    }
                

                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>