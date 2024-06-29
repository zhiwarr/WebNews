<?php include 'nav.php';?>
<?php 
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.php');
}
else{
if($_GET['action']='del')
{
$postid=intval($_GET['pid']);
$query=mysqli_query($conn,"update tblposts set Is_Active=0 where id='$postid'");
if($query)
{
$msg=":)پۆستەکە سڕایەوە ";
}
else{
$error="هەڵەیەک هەیە تکایە دووبارە فۆرمەکە پر بکەوە :(";    
} 
}
?>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2 class="text-white">بەڕێوبردنی <b>پۆستەکان</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="addPost.php" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>زیادکردنی هەواڵ</span></a>
						<a href="trashPosts.php" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>سڕینەوەی هەواڵەکان</span></a>						
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
                        <th>ناونیشانی هەواڵ</th>
                        <th>وێنەی هەواڵ</th>
                        <th>جۆر</th>
						<th>پۆل</th>
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

$query=mysqli_query($conn,"select tblposts.id as postid,tblposts.PostTitle as title,tblposts.PostImage as image,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId  where tblposts.Is_Active=1 order by tblposts.PostTitle desc limit $start_from , $num_per_page");

$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>
<tr>
<td colspan="4" align="center"><h3 style="color:red">هیچ دەیتایەک نەدۆزرایەوە</h3></td>
<tr>
<?php 
} else {
while($row=mysqli_fetch_array($query))
{
?>
 <tr>
    <td><span class="custom-checkbox">
								<input type="checkbox" id="checkbox" name="options[]" value="">
								<label for="checkbox"></label>
							</span></td>
<td><b><?php echo htmlentities($row['title']);?></b></td>
<td><img src="postimages/<?php echo  htmlentities($row['image']);?>" width="100" height="100" alt=""></td>
<td><?php echo htmlentities($row['category'])?></td>
<td><?php echo htmlentities($row['subcategory'])?></td>
<td>
                            <a href="editPost.php?pid=<?php echo htmlentities($row['postid']);?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="managePost.php?pid=<?php echo htmlentities($row['postid']);?>&&action=del" onclick="return confirm('دڵنیای لە سڕینەوەی دەیتاکە؟ ?')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
 </tr>
<?php } }?>                      
                </tbody>
            </table>

			<div class="clearfix">
                <div class="hint-text">پیشاندانی <b>5</b> دانە لە <b>25</b> دانە</div>
                <ul class="pagination">
                  
                    <?php
                    $sql="select * from tblposts";
                    $rs_result=mysqli_query($conn,$sql);
                    $total_records=mysqli_num_rows($rs_result);
                    $total_page=ceil($total_records/$num_per_page);



                    for($i=1;$i<=$total_page;$i++){

                    
                    ?>
                    <li class="page-item active"><a href="managePost.php?page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a></li>
<?php
}?>
                </ul>
            </div>
        </div>
    </div>
<?php 
}
include 'footer.php' ?>