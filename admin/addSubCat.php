<?php include 'nav.php';
?>
<?php
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    if (isset($_POST['add'])) {
        $categoryid = $_POST['category'];
        $subcatname = $_POST['name'];
        $status = 1;
        $query = mysqli_query($conn, "insert into tblsubcategory(CategoryId,Subcategory,Is_Active) values('$categoryid','$subcatname','$status')");
        if ($query) {
            $msg = "پۆلەکە بە سەرکەوتی دروست بوو ";
        } else {
            $error = ":(هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە";
        }
    }


?>
<div class="container">
<div class="row ">
    <div class="col-sm-6">
        <!---Success Message--->
        <?php if ($msg) { ?>
            <div class="alert alert-success" role="alert">
                <strong>پیرۆزە! </strong> <?php echo htmlentities($msg); ?>
            </div>
        <?php } ?>

        <!---Error Message--->
        <?php if ($error) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlentities($error); ?>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<form method="POST">
    <div class="container text-dark mt-4 col-6 bg-light p-4 rounded-top">
        <div class="form-group">
            <h4 class="text-center font-weight-bold text-primary">زیادکردنی پۆل</h4>
            <label for="exampleFormControlInput1">ناوی پۆل</label>
            <input type="text" name="name" class="form-control" required placeholder="ناوی پۆل">
        </div>
        <div class="form-group">
            <label for="category">دیاری کردنی جۆری پۆلەکە</label>
            <select name="category" class="form-control" id="category">
                <?php
            $ret=mysqli_query($conn,"select id,CategoryName from  tblcategory where Is_Active=1");
while($result=mysqli_fetch_array($ret))
{    
?>
<option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
<?php } ?>

                                                        </select> 
	              </div>
	                                     
                                          
            <input class="btn mt-4 btn-primary" type="submit" name="add" value="زیادکردنی پۆل">
                                    
	                   </div>

  
</form>


<?php } include 'footer.php' ?>