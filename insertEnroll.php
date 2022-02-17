<?php
require_once "connect.php";
$student_id = $_REQUEST["studentCode"];
$student_name = $_REQUEST["studentName"];
$major_name = $_REQUEST["major_name"];
$level_edu = $_REQUEST["level_edu"];
$group_no = $_REQUEST["group_no"];
$year_edu = $_REQUEST["year_edu"];
$term = $_REQUEST["term"];
$date_enroll = $_REQUEST["enrollDate"];
$tel = $_REQUEST["enrollTel"];
$subject_id = $_REQUEST["subject"];
$sqlNameSub = "select subject_name from studing where subject_id = '$subject_id'";
$resNameSub = mysqli_query($conn,$sqlNameSub);
$rowNameSub = mysqli_fetch_array($resNameSub);
// $subject_name = $_REQUEST["subject_name"];
$subject_name = $rowNameSub["subject_name"];
$teacher = $_REQUEST["teacher"];
$teacher_name = $_REQUEST["teacher_name"];
$tt = $_REQUEST["tt"];
$pp = $_REQUEST["pp"];
$cc = $_REQUEST["cc"];
$group_enroll = $_REQUEST["groupId"];
$status = $_REQUEST["stusentStatus"];
$dpr2 = $_REQUEST["dpr2"];
$dpr3s = $_REQUEST["dpr3s"];
$dpr3e = $_REQUEST["dpr3e"];
$dpr3 = $_REQUEST["dpr3s"]."-".$_REQUEST["dpr3e"];
$subject_status = $_REQUEST["subjectStatus"];
$sql = "insert into enrollment (
    student_id,
    student_name,
    major_name,
    level_edu,
    group_no,
    year_edu,
    term,
    date_enroll,
    tel,
    subject_id,
    subject_name,
    teacher,
    teacher_name,
    tt,
    pp,
    cc,
    group_enroll,
    status,
    dpr2,
    dpr3,
    subject_status
    ) values(
        '$student_id',
        '$student_name',
        '$major_name',
        '$level_edu',
        '$group_no',
        '$year_edu',
        '$term',
        '$date_enroll',
        '$tel',
        '$subject_id',
        '$subject_name',
        '$teacher',
        '$teacher_name',
        '$tt',
        '$pp',
        '$cc',
        '$group_enroll',
        '$status',
        '$dpr2',
        '$dpr3',
        '$subject_status'
    )";
$res = mysqli_query($conn, $sql);
if ($res) {
    header("location: index.php");
} else {
    echo $sql;
}
