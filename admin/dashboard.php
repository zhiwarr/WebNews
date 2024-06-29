<?php include 'nav.php'; ?>
<div class="container">
  <div class="row">




    <div class="col-3">

      <div class="wrimagecard wrimagecard-topimage py-3">

        <a href="./managePost.php">
          <div class="wrimagecard-topimage_header ">
            <img src="../assets/image/Windows-pana.svg" width="50%" alt="">
          </div>
          <div class="wrimagecard-topimage_title my-3">
            <?php $query = mysqli_query($conn, "select * from tblposts where Is_Active=1");
            $countposts = mysqli_num_rows($query);
            ?>
            <h4><?php echo htmlentities($countposts); ?> </h4>


            <h4>هەواڵ
            </h4>

          </div>

        </a>
      </div>
    </div>

    <div class="col-3">

      <div class="wrimagecard wrimagecard-topimage py-3">

        <a href="./manageCat.php">
          <div class="wrimagecard-topimage_header ">
            <img src="../assets/image/Collaboration-bro.svg" width="50%" alt="">
          </div>
          <div class="wrimagecard-topimage_title my-3">
            <?php $query = mysqli_query($conn, "select * from tblcategory where Is_Active=1");
            $countcat = mysqli_num_rows($query);
            ?> <h4><?php echo htmlentities($countcat); ?></h4>

            <h4>جۆر
            </h4>



          </div>

        </a>
      </div>
    </div>


    <div class="col-3">

      <div class="wrimagecard wrimagecard-topimage py-3">

        <a href="./manageSub.php">
          <div class="wrimagecard-topimage_header ">
            <img src="../assets/image/Filter-amico.svg" width="50%" alt="">
          </div>
          <div class="wrimagecard-topimage_title my-3">
            <?php $query = mysqli_query($conn, "select * from tblsubcategory where Is_Active=1");
            $countsubcat = mysqli_num_rows($query);
            ?>
            <h4><?php echo htmlentities($countsubcat); ?> </h4>

            <h4>پۆل
            </h4>


          </div>

        </a>
      </div>
    </div>



    <div class="col-3">

      <div class="wrimagecard wrimagecard-topimage py-3">

        <a href="./manageAdmin.php">
          <div class="wrimagecard-topimage_header ">
            <img src="../assets/image/admin.svg" width="50%" alt="">
          </div>
          <div class="wrimagecard-topimage_title my-3">
            <?php $query = mysqli_query($conn, "select * from tblAdmin where Is_Active = 1");
            $countposts = mysqli_num_rows($query);
            ?>

            <h4><?php echo htmlentities($countposts); ?> </h4>

            <h4>ئەدمین
            </h4>


          </div>

        </a>
      </div>
    </div>



    <div class="col-3">

      <div class="wrimagecard wrimagecard-topimage py-3">

        <a href="./trashPosts.php">
          <div class="wrimagecard-topimage_header ">
            <img src="../assets/image/Empty-pana.svg" width="50%" alt="">
          </div>
          <div class="wrimagecard-topimage_title my-3">
            <?php $query = mysqli_query($conn, "select * from tblposts where Is_Active=0");
            $countposts = mysqli_num_rows($query);
            ?>

            <h4><?php echo htmlentities($countposts); ?> </h4>

            <h4>پۆستە سڕواوەکان
            </h4>


          </div>

        </a>
      </div>
    </div>


    <div class="col-3">

      <div class="wrimagecard wrimagecard-topimage py-3">

        <a href="./trashCat.php">
          <div class="wrimagecard-topimage_header ">
            <img src="../assets/image/removecat.svg" width="50%" alt="">
          </div>
          <div class="wrimagecard-topimage_title my-3">
            <?php $query = mysqli_query($conn, "select * from tblCategory where Is_Active=0");
            $countposts = mysqli_num_rows($query);
            ?>

            <h4><?php echo htmlentities($countposts); ?> </h4>

            <h4>جۆرە سڕاوەکان
            </h4>


          </div>

        </a>
      </div>
    </div>


    <div class="col-3">

      <div class="wrimagecard wrimagecard-topimage py-3">

        <a href="./trashAdmin.php">
          <div class="wrimagecard-topimage_header ">
            <img src="../assets/image/removeadmin.svg" width="50%" alt="">
          </div>
          <div class="wrimagecard-topimage_title my-3">
            <?php $query = mysqli_query($conn, "select * from tbladmin where Is_Active=0");
            $countposts = mysqli_num_rows($query);
            ?>

            <h4><?php echo htmlentities($countposts); ?> </h4>

            <h4>ئەدمینی سڕاوە
            </h4>


          </div>

        </a>
      </div>
    </div>


    <?php include 'footer.php'; ?>