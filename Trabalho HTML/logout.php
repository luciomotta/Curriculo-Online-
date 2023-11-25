<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
 // Credenciais corretas, redirecionar para Index.php
 header('Location: login.php');
 exit();

?>
