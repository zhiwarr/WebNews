<?php
include 'nav.php';
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.php');
}
else{
if(isset($_POST['submit']))
{
$aid=intval($_GET['adminid']);
$email=$_POST['emailid'];
$username=$_POST['adminusernmae'];
$password=$_POST['password'];
$query=mysqli_query($conn,"Update  tbladmin set AdminEmailId='$email' ,AdminUserName='$username' ,AdminPassword='$password'  where userType=0 && id='$aid'");
if($query)
{
echo "<script>alert('بەسەرکەوتووی نوێکرایەوە');</script>";
}
else{
echo "<script>alert('هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە');</script>";
} 
}


?>
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
<?php 
$aid=intval($_GET['adminid']);
$query=mysqli_query($conn,"Select * from  tbladmin where userType=0 && id='$aid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
<div class="container">
                        			<div class="row">
                        				<div class="col-md-6">
                        		<form class="form-horizontal" name="suadmin" method="post">
	                                            <div class="form-group">
	                                   <label class="col-md-2 control-label">ناو</label>
	                                   <div class="col-md-10">
	                                       <input type="text" class="form-control" value="<?php echo htmlentities($row['AdminUserName']);?>" name="adminusernmae" >
	                                                </div>
	                                            </div>
                 
            <div class="form-group">
            <label class="col-md-2 control-label">ئیمەیڵ</label>
            <div class="col-md-10">
            <input type="text" class="form-control" value="<?php echo htmlentities($row['AdminEmailId']);?>" name="emailid" required>
           </div>
           </div>
           <div class="form-group">
            <label class="col-md-2 control-label">پاسۆرد</label>
            <div class="col-md-10">
            <input type="text" class="form-control" value="<?php echo htmlentities($row['AdminPassword']);?>" name="password" required>
           </div>
           </div>     
             <div class="form-group">
            <label class="col-md-4 control-label">کاتی دروستکردنی پرۆفایل</label>
            <div class="col-md-10">
            <input type="text" class="form-control" value="<?php echo htmlentities($row['CreationDate']);?>" name="cdate" readonly>
           </div>
           </div>

             <div class="form-group">
            <label class="col-md-4 control-label">کاتی نوێکردنەوە</label>
            <div class="col-md-10">
            <input type="text" class="form-control" value="<?php echo htmlentities($row['UpdationDate']);?>" name="udate" readonly>
           </div>
           </div>
<?php } ?>
        <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">
                                                  
                                                <button type="submit" class="btn btn-primary btn-md" name="submit">
                                                    نوێکردنەوە
                                                </button>
                                                    </div>
                                                </div>

	                                        </form>
                        				</div>


                        			</div>


                                </div>
                            </div>
                        </div>

                    </div> 

<?php } include 'footer.php'; ?>