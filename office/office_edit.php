<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['office_id']) and $_POST['office_id']>0)?"แก้ไขข้อมูลหน่วยงาน":"เพิ่มข้อมูลหน่วยงาน";
?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="office-loading"><div class="spinner-border spinner-border-sm text-primary" role=" status "></div></span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="office-edit-form">
        <input type="hidden" id="office_id" name="office_id" value="<?php echo $_POST['office_id']; ?>">
        <div class="mb-2">
            <label for="office_code" class="form-label">รหัสหน่วยงาน</label>
            <input type="text" class="form-control" id="office_code" name="office_code" placeholder="">
        </div>            
        <div class="mb-2">
            <label for="office_name" class="form-label">ชื่อหน่วยงาน</label>
            <input type="text" class="form-control" id="office_name" name="office_name" placeholder="">
        </div>      
        <div class="mb-2">
            <label for="office_type_code" class="form-label">ประเภทหน่วยงาน</label>
            <select id="office_type_code" name="office_type_code" class="form-select"  aria-label="Default select example">
                <option value="">เลือกประเภทหน่วยงาน</option>
                <?php
                $sql="select * from office_type where status_id=:status_id order by office_type_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute(['status_id' => 1]);
                while ($office_type = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $office_type['office_type_code']; ?>"><?php echo $office_type['office_type_name']; ?></option>
                    <?php
                }?>
            </select>      
        </div>      
        <div class="mb-2">
            <label for="ampur_fullcode" class="form-label">อำเภอ</label>
            <select id="ampur_fullcode" name="ampur_fullcode" class="form-select"  aria-label="Default select example">
                <option value="">เลือกอำเภอ</option>
                <?php
                $sql="select * from ampur order by ampur_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute();
                while ($ampur = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $ampur['ampur_fullcode']; ?>"><?php echo $ampur['ampur_name']; ?></option>
                    <?php
                }?>
            </select>      
        </div>      
        <div class="mb-2">
            <label for="tambon_fullcode" class="form-label">ตำบล</label>
            <select id="tambon_fullcode" name="tambon_fullcode" class="form-select"  aria-label="Default select example">
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
        if (isset($_POST['office_id']) and $_POST['office_id']>0){
            ?>
            $.ajax({method: "POST", url: "../office/office_get.php", data: {"office_id":<?php echo $_POST['office_id']; ?>}}).done(function (msg) {
                var office=JSON.parse(msg);
                $("#office_code").val(office.office_code);
                $("#office_name").val(office.office_name);
                $("#office_type_code").val(office.office_type_code);
                $("#ampur_fullcode").val(office.ampur_fullcode);
                $.ajax({method: "POST", url: "../utility/get_option.php", data: {"table":"tambon","where":"ampur_fullcode='"+office.ampur_fullcode+"'"}}).done(function (msg) {
                    $("#tambon_fullcode").html('<option value="">เลือกตำบล</option>'+msg);
                    $("#tambon_fullcode").val(office.tambon_fullcode);
                });

                $(".office-loading").html("");
            });
            <?php
        }else{
            ?>
            $(".office-loading").html("");
            <?php
        } ?>

        $("#ampur_fullcode").on("change",function(){
            $.ajax({method: "POST", url: "../utility/get_option.php", data: {"table":"tambon","where":"ampur_fullcode='"+$(this).val()+"'"}}).done(function (msg) {
                $("#tambon_fullcode").html('<option value="">เลือกตำบล</option>'+msg);
            });
        });
        $(".save-btn").on("click touchstart", function(){
            $.ajax({method: "POST", url: "../office/office_edit_save.php", data: $("#office-edit-form").serialize()}).done(function (msg) {
                console.log(msg);
                if (msg=='1'){
                    $("#popup-main").modal("hide");
                    loadPage("","../office/office.php","display",{"page":<?php echo $_POST['page']; ?>});
                }else{
                    $("#popup-main").modal("hide");
                    $("#popup-server-error").modal("show");
                }
            });
        });
    })
</script>