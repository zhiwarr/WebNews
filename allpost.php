
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

$num_per_page=10;

if(isset($_GET["pageno"])){
 $page=$_GET["pageno"];
}
else{
 $page=1;
}
$start_from=($page-1)*05;

            if(isset($_GET['category_id'])){

              
            $latest = "SELECT * , p.id as pid FROM tblposts p join tblsubcategory s on p.SubCategoryId=s.SubCategoryId join tbladmin a on a.AdminUserName=p.postedBy And  a.Is_Active=1  join tblcategory c on s.CategoryId=c.id where c.id =". $_GET['category_id']."  order by p.PostingDate desc limit $start_from,$num_per_page";
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
                                                <a href="detail.php?id=<?php echo $post;?>&cid=<?php echo $rows['SubCategoryId'];?>" >
                                                <img style="height: 200px; width: 400px;" class="rounded" src="admin/postimages/<?php echo $img; ?>"  />
                                                
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta big-meta">
                                            <span class="btn-cate my-5 rounded-2"><a class="text-white" href="detail.php?id=<?php echo $rows['id'];?>&cid=<?php echo $rows['SubCategoryId'];?>"><?php  echo $sub; ?></a></span>
                                                <span class="btn-cate text-white d-inline-block m-1 rounded-2"><a class="text-white" href=""><?php  echo $cate; ?></a></span>
                                               
                                                <h4>
                                                  <a href="detail.php?id=<?php echo $rows['id'];?>&cid=<?php echo $rows['SubCategoryId'];?>"  class="head_allpost "><?php echo $heading; ?></a>
                                                </h4>
                                                <div class="container d-flex justify-content-between">
                                                <small>
                                                  <a  href="detail.php?id=<?php echo $rows['id'];?>&cid=<?php echo $rows['SubCategoryId'];?>" ><?php echo round($in_date/(60*60*24))." ڕۆژ لەمەوپێش";?>
                                                </a>
                                              </small>
                                                <small><a class="" href="" >پۆستکراوە لەلایەن  <b><?php echo $admin." ەوە";?></b></a></small>
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
                    <div class="media d-flex"> <a href="read-post.php?id=<?php echo $id; ?>&cid=<?php echo $rows['SubCategoryId'];?>" class="media-left"> <img alt="" src="./admin/postimages/<?php echo $img; ?>"> </a>
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
                <!-- <li class="cat-item">  <a href="all-posts.php">هەمووی</a>  </li> -->
                <!-- adding category----------------------------------------------------------------- -->
                    <?php 
                // require_once "./admin/include/connection.php";

                $get_category = "SELECT * FROM tblsubcategory";
                
                $result = mysqli_query($conn , $get_category);
                if($result){
                  while ( $rows =  mysqli_fetch_assoc($result) ){
                    $c_name = $rows["Subcategory"];
                  
                    
              ?> 
                <li class="cat-item"><a href="allsub.php?subcategory=<?php echo $rows['SubCategoryId']; ?> &cid=<?php echo $rows['SubCategoryId'];?>"><?php echo ucwords($c_name); ?> </a></li>
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
                  
    <?php
                    $sql="select * from tblposts";
                    $rs_result=mysqli_query($conn,$sql);
                    $total_records=mysqli_num_rows($rs_result);
                    $total_page=ceil($total_records/$num_per_page);



                    for($i=1;$i<=$total_page;$i++){

                    
                    ?>
                    <li class="page-item active"><a href="allpost.php?pageno=<?php echo $i ?>&category_id=<?php echo $news_id?>" class="page-link"><?php echo $i ?></a></li>
<?php
}?>
</ul>

  </div>
  </section>




<?php
include './_Partials/footer.php';

?>