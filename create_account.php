<?php
require_once './connection.php';
include_once "header.php";
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
    header('location: index.php');
} elseif (isset($_POST['save']) && (!empty($_FILES['picture']['name']))) {

    // Define allowed file types
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

    // Get file information
    $file_name = $_FILES['picture']['name'];
    $file_size = $_FILES['picture']['size'];
    $file_tmp = $_FILES['picture']['tmp_name'];
    $file_type = $_FILES['picture']['type'];
    $file_ext = explode('.', $file_name);
    $file_ext = end($file_ext);

    // Check if file extension is allowed
    if (in_array($file_ext, $allowed_extensions)) {

        // Check if file size is within limit (optional)
        if ($file_size <= 1048576) { // 1 MB limit (adjust as needed)

            // Generate a unique filename
            $new_file_name = uniqid('picture_', true) . '.' . $file_ext;

            // Specify the upload path (modify as needed)
            $upload_path = 'uploads/';

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($file_tmp, $upload_path . $new_file_name)) {
                echo "<script>alert('Picture uploaded successfully!')</script>";
            } else {
                echo "<script>alert('Error uploading file.')</script>";

            }

        } else {
            echo "<script>alert('File size exceeds the limit (1 MB).')</script>";
        }
    }

    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT email FROM admin_accounts WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('الايميل موجود بالفعل')</script>";

    } else {
        $query = "INSERT INTO admin_accounts(firstname,lastname,email,password)
			 VALUES ('$firstname','$lastname','$email','$password')";

        mysqli_query($conn, $query);
        echo "<script>alert('تم الحفظ')</script>";
        echo '<script>windows: location="mang_accounts.php"</script>';
    }
}

?>


<?php include ('admin_header.php'); ?>
<br>

<div class="container">
    <div class="mb-6 g-3 row justify-content-center">
        <div class="col-lg-8">
            <br>
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data">
                    <br>
                    <div class="form-group col-lg-12 col-sm-8">
                        <label for="Publisher" class="col-sm-2 control-label"> الاسم الاول</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="firstname" placeholder="الاسم الاول"
                                value="<?php echo ''; ?>" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-lg-12 col-sm-8">
                        <label for="Publisher" class="col-sm-2 control-label"> الاسم الثاني</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="lastname" placeholder="الاسم الثاني"
                                value="<?php echo ''; ?>" required>
                        </div>
                    </div>
                    <br>

                    <div class="form-group col-lg-12 col-sm-8">
                        <label for="Publisher" class="col-sm-2 control-label">البريد الالكتروني </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني"
                                value="<?php echo ''; ?>" required>
                        </div>
                    </div>
                    <br>

                    <div class="form-group col-lg-12 col-sm-8">
                        <label for="Publisher" class="col-sm-2 control-label"> كلمة السر</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="كلمة السر"
                                value="<?php echo ''; ?>" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-lg-12 col-sm-8">
                        <div class="col-sm-10">
                            <label for="picture"> اختر صورة</label><br>
                            <input type="file" id="picture" name="picture" accept="image/*" required><br><br>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button name="save" class="btn btn-info col-lg-12" data-toggle="modal">
                                حفظ </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


</body>

</html>