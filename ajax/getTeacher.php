<?php
require_once "../connect.php";
date_default_timezone_set("Asia/Bangkok");
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
$data = array();

$i = 0;
// $data[$i]["teacher_id"] = "ไม่พบครูผู้สอน";
// $data[$i]["teacher_name"] = "ไม่พบครูผู้สอน";
$sql = "select teacher_name, teacher_id,tt,pp,ll from studing where subject_id = '$subject_id' and semes='$schoolYear' group by teacher_id";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res)){
    $data[$i]["teacher_id"] = $row["teacher_id"];
    $data[$i]["teacher_name"] = $row["teacher_name"];
    $data[$i]["tt"] = $row["tt"];
    $data[$i]["pp"] = $row["pp"];
    $data[$i]["ll"] = $row["ll"];
    $i++;
}
if($i == 0){
    $sql = "select teacher_name, teacher_id,tt,pp,ll from studing where semes='$schoolYear' group by teacher_id";
    $res = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($res)){
        $data[$i]["teacher_id"] = $row["teacher_id"];
        $data[$i]["teacher_name"] = $row["teacher_name"];
        $data[$i]["tt"] = $row["tt"];
        $data[$i]["pp"] = $row["pp"];
        $data[$i]["ll"] = $row["ll"];
        $i++;
    }
}
echo json_encode($data);
