<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['accident_site_id']) and $_POST['accident_site_id']>0)?"แก้ไขข้อมูลผู้ประสบอุบัติเหตุ":"เพิ่มข้อมูลผู้ประสบอุบัติเหตุ"; ?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="accident_site-loading">
            <div class="spinner-border spinner-border-sm text-primary" role=" status "></div>
        </span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body overflow-auto">
    <form id="accident_site_form">

        <?php
        print_r($_POST);
        ?>

        <input type="hidden" id="accident_id" name="accident_id" value="<?php echo $_POST['accident_id']; ?>">
        <input type="hidden" id="accident_site_id" name="accident_site_id"
            value="<?php echo $_POST['accident_site_id']; ?>">

        <div class="mb-3">
            <label for="road_id" class="form-label">เลือกถนน</label>
            <select id="road_id" name="road_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
            <label for="road_stype_id" class="form-label">เลือกลักษณะถนน</label>
            <select id="road_stype_id" name="road_stype_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="" selected>เลือกลักษณะถนน</option>
                <?php
            $sql = "select * from road_stype where status_id=:status_id order by road_stype_id";
            $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute(['status_id' => 1]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $row['road_stype_id']; ?>">
                    <?php echo $row['road_stype_name']; ?></option>
                <?php
            }?>
            </select>
        </div>

        <div class="mb-3">
            <label for="climate_id" class="form-label">ลักษณะสำคัญของสภาพอากาศ</label>
            <select id="climate_id" name="climate_id" class="form-select form-select-sm"
                aria-label=".form-select-sm example">
                <option value="" selected>เลือกลักษณะของสภาพอากาศ</option>
                <?php
            $sql = "select * from climate where status_id=:status_id order by climate_id";
            $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute(['status_id' => 1]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $row['climate_id']; ?>">
                    <?php echo $row['climate_name']; ?></option>
                <?php
            }?>
            </select>
        </div>

        <div class="mb-3">
            <label for="accident_site_detail" class="form-label">รายระเอียดจุดเกิดอุบติเหตุ</label>
            <textarea class="form-control" id="accident_site_detail" name="accident_site_detail" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="Km_at" class="form-label">กม. ที่(ถ้ามี)</label>
            <textarea class="form-control" id="Km_at" name="Km_at" rows="1"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="moo" class="form-label">หมู่</label>
            <textarea class="form-control" id="moo" name="moo" rows="1"></textarea>
        </div>

        <div class="mb-3">
            <label for="changwat_id" class="form-label">จังหวัด</label>
            <select id="changwat_id" name="changwat_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="" selected>จังหวัด</option>
                <?php
            $sql = "select * from changwat order by changwat_id";
            $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $row['changwat_id']; ?>">
                    <?php echo $row['changwat_name']; ?></option>
                <?php
            }?>
            </select>        
        </div>

        <div class="mb-3">
            <label for="ampur_id" class="form-label">อำเภอ</label>
            <select id="ampur_id" name="ampur_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="" selected>อำเภอ</option>
                <?php
            $sql = "select * from ampur order by ampur_id";
            $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $row['ampur_fullcode']; ?>">
                    <?php echo $row['ampur_name']; ?></option>
                <?php
            }?>
            </select>        
        </div>

        <div class="mb-3">
            <label for="tambon_id" class="form-label">ตำบล</label>
            <select id="tambon_id" name="tambon_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="" selected>ตำบล</option>
                <?php
            $sql = "select * from tambon order by tambon_id";
            $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $row['tambon_id']; ?>">
                    <?php echo $row['tambon_name']; ?></option>
                <?php
            }?>
            </select>
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
        console.log('ddd', $("#accident_site_form").serialize());
        $.ajax({
            method: "POST",
            url: "../map/accident_site_edit_save.php",
            data: $("#accident_site_form").serialize()
        }).done(function(msg) {
            console.log(msg);
            msg = JSON.parse(msg);
            if (msg.success == '1') {
                $("#popup-sub").modal("hide");
                $("#accident_id").val(msg.accident_id);
                loadPage("", "../map/map_input_insert_accident_site.php",
                    "accident_site_id-pane", {
                        "accident_id": $("#accident_id").val()
                    });

            }
        });
    });
    $("#ampur_id").on("change", function(){
        console.log($(this).val());
        $.ajax({
            method: "POST",
            url: "../map/getampur_option.php",
            data: {"ampur_id":$(this).val()}
        }).done(function(msg) {
            console.log(msg);
        })

    })
})
</script>