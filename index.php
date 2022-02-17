<!doctype html>
<html lang="en">

<head>
    <?php
    require_once "setHead.php";
    require_once "connect.php";
    date_default_timezone_set("Asia/Bangkok");
    $dates = date("d/m/") . (date("Y") + 543);
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
    $sqlListSub = "select subject_id,subject_name,pp,tt,ll from studing group by subject_id";
    $resListSub = mysqli_query($conn, $sqlListSub);
    ?>
</head>

<body>

    <?php require_once "menu.php"; ?>
    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Enrollment</div>
                        <div class="card-body">
                            <form name="formEnroll" id=formEnroll method="POST" action="insertEnroll.php">
                                <div class="form-group row">
                                    <label for="studentCode" class="col-md-4 col-form-label text-md-right">รหัสนักศึกษา</label>
                                    <div class="col-md-6">
                                        <input type="number" id="studentCode" class="form-control" name="studentCode" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="studentName" class="col-md-4 col-form-label text-md-right">ชื่อ - สกุล</label>
                                    <div class="col-md-6">
                                        <input type="text" id="studentName" class="form-control" name="studentName" required readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="major_name" id="major_name">
                                <input type="hidden" name="level_edu" id="level_edu">
                                <input type="hidden" name="group_no" id="group_no">
                                <input type="hidden" name="year_edu" id="year_edu" value="<?php echo $Y; ?>">
                                <input type="hidden" name="term" id="term" value="<?php echo $term; ?>">
                                <div class="form-group row">
                                    <label for="studentName" class="col-md-4 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                        <input type="radio" id="stusentStatus" name="stusentStatus" value="ตกค้าง" required> ตกค้าง
                                        <input type="radio" id="stusentStatus2" class="ml-3" name="stusentStatus" value="ปกติ" required> ปกติ
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="studentName" class="col-md-4 col-form-label text-md-right">วันที่</label>
                                    <div class="col-md-6">
                                        <input type="text" id="enrollDate" class="form-control" name="enrollDate" value="<?php echo $dates; ?>" required readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="enrollTel" class="col-md-4 col-form-label text-md-right">เบอร์โทรศัพท์</label>
                                    <div class="col-md-6">
                                        <input type="number" id="enrollTel" class="form-control" name="enrollTel" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="studentName" class="col-md-4 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                        <input type="radio" id="subjectStatus" name="subjectStatus" value="เปิดวิชาเพิ่ม" required> เปิดวิชาเพิ่ม
                                        <input type="radio" id="subjectStatus2" class="ml-3" name="subjectStatus" value="มีอยู่ในตารางสอน" required> มีอยู่ในตารางสอน
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject" class="col-md-4 col-form-label text-md-right">รหัส-ชื่อ วิชา</label>
                                    <div class="col-md-6">
                                        <select name="subject" id="subject" class="form-control" required>
                                            <option value="">--- เลือกวิชา ---</option>
                                            <?php while ($rowListSub = mysqli_fetch_array($resListSub)) { ?>
                                                <option tt="<?php echo $rowListSub["tt"]; ?>" pp="<?php echo $rowListSub["pp"]; ?>" cc="<?php echo $rowListSub["ll"]; ?>" value="<?php echo $rowListSub["subject_id"]; ?>"><?php echo $rowListSub["subject_id"] . " " . $rowListSub["subject_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="subject_name" id="subject_name">
                                <input type="hidden" name="teacher_name" id="teacher_name">
                                <input type="hidden" name="tt" id="tt">
                                <input type="hidden" name="pp" id="pp">
                                <input type="hidden" name="cc" id="cc">
                                <div class="form-group row">
                                    <label for="teacher" class="col-md-4 col-form-label text-md-right">ครูผู้สอน</label>
                                    <div class="col-md-6" id="disTea">
                                        <select name="teacher" id="teacher" class="form-control" required>
                                            <option value="">--- เลือกครูผู้สอน ---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="groupId" class="col-md-4 col-form-label text-md-right">เรียนกับกลุ่ม</label>
                                    <div class="col-md-6">
                                        <select name="groupId" id="groupId" class="form-control" required>
                                            <option value="">--- เลือกกลุ่ม ---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dpr2" class="col-md-4 col-form-label text-md-right">วันที่เรียน</label>
                                    <div class="col-md-3">
                                        <select name="dpr2" id="dpr2" class="form-control">
                                            <option value="จันทร์">จันทร์</option>
                                            <option value="อังคาร">อังคาร</option>
                                            <option value="พุธ">พุธ</option>
                                            <option value="พฤหัส">พฤหัส</option>
                                            <option value="ศุกร์">ศุกร์</option>
                                            <option value="เสาร์">เสาร์</option>
                                            <option value="อาทิตย์">อาทิตย์</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="enrollTel" class="col-md-4 col-form-label text-md-right">เวลาเรียน</label>
                                    <div class="col-md-2">
                                        <input type="text" name="dpr3s" id="dpr3s" class="form-control" placeholder="13.30" required>
                                    </div>
                                    <div class="col-md-1">
                                        ถึง
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="dpr3e" id="dpr3e" class="form-control" placeholder="17.30" required>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        ลงทะเบียน
                                    </button>
                                </div>
                            </form>
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
        $("#subject").select2({
            width: '100%',
        })
        $("#teacher").select2({
            width: '100%'
        })
        $("#groupId").select2({
            width: '100%'
        })
        $("#subject").change(function() {
            let sName = $("#subject option:selected").text().split(" ")
            $("#subject_name").val(sName[1])
            $("#tt").val($("#subject option:selected").attr("tt"))
            $("#pp").val($("#subject option:selected").attr("pp"))
            $("#cc").val($("#subject option:selected").attr("cc"))
            console.log($("#subject").val())
            $.ajax({
                type: "POST",
                url: "ajax/getTeacher.php",
                data: {
                    subject_id: $("#subject").val(),
                },
                success: function(result) {
                    let obj = JSON.parse(result)
                    $("#teacher").html("")
                    $("#teacher").append('<option value="">--- เลือกครูผู้สอน ---</option>')
                    obj.forEach(element => {
                        $("#teacher").append('<option value="' + element.teacher_id + '">' + element.teacher_name + '</option>')
                    });

                }
            });
        })
        $(document).on('change', "#teacher", function() {
            $("#teacher_name").val($("#teacher option:selected").text())
            $.ajax({
                type: "POST",
                url: "ajax/getGroup.php",
                data: {
                    subject_id: $("#subject").val(),
                    teacher_id: $("#teacher").val()
                },
                success: function(result) {
                    let obj = JSON.parse(result)
                    $("#groupId").html("")
                    $("#groupId").append('<option value="">--- เลือกกลุ่ม ---</option>')
                    $("#groupId").append('<option value="เปิดกรณีพิเศษ">เปิดกรณีพิเศษ</option>')
                    obj.forEach(element => {
                        $("#groupId").append('<option groupId = "' + element.student_group_id + '" value="' + element.student_group_short_name + '">' + element.major_name + ' ' + element.student_group_short_name + '</option>')
                    });
                }
            });
        })
        // $("#teacher").change(function() {

        // })
        $("#groupId").change(function() {
            $.ajax({
                type: "POST",
                url: "ajax/getDateTime.php",
                data: {
                    subject_id: $("#subject").val(),
                    teacher_id: $("#teacher").val(),
                    student_group_id: $("#groupId option:selected").attr("groupId"),
                },
                success: function(result) {
                    let obj = JSON.parse(result)
                    console.log(obj)
                    if (obj.dpr3) {
                        let arrDpr3 = obj.dpr3.split("-")
                        $("#dpr3s").val(arrDpr3[0])
                        $("#dpr3e").val(arrDpr3[1])
                    }
                    $("#dpr2").val(obj.dpr2.trim())
                }
            });
        })
        $("#studentCode").keyup(function() {
            console.log($("#studentCode").val())
            if ($("#studentCode").val().length >= 10) {
                $.ajax({
                    type: "POST",
                    url: "ajax/getStd.php",
                    data: {
                        student_id: $("#studentCode").val(),
                    },
                    success: function(result) {
                        let obj = JSON.parse(result)
                        if (obj.stu_fname != null) {
                            $("#studentName").val(obj.prefix_name + obj.stu_fname + " " + obj.stu_lname)
                            $("#major_name").val(obj.major_name)
                            $("#level_edu").val(obj.grade_name)
                            $("#group_no").val(obj.student_group_no)
                        } else {
                            $("#studentName").val("")
                        }
                    }
                });
            }

        })
    })
</script>