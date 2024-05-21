<style>
img {
    width: 20%;
    height: 20%;
}
</style>

<?php
require_once './connection.php';
include_once "header.php";
session_start();

$type = $_GET['usertype'];
if ($type == 'ADMIN') {
    $table = "admin_accounts";
    $link = 'mang_accounts.php';

} else {
    $table = "teachers";
    $link = 'st_view.php';
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query1 = "SELECT * FROM $table where email='$email' 
	and password = '$password' ";

    $result = mysqli_query($conn, $query1);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
        $_SESSION["id"] = $row['id'];
        echo "<script>window.location.href = '$link';</script>";
    } else {
        echo "<script>alert('اسم المستخدم او كلمه المرور خاطئه')</script>";
    }

}
?>


<div class="container">
    <div class="mb-6 g-3 row justify-content-center">
        <div class="col-lg-8">
            <br>
            <center>

                <div class="container">

                    <form role="form" action="" id="TeacherForm" method="post">
                        <?php
                        if ($type == "ADMIN") {

                            echo "<img src=\"images\admin.png\">";
                        }
                        ?>
                        <?php
                        if ($type == "TEACHER") {
                            echo "<img src=\"images\Te.png\">";
                        }
                        ?>

                        <div class="form-group">
                            <br>

                            <label for="Title" class="col-sm-2 control-label">البريد الالكتروني </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="االبريد الالكتروني"
                                    required>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-sm-8">
                            <label for="Author" class="col-sm-2 control-label">كلمة المرور</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="كلمة المرور"
                                    required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button name="login" class="btn btn-info col-lg-12" data-toggle="modal">
                                    دخول
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="index.php"><button name="login" class="btn btn-warning col-lg-12"
                                    data-toggle="modal">
                                    رجوع
                                </button></a>
                        </div>

                    </div>
                </div>
            </center>
        </div>
    </div>
</div>
</body>