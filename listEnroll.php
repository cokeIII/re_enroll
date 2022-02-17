<!doctype html>
<html lang="en">

<head>
    <?php
    require_once "setHead.php";
    require_once "connect.php";
    date_default_timezone_set("Asia/Bangkok");
    $dates = date("Y-m-d");
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
    if (!empty($_REQUEST["student_id"])) {
        $student_id = $_REQUEST["student_id"];
        $sql = "select * from enrollment where student_id = '$student_id'";
        $res = mysqli_query($conn, $sql);
    } else {
        $sql = "select * from enrollment";
    }
    ?>
</head>

<body>

    <?php require_once "menu.php"; ?>
    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">Enrollment Lits</div>
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <form name="formEnroll" id=formEnroll method="POST" action="listEnroll.php">
                                        <div class="input-group ">
                                            <input name="student_id" id="student_id" class="form-control" type="text" placeholder="รหัสนักศึกษาที่ต้องการพิมพ์รายงาน" aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-darkgray"><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-success mt-3" id="printEnroll">พิมพ์ใบลงทะเบียน</button>
                                    </div>
                                </div>
                            </div>
                            <table class="table " id="listEnroll">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อนักเรียน-นักศึกษา</th>
                                        <th>รายวิชา</th>
                                        <th>ครูผู้สอน</th>
                                        <th>เรียนกับกลุ่ม</th>
                                        <!-- <th></th> -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($_REQUEST["student_id"])) {
                                        $no = 0;
                                        while ($row = mysqli_fetch_array($res)) { ?>
                                            <tr>
                                                <td><?php echo ++$no; ?></td>
                                                <td><?php echo $row["student_name"]; ?></td>
                                                <td><?php echo $row["subject_id"] . " " . $row["subject_name"] . " " . $row["dpr2"] . " " . $row["dpr3"] . " " . $row["subject_status"]; ?></td>
                                                <td><?php echo $row["teacher_name"]; ?></td>
                                                <td><?php echo $row["group_enroll"]; ?></td>
                                                <!-- <td><a href="formEdit.php?enroll_id =<?php //echo $row['enroll_id ']; 
                                                                                            ?>"><button class="btn btn-warning">แก้ไข</button></a></td> -->
                                                <td><button enroll_id="<?php echo $row['enroll_id']; ?>" class="btn btn-danger delEnroll">ลบ</button></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {
        $("#listEnroll").DataTable()
        $("#printEnroll").click(function() {
            if ($("#student_id").val() != "" && $("#student_id").val().length >= 10) {
                $.redirect("printEnroll.php", {
                        student_id: $("#student_id").val(),
                    },
                    "POST",
                    "_blank"
                );

            } else {
                alert("กรุณาใส่รหัสนักศึกษา")
            }
        })
        $(".delEnroll").click(function() {
            if (confirm("คุณต้องการลบรายการ ?")) {
                $.redirect("delEnroll.php", {
                    enroll_id: $(this).attr("enroll_id"),
                });
            }
        })
    })
</script>