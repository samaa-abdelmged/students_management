<?php
require_once './connection.php';
include_once "header.php";
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
	header('location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM admin_accounts WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
	$upfirstname = $row['firstname'];
	$uplastname = $row['lastname'];
	$email = $row['email'];
	$password = $row['password'];
}

if (isset($_POST['update'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "UPDATE admin_accounts SET firstname='$firstname'
			,lastname='$lastname',email='$email',
			password='$password'where id='$id'";
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('تم التعديل بنجاح')</script>";
		echo '<script>windows: location="mang_accounts.php"</script>';
	} else {
		echo "<script>alert('حدث خطا')</script>";
		echo '<script>windows: location="edit_account.php?id=' . $id . '"</script>';
	}

}
?>

<body>

    <?php include ('admin_header.php'); ?>
    </br>

    <div class="container">
        <div class="mb-6 g-3 row justify-content-center">
            <div class="col-lg-8">
                <div class="container">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="Title" class="col-sm-2 control-label">الاسم الاول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="firstname" placeholder="الاسم الاول"
                                    value="<?php echo $upfirstname; ?>" required>
                            </div>
                        </div>


                        <div class="form-group col-lg-12 col-sm-8">
                            <label for="Author" class="col-sm-2 control-label">الاسم الاخير</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lastname" placeholder="الاسم الاخير"
                                    value="<?php echo $uplastname; ?>" required>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-sm-8">
                            <label for="Publisher" class="col-sm-2 control-label">البريد الالكتروني</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني"
                                    value="<?php echo $email; ?>" required>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-sm-8">
                            <label for="Publisher" class="col-sm-2 control-label">كلمه المرور</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="كلمة المرور"
                                    value="<?php echo $password; ?>" required>
                            </div>
                        </div>



                        <br>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button name="update" class="btn btn-secondary col-lg-12" data-toggle="modal">
                                    حفظ التعديل
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>