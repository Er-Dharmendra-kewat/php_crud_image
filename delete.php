<?php
session_start();
include 'config/connect.php';


$id = $_GET['delete_id'];

$sql_for_select_delete_data = "DELETE FROM  `uploads_image` WHERE id=$id";

$sql_for_select_delete_data_run = mysqli_query($conn, $sql_for_select_delete_data);

if ($sql_for_select_delete_data_run) {

    $_SESSION['status'] = "Data Deleted successfully";
    $_SESSION['status_code'] = "success";
    header('Location: Read.php');

} else {
    $_SESSION['status'] = "Data not deleted";
    $_SESSION['status_code'] = "error";
    header('Location: Read.php');

}










?>