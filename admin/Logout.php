<?php
session_name('wedding_admin');
session_start();
session_destroy();
header('location:index.php');
?>