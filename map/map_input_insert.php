<?php
include "../include/connection.php";
include "../include/function.php";
?>

<div class="modal-header">
    <h5 class="modal-title modal-label">เพิ่มข้อมูลการแจ้งเหตุ</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="map_form">
        <div class="mb-1">
            <label for="sos_type_id" class="form-label">ประเภทการแจ้งเหตุ</label>
            <div class="container">


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="ambulance_id" data-bs-toggle="tab"
                            data-bs-target="#ambulance_id-pane" type="button" role="tab"
                            aria-controls="ambulance_id-pane" aria-selected="true">กู้ภัย</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="victim_id" data-bs-toggle="tab" data-bs-target="#victim_id-pane"
                            type="button" role="tab" aria-controls="victim_id-pane"
                            aria-selected="false">ผู้ประสบอุบัติเหตุ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vehicle_id" data-bs-toggle="tab" data-bs-target="#vehicle_id-pane"
                            type="button" role="tab" aria-controls="vehicle_id-pane"
                            aria-selected="false">รายระเอียดยานพาหนะ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="road_id" data-bs-toggle="tab" data-bs-target="#road_id-pane"
                            type="button" role="tab" aria-controls="road_id-pane"
                            aria-selected="false">รายระเอียดจุดเกิดอุบัติเหตุ</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ambulance_id-pane" role="tabpanel"
                        aria-labelledby="ambulance_id" tabindex="0">


                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Example
                                textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- รายระเอียดผู้ป่วย -->

                    <div class="tab-pane fade" id="victim_id-pane" role="tabpanel" aria-labelledby="victim_id"
                        tabindex="0">




















                    </div>

                    <!-- รายระเอียดรถของผู้ประสบเหตุ -->

                    <div class="tab-pane fade" id="vehicle_id-pane" role="tabpanel" aria-labelledby="vehicle_id"
                        tabindex="0">
                        <div class="mb-3">
                            <label for="vehicle_type_id" class="form-label">รถของผู้ประสบเหตุ</label>
                            <select id="vehicle_type_id" name="vehicle_type_id" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                                <option value="" selected>เลือกประเภทรถ</option><br>
                                <?php
                                    $sql = "select * from vehicle_type where status_id=:status_id order by vehicle_type_id";
                                    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                                    $stmt->execute(['status_id' => 1]);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                <option value="<?php echo $row['vehicle_type_id']; ?>">
                                    <?php echo $row['vehicle_type_name']; ?></option>
                                <?php
                                   }?>
                            </select><br>
                        </div>
                        รถของคุ่กรณี
                        <select class="mb-3 form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>เลือกประเภทรถ</option><br>
                            <option value="1">เดินเท้า</option>
                            <option value="2">จักรยาน</option>
                            <option value="3">จักรยานไฟฟ้า</option>
                            <option value="4">จักรยานยนต์</option>
                            <option value="5">รถกระบะ(บิกอัพ)</option>
                            <option value="6">รถเก๋ง</option>
                            <option value="7">สามล้อเคลื่อน</option>
                            <option value="8">รถซาเล้ง</option>
                            <option value="9">รถแท็กซี่</option>
                            <option value="10">รถตู้ทั่วไป</option>
                            <option value="11">รถสองแถว</option>
                            <option value="12">รถโดยสาร 6 ล้อ</option>
                            <option value="13">รถบรรทุก 6 ล้อ</option>
                            <option value="14">รถไถนา</option>
                            <option value="15">รถดัดแปลง</option>
                            <option value="16">สัตว์ตัดหน้า</option>
                            <option value="17">ไม่มี</option>
                        </select><br>
                        สาเหตุของอาการบาดเจ็บ
                        <select class="mb-3 form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>เลือกสาเหตุ</option><br>
                            <option value="1">ถูกชน</option>
                            <option value="2">ชนกับสัตว์</option>
                            <option value="3">ชนสะพาน</option>
                            <option value="4">ชนกับเสาไฟฟ้า</option>
                            <option value="5">ชนกับป้ายจราจร</option>
                            <option value="6">ชนกับสิ่งอื่น</option>
                            <option value="7">ตกจากพาหนะ</option>
                            <option value="8">พาหนะคว่ำ</option>
                            <option value="9">พาหนะล้ม</option>
                            <option value="10">พาหนะจมน้ำ</option>
                            <option value="11">อื่นๆ</option>
                            <option value="12">ไม่ทราบ</option>
                        </select><br>
                        รถของคุ่กรณี
                        <select class="mb-3 form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>เลือกการป้องกัน</option><br>
                            <option value="1">สวมหมวกนิรภัย</option>
                            <option value="2">ไม่สวมหมวกนิรภัย</option>
                            <option value="3">คาดเข็มขัดนิรภัย</option>
                            <option value="4">ไม่คาดเข็มขัดนิรภัย</option>
                            <option value="5">ไม่ทราบ</option>
                            <option value="6">ไม่ต้องใช้</option>
                        </select><br>
                    </div>

                    <!-- รายระเอียดจุดเกิดอุบัติเหตุ -->

                    <div class="tab-pane fade" id="road_id-pane" role="tabpanel" aria-labelledby="disabled-tab"
                        tabindex="0">
                        <div class="mb-3">
                            <label for="road_id" class="form-label">เลือกถนน</label>
                            <select id="road_id" name="road_id" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                                <option value="" selected>เลือกถนน</option>
                                <?php
                                    $sql = "select * from road where status_id=:status_id order by road_id";
                                    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                                    $stmt->execute(['status_id' => 1]);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                <option value="<?php echo $row['road_id']; ?>">
                                    <?php echo $row['road_name']; ?></option>
                                <?php
                                    }?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="climate_id" class="form-label">ลักษณะสำคัญของสภาพอากาศ</label>
                            <!-- บรรทัดนี้ทำให้เมื่อนำเมาส์ไปชี้ที่คำว่า "ลักษะสำคัญของสภาพอากาศ" จะขึ้นแสงที่ช่อง seclect-->
                            <select id="climate_id" name="climate_id" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                                <option value="" selected>เลือกลักษณะของสภาพอากาศ</option>
                                <?php
                                    $sql = "select * from climate where status_id=:status_id order by climate_id";
                                    // บรรทัดบนเป็นตัวเลือกคอลั่มในฐานะข้อมูล
                                    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                                    $stmt->execute(['status_id' => 1]);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    // บรรทัดบนถ้าไม่ใส่ while มันจะแสดงแค่อันเดียว  ต้องวนซ้ำใส่สำหรับอันที่มีหลายตัวเลือก
                                        ?>
                                <option value="<?php echo $row['climate_id']; ?>">
                                    <?php echo $row['climate_name']; ?></option>
                                <!-- สองบรรทัดด้านบนเป็นตัวเรียก id กับ name จาก MySQL -->
                                <?php
                                    //ใส่ <?php เพื่อปิดฟังก์ชั่นการวนลูป
                                   }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea-ACC" class="form-label">รายระเอียดจุดเกิดอุบติเหตุ</label>
                            <textarea class="form-control" id="Textarea-ACC" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea-KM" class="form-label">กม. ที่(ถ้ามี)</label>
                            <textarea class="form-control" id="Textarea-KM" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea-G" class="form-label">หมู่</label>
                            <textarea class="form-control" id="Textarea-G" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea-G" class="form-label">ตำบล</label>
                            <textarea class="form-control" id="Textarea-G" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea-canton" class="form-label">อำเภอ</label>
                            <textarea class="form-control" id="Textarea-canton" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea-KM" class="form-label">จังหวัด</label>
                            <textarea class="form-control" id="Textarea-ACC" rows="1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary save-btn">บันทึก</button>
    <button type="button" class="btn btn-warning cancel-btn" data-bs-dismiss="modal" aria-label="Close">ยกเลิก</button>
</div>
<script>
$(function() {
    loadPage("", "../map/map_input_insert_victim.php", "victim_id-pane", {});
    $(".save-btn").on("click touchstart", function() {
        console.log('ddd', $("#map_form").serialize());
        $.ajax({
            method: "POST",
            url: "../map/map_input_save.php",
            data: $("#map_form").serialize()
        }).done(function(msg) {
            console.log(msg);
            if (msg == '1') {
                $("#popup-main").modal("hide");
                loadPage("", "../office/office.php", "display", {
                    "page": <?php echo ($_POST['page'])?$_POST['page']:0; ?>
                });
            } else {
                $("#popup-main").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });
})
</script>