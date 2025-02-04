<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
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
                $sql = "SELECT * FROM news_site.user 
                LIMIT $offset,$limit";
                $runsql = mysqli_query($con, $sql) or die("Query field!");

                if (mysqli_num_rows($runsql) > 0) {
                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($runsql)) { ?>
                                <tr>
                                    <td class='id'><?php echo $row['user_id'] ?></td>
                                    <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php
                                        if ($row['role'] == 1) {
                                            echo "Admin";
                                        } else {
                                            echo "Normal user";
                                        }
                                        ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php  }else{
                    echo "<h2>No User Recods</h2>";
                }

                $sql1 = "SELECT * FROM news_site.user";
                $result1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    $total_page = mysqli_num_rows($result1);
                    $total_recods = ceil($total_page / $limit);

                    echo "  <ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo "<li><a href='users.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    }

                    for ($i = 1; $i <= $total_recods; $i++) {
                        $active = $i == $page ? 'active' : '';
                        echo "<li class='$active'><a href='users.php?page=$i'>$i</a></li>";
                    }
                    if ($total_recods > $page) {
                        echo "<li><a href='users.php?page=" . ($page + 1) . "'>Next</a></li>";
                    }
                    echo " </ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>