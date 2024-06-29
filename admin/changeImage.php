<?php 

include 'nav.php';
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.php');
}
else{
if(isset($_POST['update']))
{

$imgfile=$_FILES["postimage"]["name"];
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["postimage"]["tmp_name"],"postimages/".$imgnewfile);
$postid=intval($_GET['pid']);
$query=mysqli_query($conn,"update tblposts set PostImage='$imgnewfile' where id='$postid'");
if($query)
{
$msg="نوێکردنەوەی وێنەکە بە سەرکەوتووی ئەنجام درا ";
}
else{
$error="هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە";    
} 
}
}
?>
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
<div class="container">
<div class="row">
<div class="col-sm-6">  
<!---Success Message--->  
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>پیرۆزە!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>
<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
 <?php echo htmlentities($error);?></div>
<?php } ?>
</div>
</div>
</div>
<form name="addpost" method="post" enctype="multipart/form-data">
<?php
$postid=intval($_GET['pid']);
$query=mysqli_query($conn,"select PostImage,PostTitle from tblposts where id='$postid' and Is_Active=1 ");
while($row=mysqli_fetch_array($query))
{
?>
  <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">ناونیشان</label>
<input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']);?>" name="posttitle"  readonly>
</div>
 <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>وێنە</b></h4>
<img src="postimages/<?php echo htmlentities($row['PostImage']);?>" width="300"/>
<br />
</div>
</div>
</div>
<?php } ?>
<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>وێنەی نوێ</b></h4>
<div class="holder">
              <img id="imgPreview" width="50%" class="mb-3" />
            </div>
<input type="file" class="form-control" id="formFile" name="postimage"  required>

</div>
</div>
</div>
<button type="submit" name="update" class="btn btn-primary w-25 m-3">نوێکردنەوە </button>
</form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
<?php 

}
 ?>
 <?php include 'footer.php';?>