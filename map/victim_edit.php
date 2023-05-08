<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['victim_id']) and $_POST['victim_id']>0)?"แก้ไขข้อมูลผู้ประสบอุบัติเหตุ":"เพิ่มข้อมูลผู้ประสบอุบัติเหตุ"; ?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="victim-loading"><div class="spinner-border spinner-border-sm text-primary" role=" status "></div></span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="victim-edit-form">

        <input type="hidden" id="victim_id" name="victim_id" value="<?php echo $_POST['victim_id']; ?>">

        <div class="mb-2">
            <label for="prename" class="form-label">คำนำหน้าชื่อ</label>
            <input type="text" class="form-control" id="prename" name="prename" placeholder="">
        </div>        

        <div class="mb-2">
            <label for="victim_first_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="victim_first_name" name="victim_first_name" placeholder="">
        </div>      

        <div class="mb-2">
            <label for="victim_last_name" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="victim_last_name" name="victim_last_name" placeholder="">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary save-btn">บันทึก</button>
    <button type="button" class="btn btn-warning cancel-btn" data-bs-dismiss="modal" aria-label="Close">ยกเลิก</button>
</div>   