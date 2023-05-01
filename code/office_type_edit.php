<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['office_type_id']) and $_POST['office_type_id']>0)?"แก้ไขข้อมูลประเภทหน่วยงาน":"เพิ่มข้อมูลประเภทหน่วยงาน";
?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="office_type-loading"><div class="spinner-border spinner-border-sm text-primary" role=" status "></div></span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="office_type-edit-form">

        <input type="hidden" id="office_type_id" name="office_type_id" value="<?php echo $_POST['office_type_id']; ?>">

        <div class="mb-2">
            <label for="office_type_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="office_type_name" name="office_type_name" placeholder="">
        </div>        


        <div class="mb-2">
            <label for="status_id" class="form-label">สถานะการใช้งาน</label>
            <select id="status_id" name="status_id" class="form-select"  aria-label="Default select example">
                <option value="">สถานะการใช้งาน</option>
                <?php
                $sql="select * from status order by status_name";
                $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute();
                while ($status = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $status['status_id']; ?>"><?php echo $status['status_name']; ?></option>
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
        if (isset($_POST['office_type_id']) and $_POST['office_type_id']>0){
            ?>
            $.ajax({method: "POST", url: "../code/office_type_get.php", data: {"office_type_id":<?php echo $_POST['office_type_id']; ?>}}).done(function (msg) {
                var office_type=JSON.parse(msg);
                $("#office_type_name").val(office_type.office_type_name);
                $("#status_id").val(office_type.status_id);
                
                $(".office_type-loading").html("");
            });
            <?php
        }else{
            ?>
            $(".office_type-loading").html("");
            <?php
        } ?>

        $(".save-btn").on("click touchstart", function(){
            $.ajax({method: "POST", url: "../code/office_type_edit_save.php", data: $("#office_type-edit-form").serialize()}).done(function (msg) {
                console.log(msg);
                if (msg=='1'){
                    $("#popup-main").modal("hide");
                    loadPage("","<?php echo $_POST['redirect_url']; ?>","display",{"page":<?php echo ($_POST['page'])?$_POST['page']:0; ?>});
                }else{
                    $("#popup-main").modal("hide");
                    $("#popup-server-error").modal("show");
                }
            });
        });
    })
</script>