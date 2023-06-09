<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['victim_id']) and $_POST['victim_id']>0)?"แก้ไขข้อมูลผู้ประสบอุบัติเหตุ":"เพิ่มข้อมูลผู้ประสบอุบัติเหตุ"; ?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="victim-loading">
            <div class="spinner-border spinner-border-sm text-primary" role=" status "></div>
        </span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="victim_form">
        <?php
        print_r($_POST);
        ?>

        <input type="hidden" id="accident_id" name="accident_id" value="<?php echo $_POST['accident_id']; ?>">
        <input type="hidden" id="victim_id" name="victim_id" value="<?php echo $_POST['victim_id']; ?>">

        <div class="mb-2">
            <label for="prename_id" class="form-label">คำนำหน้าชื่อ</label>
            <select id="prename_id" name="prename_id" class="form-select form-select-sm"
                aria-label=".form-select-sm example">
                <option value="" selected>คำนำหน้าชื่อ</option>
                <?php
                    $sql = "select * from prename where status_id=:status_id order by prename_id";
                    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                    $stmt->execute(['status_id' => 1]);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {                    ?>
                <option value="<?php echo $row['prename_id']; ?>">
                    <?php echo $row['prename_name']; ?></option>
                <?php
                    }?>
            </select>
        </div>

        <div class="mb-2">
            <label for="first_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="">
        </div>

        <div class="mb-2">
            <label for="last_name" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="">
        </div>
        <div class="mb-2">
            <label for="cid" class="form-label">เลขบัตรประชาชน</label>
            <input type="text" class="form-control" id="cid" name="cid" placeholder="">
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
        console.log('ddd', $("#victim_form").serialize());
        $.ajax({
            method: "POST",
            url: "../map/victim_edit_save.php",
            data: $("#victim_form").serialize()
        }).done(function(msg) {
            console.log(msg);
            msg = JSON.parse(msg);
            if (msg.success == '1') {
                $("#popup-sub").modal("hide");
                $("#accident_id").val(msg.accident_id);
                loadPage("", "../map/map_input_insert_victim.php", "victim_id-pane", {
                    "accident_id": $("#accident_id").val()
                });

            }
        });
    });
})
</script>