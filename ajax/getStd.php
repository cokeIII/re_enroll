<?php
require_once "../connect.php";
$student_id = $_REQUEST["student_id"];
$sql = "select * from 
    student std 
    inner join prefix pre on std.perfix_id = pre.prefix_id 
    inner join student_group gro on std.group_id = gro.student_group_id
    where std.student_id = '$student_id'
    ";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$data = array();
$data["student_id"] = $row["student_id"];
$data["stu_fname"] = $row["stu_fname"];
$data["stu_lname"] = $row["stu_lname"];
$data["prefix_name"] = $row["prefix_name"];
$data["major_name"] = $row["major_name"];
$data["grade_name"] = $row["grade_name"];
$data["student_group_no"] = $row["student_group_no"];
$data["student_group_short_name"] = $row["student_group_short_name"];

echo json_encode($data);
