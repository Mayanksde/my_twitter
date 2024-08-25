<?php
session_start();

// unset session variables
$_SESSION = array();
session_destroy();

header("Location: index.php");
exit();
?>
