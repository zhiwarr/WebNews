<?php include 'nav.php';?>
<?php
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.php');
}
else{
if($_GET['action']='restore')
{
$postid=intval($_GET['pid']);
$query=mysqli_query($conn,"update tblposts set Is_Active=1 where id='$postid'");
if($query)
{
$msg="پۆستەکە بە سەرکەوتووی گەڕایەوە :) ";
}
else{
$error="هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە:(";    
} 
}
// Code for Forever deletionparmdel
if($_GET['presid'])
{
    $id=intval($_GET['presid']);
    $query=mysqli_query($conn,"delete from  tblposts  where id='$id'");
    $delmsg="پۆستەکە بە تەواوی سڕایەوە";
}

?>
<div class="container">
<div class="row">
<div class="col-sm-6">  
<?php if($delmsg){ ?>
<div class="alert alert-danger" role="alert">
 <?php echo htmlentities($delmsg);?></div>
<?php } ?>
</div>
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2 class="text-white">پۆستە  <b>سڕاوەکان</b></h2>
					</div>
					<div class="col-sm-6">
						
						<a href="#" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>سرینەوەی پۆست</span></a>						
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
                        <th>جۆر</th>
						<th>پۆل</th>
                        <th>کردارەکان</th>
                    </tr>
                </thead>
                <tbody>
<?php
$query=mysqli_query($conn,"select tblposts.id as postid,tblposts.PostTitle as title,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=0");
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
<td><?php echo htmlentities($row['category'])?></td>
<td><?php echo htmlentities($row['subcategory'])?></td>
<td>
<a href="trashPosts.php?pid=<?php echo htmlentities($row['postid']);?>&&action=restore" onclick="return confirm('دڵنیای لە گەڕانەوەی ئەم پۆستە?')"><i style="color:blue" class="material-icons" title="Restore this Post">&#xe8b3;</i></a>
<a href="trashPosts.php?presid=<?php echo htmlentities($row['postid']);?>&&action=perdel" onclick="return confirm('دڵنیای لە سڕینەوەی ئەم پۆستە بە تەواوی ?')"><i class="material-icons" style="color:red" data-toggle="tooltip" title="Permanently delete this post" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
 </tr>
<?php } }?>                      
                </tbody>
            </table>
			<div class="clearfix">
            <div class="hint-text">پیشاندانی <b>5</b> دانە لە <b>25</b> دانە</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">گەڕانەوە</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item "><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">دواتر</a></li>
                </ul>
            </div>
        </div>
    </div>          
                                    </div>
                                </div>
                           
                    

<?php } ?>
<?php include 'footer.php';?>