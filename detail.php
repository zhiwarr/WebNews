<?php
include './_Partials/nav.php';

?>
<?php
$postid=intval($_GET['id']);


$sql = "SELECT viewCounter FROM tblposts WHERE id = '$postid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $visits = $row["viewCounter"];
        $sql = "UPDATE tblposts SET viewCounter = $visits+1 WHERE id ='$postid'";
$conn->query($sql);

    }
} else {
    echo "‌هیچ ئەنجامێک نەدۆزرایەوە";
}
?>
<?php 
if(isset($_GET['id'])){
$id = $_GET["id"];
$read_news = "SELECT * FROM tblposts p join tblcategory c on p.CategoryId=c.id  WHERE p.id = '$id' ";
$read_result = mysqli_query($conn , $read_news);
if($read_news){
  while( $rows = mysqli_fetch_assoc($read_result) ){
    $heading =  $rows["PostTitle"];
    $details =  $rows["PostDetails"];
     $time = $rows["PostingDate"];
    $category = $rows["CategoryName"];
    $img = $rows["PostImage"];
    $in_date=time()-strtotime($time);
?>
<main dir="rtl">
<section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
            <h1> <?php echo $heading; ?> </h1>
            <div class="post_commentbox"> <span><i class="fa fa-calendar"></i> <?php echo round($in_date/(60*60*24))." ڕۆژ لەمەوبەر";?> </span> <a href="#"><i class="fa fa-tags"></i><?php echo $category; ?></a> 
          <span><i class="fa fa-eye"></i><?php echo $rows['viewCounter']."جار خوێندراوەتەوە";?></span></div>
            <div class="single_page_content"> <img class="img-center" style="width:85%; height:400px" src="admin/postimages/<?php echo $img; ?>" alt="">
              <blockquote> <?php echo $details; ?> </blockquote>
              <ul class="social-icons d-flex justify-content-center p-2">
        <li ><a  href="https://www.instagram.com/zhiwar03/"><i class="fa fa-instagram"></i></a></li>
        <li ><a  href="https://twitter.com/ZHIWAR10"><i class="fa fa-twitter"></i></a></li>
        <li ><a  href="https://www.facebook.com/profile.php?id=100074414323637"><i class="fa fa-facebook"></i></a></li>
     
    </ul>
            </div>
           
          
          
       
            <div class="related_post ">
              <h2>هەواڵی پەیوەندیدار <i class="fa fa-thumbs-o-up"></i></h2>
              <ul class="spost_nav wow fadeInDown animated col-lg-12 col-md-12 col-sm-4">
            <?php
if(isset($_GET['cid'])){
        $cate=$_GET['cid'];
              $selet_related_post = "SELECT *,p.id as pid FROM tblposts p join tblcategory c on p.CategoryId=c.id where p.SubCategoryId  =$cate and p.id<>".$_GET['id']." ORDER BY RAND() LIMIT 4";
              $relted_post = mysqli_query($conn , $selet_related_post);

              if($relted_post){
                while ( $relted_post_row = mysqli_fetch_assoc($relted_post) ){
                  $thumb = $relted_post_row["PostImage"];
                  $related_heading = $relted_post_row["PostTitle"];
                  $related_id = $relted_post_row["pid"];
                  $category=$relted_post_row['CategoryName']
                  ?>
                <li>
             

                  
                  <div class="media"> <a class="media-left" href="detail.php?id=<?php echo $related_id; ?>&cid=<?php echo $rows['SubCategoryId'];?>"> <img src="admin/postimages/<?php echo $thumb; ?>" > </a>
                  <div class="detail mx-4 d-flex flex-column justify-content-between">
                    <div class="media-body my-4"> <a class="catg_title" href="detail.php?id=<?php echo $related_id; ?>&cid=<?php echo $rows['SubCategoryId'];?>"> <?php echo $related_heading; ?> </a>
                   </div>
                   <div class="cate mb-4">
                   <span class="btn-cate text-white  d-inline-block m-1 rounded-2"><a class="text-white"><?php  echo $category; ?></a></span>
                   </div>
                   <div>
                    <div class='w-100'>
                  <span class=""><?php echo round($in_date/(60*60*24))." ڕۆژ لەمەوبەر";?> </span>
                  </div>
                  </div>
                  </div>
             
                  </div>
                  
           
              
                  
                </li>
                  <?php
                }
              }
            }
            ?>
             <?php
 if(isset($_GET['sid'])){
    $sid=$_GET['sid'];

$latest = "SELECT *,p.id as pid FROM tblposts p join tblsubcategory s on p.SubCategoryId=s.SubCategoryId where p.SubCategoryId =".$sid." and p.id<>".$_GET['id']." LIMIT 4";
$relted_post = mysqli_query($conn , $latest);
if($relted_post){
    while ( $relted_post_row = mysqli_fetch_assoc($relted_post) ){
      $thumb = $relted_post_row["PostImage"];
      $related_heading = $relted_post_row["PostTitle"];
      $related_id = $relted_post_row["pid"];
      ?>
   <li>
             

                  
             <div class="media" dir="rtl"> <a class="media-left" href="detail.php?id=<?php echo $related_id; ?>&cid=<?php echo $rows['SubCategoryId'];?>"> <img src="admin/postimages/<?php echo $thumb; ?>" > </a>
             <div class="detail mx-4 d-flex flex-column justify-content-between">
               <div class="media-body my-4"> <a class="catg_title" href="detail.php?id=<?php echo $related_id; ?>&cid=<?php echo $rows['SubCategoryId'];?>"> <?php echo $related_heading; ?> </a>
              </div>
              <div class="cate mb-4">
              <span class="btn-cate text-white  d-inline-block m-1 rounded-2"><a class="text-white"><?php  echo $category; ?></a></span>
              </div>
              <div>
               <div class='w-100'>
             <span class=""><?php echo round($in_date/(60*60*24))." ڕۆژ لەمەوبەر";?> </span>
             </div>
             </div>
             </div>
        
             </div>
             
      
         
             
           </li>
      <?php
    }
  }
}
?>


              </ul>
            </div>
          </div>
        </div>
      </div>
     
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
</section>
        </main>




<?php
}
}
}
include './_Partials/footer.php';

?>