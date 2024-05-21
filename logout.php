<?php
session_start();
$_SESSION["id"] = "";
session_destroy();
?>
<script>
window.location.href = "index.php";
</script>