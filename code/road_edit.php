<?php
include "../include/connection.php";
include "../include/function.php";
$popup_title=(isset($_POST['road_id']) and $_POST['road_id']>0)?"แก้ไขข้อมูลรหัสปรเภทถนน":"เพิ่มข้อมูลรหัสประเภทถนน";
?>
<div class="modal-header">
    <h5 class="modal-title modal-label">
        <?php echo $popup_title; ?>
        <span class="road-loading"><div class="spinner-border spinner-border-sm text-primary" role=" status "></div></span>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="road-edit-form">

        <input type="hidden" id="road_id" name="road_id" value="<?php echo $_POST['road_id']; ?>">

        <div class="mb-2">
            <label for="road_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="road_name" name="road_name" placeholder="">
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
        if (isset($_POST['road_id']) and $_POST['road_id']>0){
            ?>
            $.ajax({method: "POST", url: "../code/road_get.php", data: {"road_id":<?php echo $_POST['road_id']; ?>}}).done(function (msg) {
                var road=JSON.parse(msg);
                $("#road_name").val(road.road_name);
                $("#status_id").val(road.status_id);
                
                $(".road-loading").html("");
            });
            <?php
        }else{
            ?>
            $(".road-loading").html("");
            <?php
        } ?>

        $(".save-btn").on("click touchstart", function(){
            $.ajax({method: "POST", url: "../code/road_edit_save.php", data: $("#road-edit-form").serialize()}).done(function (msg) {
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