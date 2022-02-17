<?php
require_once "connect.php";
$sql = "select * from enrollment";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res)){
    $subject_id = $row["subject_id"];
    $sqlNameSub = "select subject_name from studing where subject_id = '$subject_id'";
    $resNameSub = mysqli_query($conn,$sqlNameSub);
    $rowNameSub = mysqli_fetch_array($resNameSub);
    $subject_name = $rowNameSub["subject_name"];
    $enroll_id = $row["enroll_id"];
    $sqlUpdate = "update enrollment set subject_name = '$subject_name' where enroll_id = '$enroll_id'";
    $resUpdate = mysqli_query($conn,$sqlUpdate);
}

