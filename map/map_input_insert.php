<?php
include "../include/connection.php";
include "../include/function.php";
?>

<div class="modal-header">
    <h5 class="modal-title modal-label">เพิ่มข้อมูลการแจ้งเหตุ.</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="map_form">
        <input type="hidden" id="accident_id" name="accident_id" value="0">
        <div class="mb-1">
            <label for="sos_type_id" class="form-label">ประเภทการแจ้งเหตุ</label>
            <div class="container">


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="victim_id" data-bs-toggle="tab" data-bs-target="#victim_id-pane"
                            type="button" role="tab" aria-controls="victim_id-pane"
                            aria-selected="false">ผู้ประสบอุบัติเหตุ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vehicle_id" data-bs-toggle="tab" data-bs-target="#vehicle_id-pane"
                            type="button" role="tab" aria-controls="vehicle_id-pane"
                            aria-selected="false">รายระเอียดยานพาหนะ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="accident_site" data-bs-toggle="tab" data-bs-target="#accident_site-pane"
                            type="button" role="tab" aria-controls="accident_site-pane"
                            aria-selected="false">รายระเอียดจุดเกิดอุบัติเหตุ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="ambulance_id" data-bs-toggle="tab"
                            data-bs-target="#ambulance_id-pane" type="button" role="tab"
                            aria-controls="ambulance_id-pane" aria-selected="true">กู้ภัย</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ambulance_id-pane" role="tabpanel"
                        aria-labelledby="ambulance_id" tabindex="0">


                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Example
                                textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- รายระเอียดผู้ป่วย -->

                    <div class="tab-pane fade" id="victim_id-pane" role="tabpanel" aria-labelledby="victim_id"
                        tabindex="0">

                    </div>

                    <!-- รายระเอียดรถของผู้ประสบเหตุ -->

                    <div class="tab-pane fade" id="vehicle_id-pane" role="tabpanel" aria-labelledby="vehicle_id"
                        tabindex="0">
                        
                    </div>

                    <!-- รายระเอียดจุดเกิดอุบัติเหตุ -->

                    <div class="tab-pane fade" id="accident_site-pane" role="tabpanel" aria-labelledby="disabled-tab"
                        tabindex="0">
                        
                    </div>
                </div>
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
    loadPage("", "../map/map_input_insert_victim.php", "victim_id-pane", {"accident_id":$("#accident_id").val()});
    loadPage("", "../map/map_input_insert_vehicle.php", "vehicle_id-pane", {"accident_id":$("#accident_id").val()});
    loadPage("", "../map/map_input_insert_accident_site.php", "accident_site-pane", {"accident_id":$("#accident_id").val()});
    $(".save-btn").on("click touchstart", function() {
        console.log('ddd', $("#map_form").serialize());
        $.ajax({
            method: "POST",
            url: "../map/map_input_save.php",
            data: $("#map_form").serialize()
        }).done(function(msg) {
            console.log(msg);
            if (msg == '1') {
                $("#popup-main").modal("hide");
                loadPage("", "../office/office.php", "display", {
                    "page": <?php echo ($_POST['page'])?$_POST['page']:0; ?>
                });
            } else {
                $("#popup-main").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });
})
</script>