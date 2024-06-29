<footer dir="rtl" class="footer">
    <div class="footer__addr">
        <h1 class="footer__logo">YLZNews</h1>

        <h2>پەیوەندیمان پێوە بکە</h2>

        <address>
            هەڵەبجە ، دەربەندیخان ، سلێمانی<br>
            <a href="tel:07708817375" class="text-dark">07708817375</a>
            <a class="footer__btn btn btn-primary bg-primary text-white" href="mailto:zhiwar04@gmail.com">ئیمەیڵ
                بنێرە</a>
        </address>
    </div>
    <div class="follow-box">
        <h3>فۆڵۆمان بکەن</h3>
        <ul class="social-icons">
            <li><a href="https://www.instagram.com/zhiwar03/"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://twitter.com/ZHIWAR10"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.facebook.com/profile.php?id=100074414323637"><i class="fa fa-facebook"></i></a>
            </li>

        </ul>
    </div>
    <div class="single_sidebar w-25 text-center">
        <div class="latest_post">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="category">
                    <h3>جۆرەکان</h3>
                    <ul>

                        <?php
        $query = mysqli_query($conn,"SELECT * from tblcategory where 	Is_Active=1 order by id desc ");
        while($row=mysqli_fetch_assoc($query)){?>
                        <li class="d-inline-block mx-2"><a
                                href="allpost.php?category_id=<?php echo $row['id'];?>"><?php echo $row['CategoryName'];?></a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="single_sidebar w-25 text-center">
        <div class="latest_post">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="category">
                    <h3>پۆلەکان</h3>
                    <ul>

                        <?php 
                // require_once "./admin/include/connection.php";

                $get_category = "SELECT * FROM tblsubcategory";
                
                $result = mysqli_query($conn , $get_category);
                if($result){
                  while ( $rows =  mysqli_fetch_assoc($result) ){
                    $c_name = $rows["Subcategory"];
                  
                    
              ?>
                        <li class="cat-item"><a
                                href="allsub.php?subcategory=<?php echo $rows['SubCategoryId']; ?> &cid=<?php echo $rows['SubCategoryId'];?>"><?php echo ucwords($c_name); ?>
                            </a></li>
                        <?php
                        }
                    }
                  ?>
                    </ul>
                </div>

</footer>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>
<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4="
    crossorigin="anonymous"></script>
<script src="../assets/js/jqurey.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<script src="../assets/js/slick.min.js"></script>
<script src="../assets/js/jquery.newsTicker.min.js"></script>
<script src="../assets/js/jquery.li-scroller.1.0.js"></script>
<script src="../assets/js/jquery.fancybox.pack.js"></script>

<script src="../assets/js/custom.js"></script>
<script src="../assets/ckeditor/ckeditor.js"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>



<script src="../assets/js/main.js"></script>



<script>
$('.icon').click(function() {
    $('span').toggleClass("cancel");
});
</script>


</body>

</html>