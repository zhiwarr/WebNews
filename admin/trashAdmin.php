<?php include 'nav.php'; ?>
<?php
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    if ($_GET['action'] = 'restore') {
        $adminid = intval($_GET['adminid']);
        $query = mysqli_query($conn, "update tbladmin set Is_Active=1 where id='$adminid'");
        if ($query) {
            $msg = "ئەدمینەکە بە سەرکەوتووی گەڕایەوە :) ";
        } else {
            $error = "هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە:(";
        }
    }
    // Code for Forever deletionparmdel
    if ($_GET['admin']) {
        $id = intval($_GET['admin']);
        $query = mysqli_query($conn, "delete from  tbladmin  where id='$id'");
        $delmsg = "ئەدمینەکە بە تەواوی سڕایەوە";
    }

?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <?php if ($delmsg) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlentities($delmsg); ?></div>
                <?php } ?>
            </div>
            <div class="container">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2 class="text-white">ئەدمینە <b>سڕاوەکان</b></h2>
                            </div>

                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll"></label>
                                    </span>
                                </th>
                                <th>ئەدمین</th>
                                <th>ژمارەی نهێنی</th>
                                <th>کاتی دروستبوون</th>
                                <th>کردارەکان</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $num_per_page=04;

                            if(isset($_GET["page"])){
                             $page=$_GET["page"];
                            }
                            else{
                             $page=1;
                            }
                            $start_from=($page-1)*05;
                            $query = mysqli_query($conn, "SELECT * From tbladmin WHERE Is_Active=0 order by CreationDate limit $start_from,$num_per_page");
                            $rowcount = mysqli_num_rows($query);
                            if ($rowcount == 0) {
                            ?>
                                <tr>
                                    <td colspan="4" align="center">
                                        <h3 style="color:red">هیچ دەیتایەک نەدۆزرایەوە</h3>
                                    </td>
                                <tr>
                                    <?php
                                } else {
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                <tr>
                                    <td><span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox" name="options[]" value="">
                                            <label for="checkbox"></label>
                                        </span></td>
                                    <td><b><?php echo htmlentities($row['AdminUserName']); ?></b></td>
                                    <td><?php echo htmlentities($row['AdminPassword']) ?></td>
                                    <td><?php echo htmlentities($row['CreationDate']) ?></td>

                                    <td>
                                        <a href="trashAdmin.php?adminid=<?php echo htmlentities($row['id']); ?>&&action=restore" onclick="return confirm('دڵنیای لە گەڕانەوەی ئەم ئەدمینە?')"><i style="color:blue" class="material-icons" title="Restore this Admin">&#xe8b3;</i></a>
                                        <a href="trashAdmin.php?admin=<?php echo htmlentities($row['id']); ?>&&action=perdel" onclick="return confirm('دڵنیای لە سڕینەوەی ئەم ئەدمینە بە تەواوی ?')"><i class="material-icons" style="color:red" data-toggle="tooltip" title="Permanently delete this post" title="Delete">&#xE872;</i></a>
                                    </td>
                                </tr>
                                </tr>
                        <?php }
                                } ?>
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text">پیشاندانی <b>5</b> دانە لە <b>25</b> دانە</div>
                        <ul class="pagination">
                        <?php
                    $sql="select * from tbladmin";
                    $rs_result=mysqli_query($conn,$sql);
                    $total_records=mysqli_num_rows($rs_result);
                    $total_page=ceil($total_records/$num_per_page);



                    for($i=1;$i<=$total_page;$i++){

                    
                    ?>
                    <li class="page-item active"><a href="manageAdmin.php?page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a></li>
<?php
}?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php } ?>
<?php include 'footer.php'; ?>