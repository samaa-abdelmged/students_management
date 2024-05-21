<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <?php
  require_once './connection.php';

  if (isset($_POST['submit'])) {
    $table = "info_student";
    $firstname = $_POST['firstname'];
    $id_school = $_POST['number'];
    $query1 = "SELECT * FROM $table where firstname='$firstname' and id_school = '$id_school' ";

    $result = mysqli_query($conn, $query1);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
      $_SESSION['id_school'] = $id_school;

      header("Location: st_marks.php");
    } else {
      echo

        "<div class='form alert alert-info'>
                  <h3>الاسم او رقم الجلوس غير صحيحه</h3><br/>
                  </div>";
    }
  }
  ?>


    <main class="form-signin">
        <form class="form" method="post" name="login">
            <h1 class="h3 mb-3 fw-normal">سجل دخولك</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="firstname" placeholder="ادخل الاسم">
                <label for="floatingInput" required>ادخل الاسم</label>
            </div>

            <div class="form-floating">
                <input type="text" name="number" class="form-control" id="floatingPassword"
                    placeholder="ادخل رقم الجلوس">
                <label for="floatingPassword" required>رقم الجلوس </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" name="submit" type="submit">ادخال </button>

        </form>

    </main>

    <?php

  ?>
</body>

</html>