<?php
 include_once 'nav.php';
 error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
if(isset($_POST['update']))
{
$posttitle=$_POST['posttitle'];
$catid=$_POST['category'];
$subcatid=$_POST['subcategory'];
$postdetails=$_POST['postdescription'];
$lastuptdby=$_SESSION['login'];
$arr = explode(" ",$posttitle);
$url=implode("-",$arr);
$status=1;
$postid=intval($_GET['pid']);
$query=mysqli_query($conn,"update tblposts set PostTitle='$posttitle',CategoryId='$catid',SubCategoryId='$subcatid',PostDetails='$postdetails',PostUrl='$url',Is_Active='$status',lastUpdatedBy='$lastuptdby' where id='$postid'");
if($query)
{
$msg="گۆڕانکاری لە پۆستەکە کرا:) ";
}
else{
$error="هەڵەیەک هەیە تکایە دووبارە هەوڵ بدەوە:(";    
} 
}
?>
<div class="container">
<div class="row">
<div class="col-sm-6">  
<!---Success Message--->  
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>پیرۆزە !</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>
<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
 <?php echo htmlentities($error);?></div>
<?php } ?>
</div>
</div>
<?php
$postid=intval($_GET['pid']);
$query=mysqli_query($conn,"select tblposts.id as postid,tblposts.PostImage,tblposts.PostTitle as title,tblposts.PostDetails,tblcategory.CategoryName as category,tblcategory.id as catid,tblsubcategory.SubCategoryId as subcatid,tblsubcategory.Subcategory as subcategory from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$postid' and tblposts.Is_Active=1 ");
while($row=mysqli_fetch_array($query))
{
?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form class="shadow p-3" name="addpost" method="post">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">ناونیشانی هەواڵ</label>
<input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['title']);?>" name="posttitle" placeholder="ناونیشانی هەواڵەکە" required>
</div>
<div class="form-group m-b-20">
<label for="exampleInputEmail1">جۆر</label>
<select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
<option value="<?php echo htmlentities($row['catid']);?>"><?php echo htmlentities($row['category']);?></option>
<?php
// Feching active categories
$ret=mysqli_query($conn,"select id,CategoryName from  tblcategory where Is_Active=1");
while($result=mysqli_fetch_array($ret))
{    
?>
<option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
<?php } ?>
</select> 
</div>
<div class="form-group m-b-20">
<label for="exampleInputEmail1">پۆل</label>
<select class="form-control" name="subcategory" id="subcategory" required>
<option value="<?php echo htmlentities($row['subcatid']);?>"><?php echo htmlentities($row['subcategory']);?></option>
</select> 
</div>
     <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>پوختەی پۆستەکە</b></h4>
<textarea class="summernote col-12" style="height:150px;" name="postdescription" required><?php echo htmlentities($row['PostDetails']);?></textarea>
<script>
            CKEDITOR.replace('postdescription');
          </script>
</div>
</div>
</div>
 <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="header-title"><b> گۆڕانکاری لە وێنەکە بکە</b></h4>
<a  href="changeImage.php?pid=<?php echo htmlentities($row['postid']);?>"><img  src="postimages/<?php echo htmlentities($row['PostImage']);?>" width="300"/></a>

<br />
</div>
</div>
</div>
<?php } ?>
<button type="submit"  name="update" class="btn m-1 w-25 btn-primary">گۆڕانکاری </button>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
              
<script>
function getSubCat(val) {
  $.ajax({
  type: "POST",
  url: "get_subcategory.php",
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
  }
  });
  }
  </script>

<?php } include_once 'footer.php';?>