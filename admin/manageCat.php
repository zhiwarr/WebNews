<?php include 'nav.php' ?>

<?php
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.php');
}
else{
if ($_GET['action'] = 'del') {
    $catId = intval($_GET['cid']);
    $query = mysqli_query($conn, "update tblcategory set Is_Active=0 where id='$catId'");
    if ($query) {
        $msg = "بەشەکە سڕایەوە ";
    } else {
        $error = "هەڵەیەک هەیە تکایە دووبارە فۆرمەکە پر بکەوە";
    }
}
?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>بەڕێوبردنی <b>جۆر</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="addCategory.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>زیادکردنی جۆر </span></a>
                    <a href="trashCat.php" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>لابردن</span></a>
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
                    <th>جۆر</th>
                    <th>کاتی زیادکردنی جۆر</th>
                    <th>کاتی گۆڕانکاری لە جۆرەکە</th>
                    <th>کردارەکان</th>
                </tr>
               
            </thead>
            <tbody>
                <?php
                 $num_per_page=05;

                 if(isset($_GET["page"])){
                  $page=$_GET["page"];
                 }
                 else{
                  $page=1;
                 }
                 $start_from=($page-1)*05;


                $query = mysqli_query($conn, "select tblcategory.id as catId,tblcategory.CategoryName as category,tblcategory.PostingDate as Date,tblcategory.UpdationDate as UDate From tblcategory  where Is_Active=1 order by tblcategory.PostingDate  limit $start_from , $num_per_page ");
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
                        <td><b><?php echo htmlentities($row['category']); ?></b></td>
                        <td><b><?php echo htmlentities($row['Date']); ?></b></td>
                        <td><b><?php echo htmlentities($row['UDate']); ?></b></td>
                        <td>
                            <a href="editCat.php?cid=<?php echo htmlentities($row['catId']); ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="manageCat.php?cid=<?php echo htmlentities($row['catId']); ?>&&action=del" onclick="return confirm('Do you reaaly want to delete ?')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
                    $sql="select * from tblcategory";
                    $rs_result=mysqli_query($conn,$sql);
                    $total_records=mysqli_num_rows($rs_result);
                    $total_page=ceil($total_records/$num_per_page);



                    for($i=1;$i<=$total_page;$i++){

                    
                    ?>
                    <li class="page-item active"><a href="manageCat.php?page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a></li>
<?php
}?>

             
            </ul>
        </div>
    </div>
</div>
<?php } include 'footer.php' ?>