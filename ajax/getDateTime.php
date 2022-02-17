<?php
error_reporting(error_reporting() & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
require_once "../connect.php";
$m = date("m");
$Y = date("Y") + 543;
if ($m >= 11) {
    $Y = (date("Y") + 543) - 1;
    $term = 2;
} else if ($m >= 5) {
    $term = 1;
} else {
    $term = 3;
}

$schoolYear = $term . "/" . $Y;
$subject_id = $_REQUEST["subject_id"];
$teacher_id = $_REQUEST["teacher_id"];
$student_group_id = $_REQUEST["student_group_id"];
$data = array();
$sql = "select dpr2, dpr3 from studing where 
subject_id = '$subject_id' and 
teacher_id='$teacher_id' and 
student_group_id = '$student_group_id' and 
semes = '$schoolYear'";
$i = 0;
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
    $data["dpr2"] = $row["dpr2"];
    $data["dpr3"] = $row["dpr3"];
echo json_encode($data);
