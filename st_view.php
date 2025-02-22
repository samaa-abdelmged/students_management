<style>
img {
    max-width: 80px;
    ;
    max-height: 80px;
    ;
    border-radius: 50%;

    border: 2px solid #ccc;
}

tr,
td,
th {
    width: 8%;
    text-align: center
}
</style>

<?php
require_once './connection.php';
include_once "header.php";

session_start([
    'cookie_lifetime' => 60 * 60,
]);
if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
    header('location: index.php');
}
$i = 0;

?>

<body>
    <center>

        <?php include ('teacher_header.php'); ?>


        <table class="table table-responsive table-lg table-md 
        table-sm  table-hover   table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>رقم المدرسي</th>
                    <th>الاسم الاول</th>
                    <th>الاسم الاخير</th>
                    <th>رقم الموبايل</th>
                    <th>الماده الاولى</th>
                    <th>الماده الثانية</th>
                    <th>الماده الثالثة</th>
                    <th>الماده الرابعة</th>
                    <th>المجموع</th>

                    <th>النتيجة</th>
                    <th>إضافه الدرجات</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <?php


            $sql = "SELECT * FROM  info_student where teacher_number = '" . $_SESSION["id"] . "'  ";

            $query = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $id_school = $row['id_school'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $phone = $row['phone'];
                $first_mark = $row['first_mark'];
                $second_mark = $row['second_mark'];
                $third_mark = $row['third_mark'];
                $fourth_mark = $row['fourth_mark'];
                $final_mark = ($first_mark + $second_mark
                    + $third_mark + $fourth_mark);

                if (($final_mark >= 85) && ($final_mark <= 100)) {
                    $remarks = "ممتاز";
                } elseif (($final_mark >= 75) && ($final_mark <= 85)) {
                    $remarks = "جيد جدا";
                } elseif (($final_mark >= 65) && ($final_mark <= 75)) {
                    $remarks = "جيد";
                } elseif (($final_mark >= 50) && ($final_mark <= 65)) {
                    $remarks = "مقبول";
                } else {
                    $remarks = "راسب";
                }

                ?>

            <tr>
                <td><?php echo ++$i; ?></td>
                <td><?php echo "$id_school"; ?></td>
                <td><?php echo "$firstname"; ?></td>
                <td><?php echo "$lastname"; ?></td>
                <td><?php echo "$phone"; ?></td>

                <td><?php echo "$first_mark"; ?></td>
                <td><?php echo "$second_mark"; ?></td>
                <td><?php echo "$third_mark"; ?></td>
                <td><?php echo "$fourth_mark"; ?></td>

                <td style="background-color: #6fca5f;"><?php echo "$final_mark"; ?></td>
                <td style="background-color: #ccc;"><?php echo "$remarks"; ?></td>


                <td>

                    <a class="btn btn-outline-info btn-md" href="st_add_mark.php?id=<?php echo $row['id']; ?>"
                        role="button">إضافه الدرجات</a>

                </td>


                <td>

                    <a class="btn btn-outline-warning btn-lg" href="st_edit.php?id=<?php echo $row['id']; ?>"
                        role="button">تعديل</a>

                </td>
                <td>


                    <a class="btn btn-outline-danger btn-lg" href="st_delete.php?id=<?php echo $row['id']; ?>"
                        role="button">حذف</a>
                </td>


            </tr>

            <?php } ?>
        </table>
    </center>

</body>

</html>