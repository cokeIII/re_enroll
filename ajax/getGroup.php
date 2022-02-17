<?php
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
$data = array();
if ($teacher_id != "ไม่พบครูผู้สอน") {
    $sql = "select 
    g.student_group_short_name, 
    g.major_name ,
    s.student_group_id
    from studing s, student_group g 
    where  s.student_group_id = g.student_group_id 
    and s.subject_id = '$subject_id' 
    and s.teacher_id = '$teacher_id' 
    and s.semes='$schoolYear' group by g.student_group_id";
} else {
    $gid = substr($Y, -2);
    $sql = "select
    g.student_group_id, 
    g.student_group_short_name, 
    g.major_name
    from student_group g 
    where g.student_group_id like '" . $gid . "%'";
}

$i = 0;
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $data[$i]["student_group_id"] = $row["student_group_id"];
    $data[$i]["major_name"] = $row["major_name"];
    $data[$i]["student_group_short_name"] = $row["student_group_short_name"];
    $i++;
}
if ($i == 0) {
    $gid = substr($Y, -2);
    $sql = "select
    g.student_group_id, 
    g.student_group_short_name, 
    g.major_name
    from student_group g 
    where g.student_group_id like '" . $gid . "%'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
        $data[$i]["student_group_id"] = $row["student_group_id"];
        $data[$i]["major_name"] = $row["major_name"];
        $data[$i]["student_group_short_name"] = $row["student_group_short_name"];
        $i++;
    }
}
echo json_encode($data);
