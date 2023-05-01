<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['position_id']) and $_POST['position_id']>0)?"แก้ไขข้อมูลรหัสตำแหน่ง":"เพิ่มข้อมูลรหัสตำแหน่ง";
?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="position-loading"><div class="spinner-border spinner-border-sm text-primary" role=" status "></div></span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="position-edit-form">

        <input type="hidden" id="position_id" name="position_id" value="<?php echo $_POST['position_id']; ?>">

        <div class="mb-2">
            <label for="position_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="position_name" name="position_name" placeholder="">
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
        if (isset($_POST['position_id']) and $_POST['position_id']>0){
            ?>
            $.ajax({method: "POST", url: "../code/position_get.php", data: {"position_id":<?php echo $_POST['position_id']; ?>}}).done(function (msg) {
                var position=JSON.parse(msg);
                $("#position_name").val(position.position_name);
                $("#status_id").val(position.status_id);
                
                $(".position-loading").html("");
            });
            <?php
        }else{
            ?>
            $(".position-loading").html("");
            <?php
        } ?>

        $(".save-btn").on("click touchstart", function(){
            $.ajax({method: "POST", url: "../code/position_edit_save.php", data: $("#position-edit-form").serialize()}).done(function (msg) {
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