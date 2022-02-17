<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <?php
    require_once 'vendor/autoload.php';
    require_once 'vendor/mpdf/mpdf/mpdf.php';
    require_once 'connect.php';
    header('Content-Type: text/html; charset=utf-8');
    error_reporting(error_reporting() & ~E_NOTICE);
    error_reporting(E_ERROR | E_PARSE);
    // Require composer autoload
    require_once 'vendor/autoload.php';
    $dates = date("d/m/") . "/" . (date("Y") + 543);
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
    // Create an instance of the class:
    $mpdf = new mPDF([
        'default_font' => 'garuda',
    ]);


    require_once "connect.php";
    $student_id = $_REQUEST["student_id"];
    $sql = "select * from enrollment where student_id = '$student_id' and year_edu = '$Y'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    $html = "";
    $html .= '
    
    <style>
        .head-text {
            text-align: center;
        }
        body {
            font-family: "garuda";
        }
        .table,
        .th,
        .td {
            /* width: 100%; */
            line-height: 1.3;
            border: 1px solid black;
            border-collapse: collapse;
            table-layout: auto;
            font-size: 15px;
        }

        .table-h {
            width: 100%;
        }

        .td-h {
            width: 50%;
        }
        .f-14{
            font-size:14px;
        }
        .mt-l{
            margin-top: 10px;
        }
        .txt-j{
            text-align: justify;
            letter-spacing: 0;
            
        }
        .h-b{
            border: none;
        }
        .txt-c{
            text-align: center;
        }
        .pd{
            pading: 3px;
        }
        .b-t{
            border-top: 1px solid ; 
        }
        .bds{
            border: 1px solid black;
        }
    </style>

    <p class="head-text">บัตรลงทะเบียนเรียนซ้ำ เรียนแทน เรียนปรับคะแนน เรียนเพิ่ม</p>
    <p class="head-text">วิทยาลัยเทคนิคชลบุรี</p>
    <table class="table-h table">
        <tr class="th">
            <td class="td-h td">ชื่อ-สกุล  ' . $row["student_name"] . '</td>
            <td class="td-h td">รหัสประจำตัว  ' . $row["student_id"] . '</td>
        </tr>
        <tr class="th">
            <td class="td-h td">สาขาวิชาช่าง  ' . $row["major_name"] . '</td>
            <td class="td-h td">ชั้น ' . $row["level_edu"] . '  กลุ่ม  ' . $row["group_no"] . '</td>
        </tr>
        <tr class="th">
            <td class="td-h td">ปีการศึกษา ' . $row["year_edu"] . '</td>
            <td class="td-h td">ภาคเรียนที่  ' . $row["term"] . '</td>
        </tr>
        <tr class="th">
            <td class="td-h td">ลงทะเบียนวันที่  ' . $row["date_enroll"] . '</td>
            <td class="td-h td">เบอร์โทรศัพท์  ' . $row["tel"] . '</td>
        </tr>
    </table>
    <table class="table-h table">
        <tr class="th">
            <td class="td">ที่</td>
            <td class="td" width="14%">รหัสวิชา</td>
            <td class="td" width="26%">รายวิชา</td>
            <td class="td">ท</td>
            <td class="td">ป</td>
            <td class="td">น</td>
            <td class="td" width="7%">เงิน</td>
            <td class="td">เรียนกับช่าง/ชั้น/กลุ่ม</td>
            <td class="td" width="12%">ชื่อครูผู้สอน</td>
            <td class="td">ลายเซ็นครูผู้สอน</td>
            <td class="td">งานหลักสูตร</td>
        </tr>
        ';
    $resList = mysqli_query($conn, $sql);
    $no = 0;
    while ($rowList = mysqli_fetch_array($resList)) {
        $html .= '
            <tr class="th">
            <td class="td">' . (++$no) . '</td>
            <td class="td" width="14%">' . $rowList["subject_id"] . '</td>
            <td class="td" width="26%">' . $rowList["subject_name"] . $rowList["dpr2"].' '.$rowList["dpr3"].' '.$rowList["subject_status"].'</td>
            <td class="td">' . ($rowList["tt"] ? $rowList["tt"] : '') . '</td>
            <td class="td">' . ($rowList["pp"] ? $rowList["pp"] : '') . '</td>
            <td class="td">' . ($rowList["cc"] ? $rowList["cc"] : '') . '</td>
            <td class="td" width="7%"></td>
            <td class="td" width="12%">' . $rowList["group_enroll"] . '</td>
            <td class="td" width="12%">' . ($rowList["teacher_name"] != 'ไม่พบครูผู้สอน'?$rowList["teacher_name"]:'') . '</td>
            <td class="td"></td>
            <td class="td"></td>
            </tr>
            ';
    }
    $html .= '
    </table>
    <table class="table-h table">
        <tr class="th">
           <td class="td">
                <p>ผลการตรวจสภาพ</p>
                <p class="f-14">* สำหรับนักเรียนที่ไม่จบหลักสูตรตามกำหนด(ตกค้าง) นักเรียน นักศึกษาที่ลงทะเบียนปกติแล้ว ไม่ต้องตรวจสุขภาพ</p>
                <p>(   ) ผ่านการตรวจสภาพ อนุญาติให้ลงทะเบียนได้ &ensp; (   ) ไม่ผ่านการตรวจสภาพ (กลับไปปรับปรุงแก้ไข)</p>
                <br>
                <p>ลงชื่อ........................................ครูปกครอง</p>
            </td>
        </tr>
    </table>
    <table class="table-h table">
        <tr class="th">
            <td class="td" colspan="2">ลงทะเบียนปกติ...............คาบ &ensp;&ensp; ลงทะเบียนซ้ำ...............คาบ &ensp;&ensp; รวมลงทะเบียนทั้งหมด...............คาบ</td>
        </tr>
        <tr class="txt-j th">
            <td width="50% " class="td">
                ';
                if($row["status"] == "ตกค้าง"){
                $html .=  '
                <table class="table-h" cellspacing="0" cellpadding="0">
                <tr>
                    <td>ค่าบำรุงสุขภาพ,ห้องพยาบาล </td>
                    <td> .............บาท</td>
                </tr>                    <tr>
                    <td>ค่ารักษาห้องสมุด </td>
                    <td> .............บาท</td>
                </tr>                    <tr>
                    <td>ค่ารักษาสภาพแวดล้อม </td>
                    <td> .............บาท</td>
                </tr>                    <tr>
                    <td>ค่าอินเทอร์เน็ต </td>
                    <td> .............บาท</td>
                </tr>                    <tr>
                    <td>ค่ารายวิชา </td>
                    <td> .............บาท</td>
                </tr>                    
                <tr>
                    <td>ค่าปรับลงทะเบียนเกินกำหนด</td>
                    <td> .............บาท</td>
                </tr>
                <tr>
                    <td>ค่า.......................................</td>
                    <td> .............บาท</td>
                </tr>

                </tr>                    
                <tr class="" width="100%" >
                
                    <td class="b-t txt-c" colspan="2">
                    <br>รวมเงิน
                    .......................บาท</td>
                </tr>
                </table>';
}
            $html .= '
            </td>
            <td class="td pd">
            <br>
                <p>ลงชื่อ.......................................นักเรียน/นักศึกษา</p>
                <p>ลงชื่อ.......................................ครูที่ปรึกษา</p>
                <p>ลงชื่อ.......................................งานทะเบียน</p>
                <p>ลงชื่อ.......................................งานการเงิน</p><br>
                ใบเสร็จเล่มที่............................เลขที่.......................<br>
                ลงวันที่..............................................................
            </td>
        </tr>
    </table>
    <br>
    <u>หมายเหตุ</u> 1.เมื่อผ่านครูผู้สอนเซ็นครบทุกวิชาที่ลงทะเบียน ให้ผ่านฝ่ายวิชาการเซ็นชื่อรับรองว่าคาบเรียนไหนทับกัน
    <br>
    <hr>
    <div class="txt-c bds">บัตรเช้าชั้นเรียน (สำหรับเรียนซ้ำ เรียนเพิ่ม เรียนแทน)</div>
    <div class="txt-c">ภาคเรียน...............ปีการศึกษา...............</div>
    <div>ชื่อ-สกุล..........................................รหัสประจำตัว................................ฃั้น........................ช่าง...........................</div>
    <div>ลงทะเบียนเรียนวิชา.......................................รหัสวิชา....................................อาจารย์ผู้สอน..............................</div>
    <div>เรียนกับชั้น...................ช่าง..........................กลุ่ม................วัน............เวลา..............ได้ผลการเรียน..................</div>
    <div class="txt-c bds" >ส่งบัตรเข้าชั้นเรียนให้อาจารย์ผู้สอนในคาบ</div>

    ';

    function fName($name){
        $res = explode(" ",$name);
        return $res[0];
    }
    // Write some HTML code:
    $mpdf->WriteHTML($html);

    // Output a PDF file directly to the browser
    $mpdf->Output();
    ?>
</body>

</html>