<?php include_once 'nav.php'; ?>
<?php

if (strlen($_SESSION['login']) == 0) {
  header('location:login.php');
} else {
  if (isset($_POST['submit'])) {
    $posttitle = $_POST['posttitle'];
    $catid = $_POST['category'];
    $subcatid = $_POST['subcategory'];
    $postdetails = $_POST['postdescription'];
    $postedby = $_SESSION['login'];
    $arr = explode(" ", $posttitle);
    $url = implode("-", $arr);
    $imgfile = $_FILES["postimage"]["name"];
    // get the image extension
    $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert(' jpg / jpeg/ png /gif  تکایە تەنیا وێنە داخڵ بکە کە پاشگرەکەیان ئەم وشانەیە');</script>";
    } else {
      //rename the image file
      $imgnewfile = md5($imgfile) . $extension;
      // Code for move image into directory
      move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

      $status = 1;
      $query = mysqli_query($conn, "insert into tblposts(PostTitle,CategoryId,SubCategoryId,PostDetails,PostUrl,Is_Active,PostImage,postedBy) values('$posttitle','$catid','$subcatid','$postdetails','$url','$status','$imgnewfile','$postedby')");
      if ($query) {
        $msg = "پۆستەکە بە سەرکەوتووی زیادکرا. ";
      } else {
        $error = "هەڵەیەک هەیە تیاکە دووبارە فۆرمەکە پر بکەرەوە.";
      }
    }
  } ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <!---Success Message--->
        <?php if ($msg) { ?>
          <div class="alert alert-success position-absolute" role="alert">
            <strong>پیرۆزە!</strong> <?php echo htmlentities($msg); ?>
          </div>
        <?php } ?>

        <!---Error Message--->
        <?php if ($error) { ?>
          <div class="alert alert-danger" role="alert">
            \ <?php echo htmlentities($error); ?></div>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="container ">
    <form name="addpost" method="post" enctype="multipart/form-data">
      <form class="row g-2 rounded-2">
        <div class="container bg-light text-dark p-3 w-75 m-5">
          <div class="col-md-12 col-lg-12">
            <label for="title" class="form-label">ناونیشانی هەواڵ</label>
            <input type="text" name="posttitle" placeholder="ناونیشانی هەواڵەکە بنوسە.." class="form-control" id="title">
          </div>
          <div class="col-8 w-100">
            <label for="validationTextarea" class="form-label">پوختەی هەواڵ</label>
            <textarea class="summernote form-control" name="postdescription" style="height:150px;" id="validationTextarea" placeholder="پوختەی هەواڵەکە بنوسە" required></textarea>
          </div>

          <script>
            CKEDITOR.replace('postdescription');
          </script>
          <div class="mb-3">
            <label for="formFile" class="form-label mt-3">وێنەی هەواڵ </label>
            <div class="holder">
              <img id="imgPreview" width="50%" class="mb-3" />
            </div>
            <input class="form-control" name="postimage" type="file" id="formFile">
          </div>
          <div class="col-md-4">
            <label for="inputState" class="form-label">ناوی جۆر</label>
            <select id="inputState" class="form-select form-group" name="category" id="category" onChange="getSubCat(this.value);" required>
              <option value="">هەڵبژێرە...</option>
              <?php
              // Feching active categories
              $ret = mysqli_query($conn, "select id,CategoryName from  tblcategory where Is_Active=1");
              while ($result = mysqli_fetch_array($ret)) {
              ?>
                <option value="<?php echo htmlentities($result['id']); ?>"><?php echo htmlentities($result['CategoryName']); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4 form-group">
            <label for="inputState" class="form-label">ناوی پۆل</label>
            <select class="form-control" name="subcategory" id="subcategory" required>

            </select>
          </div>

          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary mt-3">زیادکردن</button>
            <button type="button" class="btn mt-3 btn-danger">لابردن</button>
          </div>
      </form>
  </div>
  </div>

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



<?php
}


include_once 'footer.php'; ?>