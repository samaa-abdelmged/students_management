<?php
require_once './connection.php';
include_once "header.php";
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
    header('location: index.php');
}

$query2 = "select * from  info_student order by id_school desc limit 1";
$result2 = mysqli_query($conn, $query2);
$row = mysqli_fetch_array($result2);
error_reporting(0);
$last_id = $row['id_school'];
if ($last_id == "") {
    $id_school = "000";
} else {
    $id_school = substr($last_id, 3);
    $id_school = intval($id_school);
    $id_school = "000" . ($id_school + 1);
}


if (isset($_POST['save'])) {

    $teacher_id = $_SESSION["id"];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $id_school = $_POST['id_school'];
    $phone = $_POST['phone'];
    $grading = $_POST['class'];
    $first_mark = 0;
    $second_mark = 0;
    $third_mark = 0;
    $fourth_mark = 0;
    $final_mark = 0;

    $query = "INSERT INTO  info_student(id_school,teacher_number,firstname,lastname,phone,first_mark,second_mark, third_mark,fourth_mark,final_mark,class) VALUES 
     ('$id_school','$teacher_id','$firstname','" . $lastname . "','$phone','$first_mark','$second_mark','$third_mark','$fourth_mark','$final_mark','$grading')";

    if (mysqli_query($conn, $query)) {
        echo "<script>windows: location='st_view.php';alert('تم الحفظ')</script>";
    } else {
        echo "<script>alert('حدث خطا')</script>";
    }
}

?>

<body>
    <center>

        <?php include ('teacher_header.php'); ?>
        <br>

        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <br>
                <div class="form-group">
                    <label>رقم المدرسي</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="id_school" id="id_school" style="color: red"
                            value="<?php echo $id_school; ?>" readonly>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="Title" class="col-sm-2 control-label">الاسم الاول</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" placeholder="الاسم الاول"
                            value="<?php echo ''; ?>" required>
                    </div>
                </div>

                <br>
                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">الاسم الثاني</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" placeholder="الاسم الثاني"
                            value="<?php echo ''; ?>" required>
                    </div>
                </div>
                <br>
                <div class="form-group col-lg-12 col-sm-8">
                    <label for="Author" class="col-sm-2 control-label">رقم الموبايل</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" maxlength="9" name="phone" placeholder="رقم الموبايل"
                            required>
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



                <div class="form-group">
                    <div class=" w-50 col-sm-offset-2 col-sm-10">
                        <button name="save" class="btn btn-info col-lg-12" data-toggle="modal">
                            حفـــــــظ
                        </button>
                    </div>
                </div>
                <br>
            </form>

        </div>


    </center>


</body>

</html>