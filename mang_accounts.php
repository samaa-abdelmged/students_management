<style>
img {
    width: 50%;
    /* height: 20%	; */
}

td {
    width: 5%;
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
?>

<body>


    <?php include ('admin_header.php'); ?>
    <br>
    <form action="" post="POST">
        <table class="table  table-responsive table-lg table-md table-sm  
		table-hover   table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم الاول</th>
                    <th>الاسم الاخير</th>
                    <th>البريد الالكتروني</th>
                    <th>تعديل</th>
                    <th>حذف</th>

                </tr>
            </thead>

            <?php


			$sql = "SELECT * FROM admin_accounts order by id ASC";

			$query = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_array($query)) { ?>
            <tbody>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['email']; ?></td>

                <td>
                    <a class="btn btn-outline-info btn-lg"
                        href="edit_account.php?id=<?php echo $row['id']; ?>">تعديل</a>
                </td>

                <td>
                    <a class="btn btn-outline-danger btn-lg"
                        href="delete_account.php?id=<?php echo $row['id']; ?>">حذف</a>
                </td>

            </tbody>
            <?php } ?>
    </form>


</body>

</html>