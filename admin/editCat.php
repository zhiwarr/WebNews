<?php
include_once 'nav.php';
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:login.php');
}
else{
if (isset($_POST['update'])) {
    $catid = $_POST['catid'];
    $catName = $_POST['catname'];
    $query = mysqli_query($conn, "UPDATE tblcategory SET CategoryName='$catName' WHERE id='$catid'");
    if ($query) {
        $msg = "گۆڕانکاری لە پۆستەکە کرا:) ";
        header("Location:manageCat.php?updated");
    } else {
        $error = "هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە:(";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <!---Success Message--->
            <?php if ($msg) { ?>
                <div class="alert alert-success" role="alert">
                    <strong>پیرۆزە!</strong> <?php echo htmlentities($msg); ?>
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
    <?php
    $catid = intval($_GET['cid']);
    $query = mysqli_query($conn, "SELECT tblcategory.id as catId ,CategoryName FROM tblcategory where is_active=1 and id='$catid'");
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <div class="row">
            <div class="col-md-4  col-md-offset-1">
                <div class="p-6">
                    <div class="">
                        <form name="UpdateCat" method="post">
                            <div class="form-group m-b-20">
                                <label for="cat">جۆر</label>
                                <input value="<?php echo htmlentities($row['catId']); ?>" name="catid" hidden>
                                <input type="text" class="form-control" id="cat" value="<?php echo htmlentities($row['CategoryName']); ?>" name="catname" placeholder="Enter title" required>
                            </div>

                        <?php } ?>
                        <button type="submit" name="update" class="btn mt-3 btn-success">نوێکردنەوە </button>
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
            data: 'catid=' + val,
            success: function(data) {
                $("#subcategory").html(data);
            }
        });
    }
</script>

<?php } include_once 'footer.php'; ?>