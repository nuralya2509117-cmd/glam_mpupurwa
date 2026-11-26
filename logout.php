<?php
session_start();
session_destroy();
header("Location: katalog.php");
exit();
?>