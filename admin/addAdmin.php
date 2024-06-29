<?php include_once 'nav.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $userType = 0;
    $query = mysqli_query($conn, "INSERT INTO `tbladmin`(`AdminUserName`,`AdminPassword`,`AdminEmailId`,`userType`) values('$username','$password','$email','$userType')");
    if ($query) {
        $msg = "ئەدمینێک بە سەرکەووتووی زیادکرا ";
    } else {
        $error = "هەڵەیەک هەیە تکایە دووبارە هەوڵ بدەوە";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <!---Success Message--->
            <?php if ($msg) { ?>
            <div class="alert alert-success" role="alert">
                <strong>پیرۆزە!</strong> <?php echo htmlentities($msg); ?>
            </div>
            <?php } ?>

            <!---Error Message--->
            <?php if ($error) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlentities($error); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="username">ناو</label>
                    <input type="text" placeholder="Enter Username" name="username" id="username" class="form-control"
                        pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title="Username must be alphanumeric 6 to 12 chars"
                        onBlur="checkAvailability()" required>
                    <span id="user-availability-status" style="font-size:14px;"></span>
                </div>
                <div class="form-group">
                    <label for="email">ئیمەیڵ</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="ئیمەیڵ داخل بکە"
                        required>
                </div>
                <div class="form-group">
                    <label for="password">وشەی نهێنی</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="وشەی نهێنی بنوسە"
                        required>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">&nbsp;</label>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary btn-md" id="submit" name="submit">زیادکردن</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>