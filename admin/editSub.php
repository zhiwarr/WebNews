<?php
include_once 'nav.php';

if (isset($_POST['update'])) {
    $subid = intval($_GET['subid']);
    $catName = $_POST['category'];
    $subName = $_POST['subcategory'];
    $query = mysqli_query($conn, "UPDATE tblsubcategory SET CategoryId='$catName' , Subcategory='$subName' WHERE SubCategoryId ='$subid'");
    if ($query) {
        $msg = "پۆلەکە بە سەرکەوتووی گۆردرا:) ";
    } else {
        $error = "هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە";
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
    $subid = intval($_GET['subid']);
    $query = mysqli_query($conn, "SELECT sub.SubCategoryId as subId,sub.CategoryId as catid,cat.CategoryName as catName,sub.Subcategory as Subcategory,sub.PostingDate FROM tblsubcategory sub left join tblcategory cat on sub.CategoryId = cat.id where SubCategoryId = '$subid'");
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="p-6">
                    <div class="">
                        <form name="UpdateCat" method="post">
                            <div class="form-group">
                                <input type="text" name="subid" value="<?php echo $row['subId'] ?>" hidden>
                                <label class="col-md-2 control-label">جۆر</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="category" required>
                                        <option value="<?php echo htmlentities($row['catid']); ?>"><?php echo htmlentities($row['catName']); ?></option>
                                        <?php
                                        // Feching active categories
                                        $ret = mysqli_query($conn, "select id,CategoryName from  tblcategory where Is_Active=1");
                                        while ($result = mysqli_fetch_array($ret)) {
                                        ?>
                                            <option value="<?php echo htmlentities($result['id']); ?>"><?php echo htmlentities($result['CategoryName']); ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">پۆل</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="<?php echo htmlentities($row['Subcategory']); ?>" name="subcategory" required>
                                </div>
                            </div>


                        <?php } ?>
                        <button type="submit" name="update" class="btn mt-4 btn-primary">نوێکردنەوە </button>
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

<?php include_once 'footer.php'; ?>