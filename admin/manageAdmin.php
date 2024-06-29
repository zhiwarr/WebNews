<?php
include 'nav.php' ?>
<?php

error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    if ($_GET['action'] = 'del') {
        $id = intval($_GET['adminid']);
        $query = mysqli_query($conn, "UPDATE tbladmin set Is_Active=0 WHERE id='$id'");
        if ($query) {
            $msg = "ئەدمین سڕایەوە ";
        } else {
            $error = "هەڵەیەک هەیە تکایە دووبارە هەوڵ بدەوە";
        }
    }
?>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>گۆڕانکاری <b>ئەدمین</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="addAdmin.php" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>زیادکردنی ئەدمین</span></a>
                        <a href="#" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>سڕینەوەی ئەدمین</span></a>
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
                        <th>ناو</th>
                        <th>ئیمەڵ</th>
                        <th>وشەی نهێنی</th>
                        <th>بەرواری دروستبوون</th>
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

                    $query = mysqli_query($conn, "SELECT id,AdminUserName as user,AdminPassword as Pass ,AdminEmailId as email,CreationDate from tbladmin WHERE Is_Active =1 order by CreationDate limit $start_from,$num_per_page");
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
                            <td><b><?php echo htmlentities($row['user']); ?></b></td>
                            <td><b><?php echo htmlentities($row['email']); ?></b></td>
                            <td><?php echo htmlentities($row['Pass']) ?></td>
                            <td><?php echo htmlentities($row['CreationDate']) ?></td>
                            <td>
                                <a href="editAdmin.php?adminid=<?php echo htmlentities($row['id']); ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="manageAdmin.php?adminid=<?php echo htmlentities($row['id']); ?>&&action=del" onclick="return confirm('دڵنیای لە سڕینەوەی؟')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
<?php }
include 'footer.php' ?>