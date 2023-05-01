<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['user_type_id']) and $_POST['user_type_id']>0)?"แก้ไขข้อมูลรหัสประเภทผู้ใช้งาน":"เพิ่มข้อมูลรหัสประเภทผู้ใช้งาน";
?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="user_type-loading"><div class="spinner-border spinner-border-sm text-primary" role=" status "></div></span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="user_type-edit-form">

        <input type="hidden" id="user_type_id" name="user_type_id" value="<?php echo $_POST['user_type_id']; ?>">

        <div class="mb-2">
            <label for="user_type_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="user_type_name" name="user_type_name" placeholder="">
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
        if (isset($_POST['user_type_id']) and $_POST['user_type_id']>0){
            ?>
            $.ajax({method: "POST", url: "../code/user_type_get.php", data: {"user_type_id":<?php echo $_POST['user_type_id']; ?>}}).done(function (msg) {
                var user_type=JSON.parse(msg);
                $("#user_type_name").val(user_type.user_type_name);
                $("#status_id").val(user_type.status_id);
                
                $(".user_type-loading").html("");
            });
            <?php
        }else{
            ?>
            $(".user_type-loading").html("");
            <?php
        } ?>

        $(".save-btn").on("click touchstart", function(){
            $.ajax({method: "POST", url: "../code/user_type_edit_save.php", data: $("#user_type-edit-form").serialize()}).done(function (msg) {
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