<?php
require_once './connection.php';
include_once "header.php";
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
    header('location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM  info_student WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $upclass = $row['class'];
    $upphone = $row['phone'];
    $upfirstname = $row['firstname'];
    $uplastname = $row['lastname'];
    $upfirst = $row['first_mark'];
    $upsecond = $row['second_mark'];
    $upthird = $row['third_mark'];
    $upfourth = $row['fourth_mark'];
}

if (isset($_POST['save_update'])) {

    $upfirstname = $_POST['firstname'];
    $uplastname = $_POST['lastname'];
    $upfirst = $_POST['first'];
    $upsecond = $_POST['second'];
    $upthird = $_POST['third'];
    $upfourth = $_POST['fourth'];
    $upclass = $_POST['class'];
    $upphone = $_POST['phone'];
}
$query = "UPDATE  info_student SET firstname='$upfirstname',lastname='$uplastname',first_mark='$upfirst',second_mark='$upsecond',third_mark='$upthird',fourth_mark='$upfourth',class='$upclass',phone='$upphone' where id='" . $id . "'";
if (mysqli_query($conn, $query)) {
    echo "<script>windows: location='st_view.php'?alert('تم الاضافه')</script>";
} else {
    echo "<script>windows: location='st_add.php?id=" . $id . "'?alert('حدث خطا')</script>";
}

?>

<body>
    <center>

        <?php include ('teacher_header.php'); ?>

        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="Title" class="col-sm-2 control-label">الاسم الاول</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" placeholder="الاسم الاول"
                            value="<?php echo $upfirstname; ?>" required>
                    </div>
                </div>
                <br>

                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">الاسم الثاني</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" placeholder="الاسم الثاني"
                            value="<?php echo $uplastname; ?>" required>
                    </div>
                </div>
                <br>
                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">المادةالاولى</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="first" placeholder="المادةالاولى"
                            value="<?php echo $upfirst; ?>" required>
                    </div>
                </div>

                <br>
                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">المادةالثانية</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="second" placeholder="المادةالثانية"
                            value="<?php echo $upsecond; ?>" required>
                    </div>
                </div>
                <br>
                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">المادةالثالثة</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="third" placeholder="المادةالثالثة"
                            value="<?php echo $upthird; ?>" required>
                    </div>
                </div>
                <br>

                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">المادةالرابعة</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="fourth" placeholder="المادةالرابعة"
                            value="<?php echo $upfourth; ?>" required>
                    </div>
                </div>
                <br>


                <div class="form-group col-lg-12 col-sm-8">
                    <div class="col-sm-10">
                        <select class="form-select form-select-lg " name="class">
                            <option value="الصف الاول">الصف الاول</option>
                            <option value="الصف الثاني">الصف الثاني</option>
                        </select>
                    </div>
                </div>
                <br>


                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">رقم الهاتف</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="phone" placeholder="رقم الهاتف"
                            value="<?php echo $upphone; ?>" required>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button name="save_update" class="btn btn-info col-lg-12" data-toggle="modal">
                            حفظ التعديل
                        </button>
                    </div>
                </div>
                <br>
            </form>
        </div>

    </center>


</body>

</html>