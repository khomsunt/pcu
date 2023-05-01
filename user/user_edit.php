<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['user_id']) and $_POST['user_id']>0)?"แก้ไขข้อมูลผู้ใช้งาน":"เพิ่มข้อมูลผู้ใช้งาน";
?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="user-loading"><div class="spinner-border spinner-border-sm text-primary" role=" status "></div></span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="user-edit-form">

        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_POST['user_id']; ?>">

        <div class="mb-2">
            <label for="prename" class="form-label">คำนำหน้าชื่อ</label>
            <input type="text" class="form-control" id="prename" name="prename" placeholder="">
        </div>        

        <div class="mb-2">
            <label for="user_first_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="user_first_name" name="user_first_name" placeholder="">
        </div>      

        <div class="mb-2">
            <label for="user_last_name" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="user_last_name" name="user_last_name" placeholder="">
        </div>      

        <div class="mb-2">
            <label for="cid" class="form-label">เลขบัตรประชาชน</label>
            <input type="text" class="form-control" id="cid" name="cid" placeholder="">
        </div>      

        <div class="mb-2">
            <label for="postion_id" class="form-label">ตำแหน่ง</label>
            <select id="postion_id" name="postion_id" class="form-select"  aria-label="Default select example">
                <option value="">เลือกตำแหน่ง</option>
                <?php
                $sql="select * from position where status_id=:status_id order by position_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute(['status_id' => 1]);
                while ($position = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
                    <?php
                }?>
            </select>      
        </div>      

        <div class="mb-2">
            <label for="position_level_id" class="form-label">ระดับ</label></label>
            <select id="position_level_id" name="position_level_id" class="form-select"  aria-label="Default select example">
                <option value="">เลือกระดับ</option>
                <?php
                $sql="select * from position_level where status_id=:status_id order by position_level_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute(['status_id' => 1]);
                while ($position_level = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $position_level['position_level_id']; ?>"><?php echo $position_level['position_level_name']; ?></option>
                    <?php
                }?>
            </select>      
        </div>      

        <div class="mb-2">
            <label for="office_id" class="form-label">หน่วยงาน</label>
            <select id="office_id" name="office_id" class="form-select"  aria-label="Default select example">
                <option value="">เลือกหน่วยงาน</option>
                <?php
                $sql="select * from office order by office_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute();
                while ($ampur = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $ampur['office_id']; ?>"><?php echo $ampur['office_name']; ?></option>
                    <?php
                }?>
            </select>      
        </div>     
        
        <div class="mb-2">
            <label for="user_type_id" class="form-label">ประเภทผู้ใช้งาน</label>
            <select id="user_type_id" name="user_type_id" class="form-select"  aria-label="Default select example">
                <option value="">เลือกประเภทผู้ใช้งาน</option>
                <?php
                $sql="select * from user_type where status_id=:status_id order by user_type_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute(['status_id' => 1]);
                while ($user_type = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $user_type['user_type_id']; ?>"><?php echo $user_type['user_type_name']; ?></option>
                    <?php
                }?>
            </select>      
        </div>      
        
        <div class="mb-2">
            <label for="user_status_id" class="form-label">สถานะผู้ใช้งาน</label>
            <select id="user_status_id" name="user_status_id" class="form-select"  aria-label="Default select example">
                <option value="">สถานะผู้ใช้งาน</option>
                <?php
                $sql="select * from user_status where status_id=:status_id order by user_status_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute(['status_id' => 1]);
                while ($user_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $user_status['user_status_id']; ?>"><?php echo $user_status['user_status_name']; ?></option>
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
    $(function(){
        <?php
        if (isset($_POST['user_id']) and $_POST['user_id']>0){
            ?>
            $.ajax({method: "POST", url: "../user/user_get.php", data: {"user_id":<?php echo $_POST['user_id']; ?>}}).done(function (msg) {
                var user=JSON.parse(msg);
                $("#user_code").val(user.user_code);
                $("#user_name").val(user.user_name);
                $("#user_type_code").val(user.user_type_code);
                $("#ampur_fullcode").val(user.ampur_fullcode);
                $.ajax({method: "POST", url: "../utility/get_option.php", data: {"table":"tambon","where":"ampur_fullcode='"+user.ampur_fullcode+"'"}}).done(function (msg) {
                    $("#tambon_fullcode").html('<option value="">เลือกตำบล</option>'+msg);
                    $("#tambon_fullcode").val(user.tambon_fullcode);
                });

                $(".user-loading").html("");
            });
            <?php
        }else{
            ?>
            $(".user-loading").html("");
            <?php
        } ?>

        $(".save-btn").on("click touchstart", function(){
            $.ajax({method: "POST", url: "../user/user_edit_save.php", data: $("#user-edit-form").serialize()}).done(function (msg) {
                console.log(msg);
                if (msg=='1'){
                    $("#popup-main").modal("hide");
                    loadPage("","../user/user.php","display",{"page":<?php echo ($_POST['page'])?$_POST['page']:0; ?>});
                }else{
                    $("#popup-main").modal("hide");
                    $("#popup-server-error").modal("show");
                }
            });
        });
    })
</script>