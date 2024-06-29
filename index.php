<?php include_once '_Partials/nav.php' ;?>






<section id="sliderSection" class="rounded">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="slick_slider ">

        <!-- adding carousel -------------------------------------------------------------------------->
        <?php 
            
            $latest = "SELECT * FROM tblposts where Is_Active=1 ORDER BY PostingDate DESC LIMIT 5";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["PostTitle"];
                $img = $rows["PostImage"];
                $description = $rows["PostDetails"];
                $news_id = $rows["id"];
                ?>
                 <div class="single_iteam" > <a href="detail.php?id=<?php echo $news_id ?>&cid=<?php echo $rows['SubCategoryId'];?>"> <img src="admin/postimages/<?php echo $img; ?>" ></a>
                  <div class="slider_article">
                    <h2><a class="slider_tittle" dir="rtl" href="detail.php?id=<?php echo $news_id ?>&cid=<?php echo $rows['SubCategoryId'];?>"><?php echo $heading; ?></a></h2>
                   
                  </div>
             </div>
                <?php
              
              }
            }
            ?>
            </div>
            </div>
          
 <div class="col-lg-4 col-md-4 col-sm-12">
 <div class="row row-cols-4">
    <div class="col"><img src="assets/image/reklam.jpg" height=450px; class="rounded-3" width=400px alt=""></div>
  </div></div>
          <!-- -->
 
      </div>
    </div>
</section>
<main dir="rtl">
<section  id="contentSection">
    <div class="row" >
      <!-- aaaaaaaaaaaaaaaaaaa -->
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <div class="page-wrapper">
                            <div class="single_post_content">
                            <h2><span> هەموو پۆستەکان</span> </h2>

                                <div class="row"  
    >

                                <?php
              
              if (isset($_GET['pageno'])) {
                     $pageno = $_GET['pageno'];
                 } else {
                     $pageno = 1;
                 }
                 $no_of_records_per_page = 10;
                 $offset = ($pageno-1) * $no_of_records_per_page;
         
         
                 $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                 $result = mysqli_query($conn,$total_pages_sql);
                 $total_rows = mysqli_fetch_array($result)[0];
                 $total_pages = ceil($total_rows / $no_of_records_per_page);
              $select_cat_news = "SELECT * FROM tblposts WHERE  is_active=1 ORDER BY PostingDate DESC limit $offset, $no_of_records_per_page ";
              $result_cat_news = mysqli_query($conn , $select_cat_news);

              if($result_cat_news){
                  while ( $cat_news_rows = mysqli_fetch_assoc($result_cat_news) ){
                   $post_thumb = $cat_news_rows["PostImage"];
                    $post_heading = $cat_news_rows["PostTitle"];
                   $post_detail=$cat_news_rows["PostDetails"];
                    $post_id = $cat_news_rows["id"];
                    $date=$cat_news_rows["PostingDate"];

                    //date
                    $in_date=time()-strtotime($date);
    
           ?>





                                    <div class="col-md-6 con p-1" >
                                        <div class="blog-box" >
                                            <div class="post-media  py-2">
                                                <a href="detail.php?id=<?php echo $post_id;?>&cid=<?php echo $cat_news_rows['SubCategoryId'];?>" >
                                                <img style="height: 200px; width: 400px;" class="rounded" src="admin/postimages/<?php echo $post_thumb; ?>"  />

                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta big-meta">
                                               
                                                <h4>
                                                  <a href="detail.php?id=<?php echo $post_id;?>&cid=<?php echo $cat_news_rows['SubCategoryId'];?>"  class="head_allpost "><?php echo $post_heading; ?></a>
                                                </h4>
                                            

                                                <div class="container d-flex justify-content-between">
                                                <small>
                                                  <a   ><?php echo round($in_date/(60*60*24))." ڕۆژ لەمەوپێش";?>
                                                </a>
                                              </small>
                                                </div>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->

                                 <?php  }}?>
                                
                                   
                                </div><!-- end row -->
                            </div><!-- end blog-grid-system -->
                        </div><!-- end page-wrapper -->


                    </div><!-- end col -->
              
    











 <!-- aaaaaaaaaaaaaaaaaaaaaaa -->
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
                $id = $rows["id"]
                ?>
                <li>
                <div class="media d-flex"> <a href="detail.php?id=<?php echo $id; ?>&cid=<?php echo $rows['SubCategoryId'];?>" class="media-left"> <img alt="" src="./admin/postimages/<?php echo $img; ?>"> </a>
                  <div class="media-body border-bottom"> <a href="detail.php?id=<?php echo $id; ?>&cid=<?php echo $rows['SubCategoryId'];?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
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
                    <div class="media d-flex"> <a href="detail.php?id=<?php echo $id; ?>&cid=<?php echo $rows['SubCategoryId'];?>" class="media-left"> <img alt="" src="./admin/postimages/<?php echo $img; ?>"> </a>
                      <div class="media-body border-bottom"> <a href="detail.php?id=<?php echo $id; ?>&cid=<?php echo $rows['SubCategoryId'];?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
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
                    <div class="media d-flex"> <a href="detail.php?id=<?php echo $id; ?>&cid=<?php echo $rows['SubCategoryId'];?>" class="media-left"> <img alt="" src="./admin/postimages/<?php echo $img; ?>"> </a>
                      <div class="media-body border-bottom"> <a href="detail.php?id=<?php echo $id; ?>&cid=<?php echo $rows['SubCategoryId'];?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                    </div>
                  </li>
                  <?php
                  }
                }
                ?>
            </ul>
          </div>
          </div>
          <div class="single_sidebar">
          <div class="latest_post">
            <h2><span>پۆلەکان</span></h2>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="category">
                <ul>
                <!-- <li class="cat-item">  <a href="allpost.php">هەمووی</a>  </li> -->
                <!-- adding category----------------------------------------------------------------- -->
                       <?php 
                // require_once "./admin/include/connection.php";

                $get_category = "SELECT * FROM tblsubcategory";
                
                $result = mysqli_query($conn , $get_category);
                if($result){
                  while ( $rows =  mysqli_fetch_assoc($result) ){
                    $c_name = $rows["Subcategory"];
                  
                    
              ?> 
                <li class="cat-item"><a href="allsub.php?subcategory=<?php echo $rows['SubCategoryId']; ?> "><?php echo ucwords($c_name); ?> </a></li>
                      <?php
                        }
                    }
                  ?>
                <!-- end of adding category---------------------------------------------------------  -->
                </ul>
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




    <!-- Pagination -->




 
<!-- /.container -->
</main>

            <?php include_once '_Partials/footer.php' ;?>