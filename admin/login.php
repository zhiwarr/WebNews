<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/admin/login_style.css">
</head>

<body>
    <div class="stars">
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
    </div>
    <div class="loginBox"> <img class="user" src="../assets/image/Computer login.gif">
        <h3>چوونە ژوورەوە</h3>
        <form action="login.php" method="post">
            <div class="inputBox"> <input id="uname" type="text" name="username" placeholder="ناو">
                <input id="pass" type="password" name="password" placeholder="پاسۆرد">
            </div>
            <div class="sbumit">
                <input type="submit" name="login" value="جوونە ناوەوە">
            </div>

        </form>


    </div>
</body>

</html>

<?PHP
session_start();
//Database Configuration File
include 'config.php';
//error_reporting(0);
if (isset($_POST['login'])) {

    // Getting username/ email and password
    $uname = $_POST['username'];
    $password = $_POST['password'];
    // Fetch data from database on the basis of username/email and password
    $sql = mysqli_query($conn, "SELECT AdminUserName,AdminEmailId,AdminPassword,userType FROM tbladmin WHERE (AdminUserName='$uname' && AdminPassword='$password' &&Is_Active=1)");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {

        $_SESSION['login'] = $uname;
        $_SESSION['utype'] = $num['userType'];
        header("location:dashboard.php");
    } else {
        echo "<script>alert('هەڵەیەک هەیە تکایە دووبارە هەوڵبدەوە');</script>";
    }
}
?>