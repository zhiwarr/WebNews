<?php 
include 'nav.php' ?>
<?php
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.php');
}
else{
if ($_GET['action'] = 'del') {
    $subId = intval($_GET['subid']);
    $query = mysqli_query($conn, "update tblsubcategory set Is_Active=0 where SubCategoryId='$subId'");
    if ($query) {
        $msg = "پۆلەکە بە سەرکەوتووی سڕایەوە:) ";
    } else {
        $error = "هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە:(";
    }
}
?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>بەڕیوبردنی  <b>پۆل</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="addSubCat.php" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>زیادکردنی پۆلی نوێ</span></a>
                    <a href="#" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>سڕینەوەی پۆلەکان</span></a>
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
                    <th>ناوی جۆر</th>
                    <th>ناوی پۆل</th>
                    <th>کاتی دروستکردنی پۆل</th>
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
          
                $query = mysqli_query($conn, "SELECT sub.SubCategoryId as subId,sub.CategoryId,cat.CategoryName as catName,sub.Subcategory as Subcategory,sub.PostingDate FROM tblsubcategory sub left join tblcategory cat on sub.CategoryId = cat.id where cat.is_Active=1 order by sub.PostingDate limit $start_from,$num_per_page");
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
                            <td><?php echo htmlentities($row['Subcategory']) ?></td>
                        <td><b><?php echo htmlentities($row['catName']); ?></b></td>
                        
                        <td><?php echo htmlentities($row['PostingDate']) ?></td>
                        <td>
                            <a href="editsub.php?subid=<?php echo htmlentities($row['subId']); ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="manageSub.php?subid=<?php echo htmlentities($row['subId']); ?>&&action=del" onclick="return confirm('دڵنیایت لە سڕینەوەی ئەم پۆلە؟ ?')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
                    $sql="select * from tblSubCategory";
                    $rs_result=mysqli_query($conn,$sql);
                    $total_records=mysqli_num_rows($rs_result);
                    $total_page=ceil($total_records/$num_per_page);



                    for($i=1;$i<=$total_page;$i++){

                    
                    ?>
                    <li class="page-item active"><a href="manageSub.php?page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a></li>
<?php
}?>
            </ul>
        </div>
    </div>
</div>
<?php } include 'footer.php' ?>