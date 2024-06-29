<?php include 'admin/config.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/slick.css?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/bgg.css">
    <link rel="stylesheet" href="../assets/css/li-scroll.css?v=1">
    <link rel="stylesheet" href="../assets/css/jquery.fancybox.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/a.css?v=3">
    <link rel="stylesheet" href="../assets/css/footer.css">

</head>

<body class="">


    <nav class="navbar navbar-default navbar-custom">
        <div class="container">

            <div class="navbar-header">
                <a class="navbar-brand" href="#">YLZnews</a>
            </div>


            <div class="navs-secondary visible-lg visible-md">
                <div class="container">
                    <ul class="nav navbar-nav d-inline-block text-uppercase">
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
            <div class="navs-container d-flex  text-uppercase">
                <form class="navbar-form navbar-right" role="search">
                    <div class="search-box" id="search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span
                                        class="fa fa-search"></span></button>
                                <button type="button" class="btn btn-default toggle-hide hidden-md hidden-lg"
                                    data-target="#search-box"><span class="glyphicon glyphicon-remove"></span></button>
                            </span>
                        </div>
                    </div>
                    <button type="button" data-target="#search-box"
                        class="btn btn-default visible-xs visible-sm toggle-display"><span
                            class="glyphicon glyphicon-search"></span></button>
                </form>



            </div>
        </div>



    </nav>



    <main>
        <section id="newsSection" class="rounded">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="latest_newsarea"> <span>بەپەلە</span>

                            <ul id="ticker01" class="news_sticker">

                                <!-- latest news------------------------------------------------------------ -->
                                <?php 
            
            $latest = "SELECT * FROM tblposts ORDER BY PostingDate DESC";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              $i = 1;
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["PostDetails"];
                $img = $rows["PostImage"];
                $id = $rows["id"];
              
                ?>
                                <li><a href='detail.php?id=<?php echo $id; ?>'><img
                                            src="./admin/postimages/<?php echo $img; ?>"> <?php echo $heading ?> </a>
                                </li>
                                <?php
                if( $i > 4 ){
                  break;
                }
                $i++;

              }
            }
            ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>