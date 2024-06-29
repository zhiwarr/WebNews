<?php
include './_Partials/nav.php';
?>
<main dir="rtl">
<section id="contentSection">
    <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <div class="page-wrapper">
                            <div class="blog-grid-system">
                                <div class="row">

                                <?php 
            if(isset($_GET['subcategory'])){
            $latest = "SELECT *, p.id as pid FROM tblposts p join tblsubcategory s on p.SubCategoryId=s.SubCategoryId join tblcategory c on s.CategoryId=c.id where s.SubCategoryId =". $_GET['subcategory']." order by p.PostingDate desc limit 10";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["PostTitle"];
                $img = $rows["PostImage"];
                $description = $rows["PostDetails"];
                $news_id = $rows["id"];
                $date=$rows["PostingDate"];
                $admin=$rows["postedBy"];
                $sub=$rows["Subcategory"];
                $cate=$rows["CategoryName"];
                $post=$rows['pid'];

                //date
                $in_date=time()-strtotime($date);

                ?>




                                    <div class="col-md-6 con p-1" >
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="detail.php?id=<?php echo $post?>&sid=<?php echo $rows['SubCategoryId'];?>" >
                                                <img style="height: 200px; width: 400px;" class="rounded" src="admin/postimages/<?php echo $img; ?>"  />
                                                
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta big-meta">
                                            <span class="btn-cate my-5 rounded-2"><a class="text-white" href="detail.php?id=<?php echo $post?>&sid=<?php echo $rows['SubCategoryId'];?>"><?php  echo $sub; ?></a></span>
                                                <span class="btn-cate text-white d-inline-block m-1 rounded-2"><a class="text-white" href="detail.php?id=<?php echo $post?>&sid=<?php echo $rows['SubCategoryId'];?>"><?php  echo $cate; ?></a></span>
                                               
                                                <h4>
                                                  <a href="detail.php?id=<?php echo $post?>&sid=<?php echo $rows['SubCategoryId'];?>"  class="head_allpost "><?php echo $heading; ?></a>
                                                </h4>
                                                <div class="container d-flex justify-content-between">
                                                <small>
                                                  <a  href="detail.php?id=<?php echo $post?>&sid=<?php echo $rows['SubCategoryId'];?>" ><?php echo round($in_date/(60*60*24))." ڕۆژ لەمەوپێش";?>
                                                </a>
                                              </small>
                                                <small><a class="" href="detail.php?id=<?php echo $rows['id']?>&sid=<?php echo $rows['SubCategoryId'];?>" >پۆستکراوە لەلایەن <b><?php echo $admin."وە";?></b></a></small>
                                                </div>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->

                                 <?php } }}?>
                                
                                   
                                </div><!-- end row -->
                            </div><!-- end blog-grid-system -->
                        </div><!-- end page-wrapper -->


                    </div><!-- end col -->
              
    
        <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>ئەمانەش ببینە</span></h2>
          <div class="latest_post_container" style="height:500p; overflow: auto;">
            <ul class="latest_postnav " >

            <!-- ADDING LATEST NEWS---------------------------------------------------------------------- -->
            <?php 

            $latest = "SELECT * FROM tblposts ORDER BY RAND() DESC LIMIT 10";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["PostTitle"];
                $img = $rows["PostImage"];
                $id = $rows["id"];
                
                ?>
                <li>
                <div class="media d-flex"> <a href="detail.php?id=<?php echo $id?>&sid=<?php echo $rows['SubCategoryId'];?>" class="media-left"> <img alt="" src="./admin/postimages/<?php echo $img; ?>"> </a>
                  <div class="media-body border-bottom"> <a href="detail.php?id=<?php echo $id ?>&sid=<?php echo $rows['SubCategoryId'];?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                </div>
              </li>
              <?php

              }
            }
            ?>
            </ul>
          </div>
        </div>

        <aside class="right_content">
        <div class="latest_post">
            <h2><span>نوێترین هەواڵ</span></h2>
            <div class="latest_post_container" style="height:500p; overflow: auto;">
            <ul class="spost_nav pt-4"  >

            <!-- ADDING POPULAR NEWS --------------------------------------------------------------->
            <?php 
                $latest = "SELECT * FROM tblposts ORDER BY PostingDate DESC LIMIT 10";
                $latest_n = mysqli_query($conn , $latest);
                if($latest_n){
                 
                  while( $rows = mysqli_fetch_assoc($latest_n) ){
                    $heading = $rows["PostTitle"];
                    $img = $rows["PostImage"];
                    $id = $rows["id"];
                   
                    ?>
                    <li>
                    <div class="media d-flex"> <a href="detail.php?id=<?php echo $post ?>&sid=<?php echo $rows['SubCategoryId'];?>" class="media-left"> <img alt="" src="./admin/postimages/<?php echo $img; ?>"> </a>
                      <div class="media-body border-bottom"> <a href="detail.php?id=<?php echo $post ?>&sid=<?php echo $rows['SubCategoryId'];?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                    </div>
                  </li>
                  <?php
                  }
                }
                ?>
            </ul>
          </div>
          </div>
        <div class="latest_post">
            <h2><span> زۆرترین خوێنراو</span></h2>
            <div class="latest_post_container" style="height:500p; overflow: auto;">
            <ul class="spost_nav pt-4"  >

            <!-- ADDING POPULAR NEWS --------------------------------------------------------------->
            <?php 
                $latest = "SELECT * FROM tblposts ORDER BY viewCounter DESC LIMIT 10";
                $latest_n = mysqli_query($conn , $latest);
                if($latest_n){
                 
                  while( $rows = mysqli_fetch_assoc($latest_n) ){
                    $heading = $rows["PostTitle"];
                    $img = $rows["PostImage"];
                    $id = $rows["id"];
                   
                    ?>
                    <li>
                    <div class="media d-flex"> <a href="detail.php?id=<?php echo $id ?>&sid=<?php echo $rows['SubCategoryId'];?>" class="media-left"> <img alt="" src="./admin/postimages/<?php echo $img; ?>"> </a>
                      <div class="media-body border-bottom"> <a href="detail.php?id=<?php echo $id ?>&sid=<?php echo $rows['SubCategoryId'];?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                    </div>
                  </li>
                  <?php
                  }
                }
                ?>
            </ul>
          </div>
          </div>
        
              </div>
            </div>
          </div>
      
        </aside>
      </div>
    </div>
    </div>
    <ul class="pagination justify-content-center mb-4">
  <li class="page-item"><a href="?pageno=1"  class="page-link">سەرەتا</a></li>
  <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
      <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">گەڕانەوە</a>
  </li>
  <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
      <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">دواتر</a>
  </li>
  <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">کۆتای</a></li>
</ul>

  </div>
  </section>




<?php
include './_Partials/footer.php';

?>