<?php
require_once "connect.php";
$enroll_id = $_REQUEST["enroll_id"];
$sql = "delete from enrollment where enroll_id = '$enroll_id'";
$res = mysqli_query($conn,$sql);
if($res){
    header("location: listEnroll.php");
} else {
    echo $sql;
}