<?php include_once 'nav.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $catName = $_POST['category'];
    $status = 1;
    $query = mysqli_query($conn, "INSERT INTO `tblcategory`(`CategoryName`,`Is_Active`) value('$catName','$status')");
    if ($query) {
        $msg = "جۆرەکە بە سەرکەوتووی زیادکرا:) ";
    } else {
        $error = "هەڵەیەک هەیە تکایە دووبارە هەوڵ بدەوە:(";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <!---Success Message--->
            <?php if ($msg) { ?>
            <div class="alert alert-success" role="alert">
                <strong>پیرۆزە:)</strong> <?php echo htmlentities($msg); ?>
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
<div class="container col-8">
    <form name="addpost" method="post" enctype="multipart/form-data">
        <form class="row g-2 ">
            <div class="container bg-light text-dark p-3 w-75 m-5">
                <div class="col-md-6">
                    <label for="title" class="form-label">ناونیشانی جۆر:</label>
                    <input type="text" name="category" class="form-control" id="title">
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary mt-3">زیادکردن</button>
                    <button type="button" class="btn mt-3 btn-danger">لابردن</button>
                </div>
        </form>
</div>
</div>
<?php include_once 'footer.php'; ?>