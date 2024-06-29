<?php
session_start();
include  'config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="News Portal.">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/admin/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/admin/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>


<body>
    <header>
        <h2 style=" position:relative;  background: #fff;box-shadow: 0 0 40px #00000021; padding:.8rem;">بەخێربێیتەوە
            <span style="color:#011a89e0;">
                <?php
        if (isset($_SESSION['login'])) {
          $username = $_SESSION['login'];
          $username = strtoupper($username);
          echo $username;
        } else {
          header("location:login.php");
        }
        ?>
                !</span>
        </h2>
    </header>
    <main>
        <div class="menu-container">
            <ul class="visitor_counter">

                <li style=""><?php getIP("visitors"); ?></li>
                <h5>:ژمارەی سەردانیکەرانان </h5>
            </ul>
            <ul class="vertical-nav">



                <li>
                    <a href="dashboard.php" class="img"><img src="../assets/image/user/dashboard.png" alt=""></a>
                </li>
                <li>
                    <a href="addPost.php" class="img"><img src="../assets/image/user/newspaper.png" alt=""></a>
                    <div class="hover-menu">
                        <ul>
                            <li><a href="addPost.php">زیادکردنی هەواڵ</a></li>
                            <li><a href="managePost.php">گشت هەواڵەکان</a></li>
                            <li><a href="trashPosts.php"> هەواڵە سڕاوەکان</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="addcategory.php" class="img"><img src="../assets/image/user/subfolder.png" alt=""></a>
                    <div class="hover-menu">
                        <ul>
                            <li><a href="addcategory.php"> زیادکردنی جۆر</a></li>
                            <li><a href="manageCat.php">گشت جۆرەکان</a></li>
                            <li><a href="trashCat.php">جۆرە سڕاوەکان</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="addSubCat.php" class="img"><img src="../assets/image/user/subfolder.png" alt=""></a>
                    <div class="hover-menu">
                        <ul>
                            <li><a href="addSubCat.php"> زیادکردنی پۆل</a></li>
                            <li><a href="manageSub.php">گشت پۆلەکان</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="addAdmin.php" class="img"><img src="../assets/image/user/account.png" alt=""></a>
                    <div class="hover-menu">
                        <ul>
                            <li><a href="addAdmin.php">زیادکردنی ئەدمین</a></li>
                            <li><a href="manageAdmin.php">ئەدمینەکان</a></li>
                            <li><a href="trashAdmin.php">ئەدمینە سڕاوەکان</a></li>
                        </ul>
                    </div>
                </li>

                <li class="log-out">
                    <a title="Sign out" href="logout.php" class="img"><img src="../assets/image/user/logout.png"
                            alt=""></a>
                </li>
            </ul>
            <?php include 'footer.php'; ?>