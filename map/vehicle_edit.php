<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['vehicle_id']) and $_POST['vehicle_id']>0)?"แก้ไขข้อมูลรถของผู้ประสบอุบัติเหตุ":"เพิ่มข้อมูลรถของผู้ประสบอุบัติเหตุ"; ?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="vehicle-loading">
            <div class="spinner-border spinner-border-sm text-primary" role=" status "></div>
        </span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="vehicle_form">
        <?php
        print_r($_POST);
        ?>

        <input type="hidden" id="accident_id" name="accident_id" value="<?php echo $_POST['accident_id']; ?>">
        <input type="hidden" id="vehicle_id" name="vehicle_id" value="<?php echo $_POST['vehicle_id']; ?>">

        <div class="mb-2">
            <label for="vehicle_type_id" class="form-label">ประเภทรถ</label>
            <select id="prename_id" name="vehicle_type_id" class="form-select form-select-sm"
                aria-label=".form-select-sm example">
                <option value="" selected>เลือกประเภทรถ</option>
                <?php
                    $sql = "select * from vehicle_type where status_id=:status_id order by vehicle_type_id";
                    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                    $stmt->execute(['status_id' => 1]);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {                    ?>
                <option value="<?php echo $row['vehicle_type_id']; ?>">
                    <?php echo $row['vehicle_type_name']; ?></option>
                <?php
                    }?>
            </select>
        </div>

        <div class="mb-2">
            <label for="register_no" class="form-label">ทะเบียน</label>
            <input type="text" class="form-control" id="register_no" name="register_no" placeholder="">
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
    $(".save-btn").on("click touchstart", function() {
        console.log('ddd', $("#vehicle_form").serialize());
        $.ajax({
            method: "POST",
            url: "../map/vehicle_edit_save.php",
            data: $("#vehicle_form").serialize()
        }).done(function(msg) {
            console.log(msg);
            msg = JSON.parse(msg);
            if (msg.success == '1') {
                $("#popup-sub").modal("hide");
                $("#accident_id").val(msg.accident_id);
                loadPage("", "../map/map_input_insert_vehicle.php", "vehicle_id-pane", {
                    "accident_id": $("#accident_id").val()
                });

            }
        });
    });
})
</script>
<!-- <div class="mb-3">
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
</select><br> -->