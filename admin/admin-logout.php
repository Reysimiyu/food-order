<?php
include '../config/db-connect.php';
    session_destroy();

    header("location:" . SITEURL . 'admin/admin-login.php');

?>