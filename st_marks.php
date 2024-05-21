<?php
require_once './connection.php';
include_once "header.php";
session_start();

?>

<head>
    <meta charset="utf-8" />
</head>

<?php

if (!isset($_SESSION["id_school"]) || $_SESSION["id_school"] == '') {
    header('location: index.php');
}


$id_school = $_SESSION["id_school"];
$query = "select * from  info_student where id_school= '$id_school'";
$query_run = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_run)) {
    ?>
<div class="container">
    <table class="table table-responsive table-lg table-md table-sm  table-hover   table-bordered">

        <thead>
            <tr>
                <th>#</th>
                <th>رقم المدرسي</th>
                <th>الاسم الاول</th>
                <th>الاسم الاخير</th>
                <th>الماده الاولى</th>
                <th>الماده الثانية</th>
                <th>الماده الثالثة</th>
                <th>الماده الرابعة</th>
                <th>النسبة</th>
                <th>النتيجة</th>

            </tr>
        </thead>
        <?php
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
            <td><?php echo $row['id']; ?></td>
            <td><?php echo "$id_school"; ?></td>
            <td><?php echo "$firstname"; ?></td>
            <td><?php echo "$lastname"; ?></td>
            <td><?php echo "$first_mark"; ?></td>
            <td><?php echo "$second_mark"; ?></td>
            <td><?php echo "$third_mark"; ?></td>
            <td><?php echo "$fourth_mark"; ?></td>
            <td style="background-color: #6fca5f;"><?php echo "$final_mark"; ?></td>
            <td style="background-color: #ccc;"><?php echo "$remarks"; ?></td>


            <td>

                <a class="btn btn-outline-success btn-lg" href="print_pdf.php?id=<?php echo $row['id']; ?>"
                    role="button">PDF and print</a>

            </td>

    </table>
    <a href="index.php">
        <button class="w-20 btn btn-lg btn-primary" name="search_by_roll_no_for_search" type="submit">خروج</button></a>
    </body>

</div>
<?php
}
?>

</html>
<?php

$myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
fwrite($myfile, "$final_mark\n");
$txt = "$remarks\n";
fwrite($myfile, $txt);
fclose($myfile);

?>