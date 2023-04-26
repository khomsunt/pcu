<div id="googleTitle">
    <h1>My First Google Map</h1>
</div>

<div id="googleMap" style="width:100%;"></div>

<div class="modal fade" id="modal-map" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-label">เพิ่มข้อมูลการแจ้งเหตุ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="__map_sos_insert_save_php">
                    <div class="mb-1">
                        <label for="sos_type_id" class="form-label">ประเภทการแจ้งเหตุ</label>
                        <div class="container">


                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">กู้ภัย</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                                        aria-controls="profile-tab-pane"
                                        aria-selected="false">ผู้ประสบอุบัติเหตุ</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#contact-tab-pane" type="button" role="tab"
                                        aria-controls="contact-tab-pane"
                                        aria-selected="false">รายระเอียดยานพาหนะ</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab"
                                        data-bs-target="#disabled-tab-pane" type="button" role="tab"
                                        aria-controls="disabled-tab-pane"
                                        aria-selected="false">รายระเอียดจุดเกิดอุบัติเหตุ</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                    aria-labelledby="home-tab" tabindex="0">


                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput1"
                                            placeholder="name@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Example
                                            textarea</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <!-- รายระเอียดผู้ป่วย -->
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                    aria-labelledby="profile-tab" tabindex="0">
                                    <select class="mb-1">
                                        <option selected>เลือกชื่อขึ้นต้น</option><br>
                                        <option value="1">นาย</option>
                                        <option value="2">นางสาว</option>
                                        <option value="3">นาง</option>
                                        <option value="4">ด.ญ.</option>
                                        <option value="5">ด.ช.</option>
                                    </select>
                                    <div>
                                        <label for="fname">First name:</label>
                                        <input type="text" id="fname" name="fname" value="---">
                                        <label for="lname">Last name:</label>
                                        <input type="text" id="lname" name="lname" value="---">
                                    </div>
                                </div>

                                <!-- รายระเอียดรถของผู้ประสบเหตุ -->

                                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                    aria-labelledby="contact-tab" tabindex="0">
                                    รถของผู้ประสบอุบัติเหตุ
                                    <select class="mb-3 form-select form-select-sm"
                                        aria-label=".form-select-sm example">
                                        <option selected>เลือกประเภทรถ</option><br>
                                        <option value="1">เดินเท้า</option>
                                        <option value="2">จักรยาน</option>
                                        <option value="3">จักรยานยนต์</option>
                                        <option value="4">รถกระบะ(บิกอัพ)</option>
                                        <option value="5">รถเก๋ง</option>
                                        <option value="6">สามล้อเคลื่อน</option>
                                        <option value="7">รถซาเล้ง</option>
                                        <option value="8">รถแท็กซี่</option>
                                        <option value="9">รถตู้ทั่วไป</option>
                                        <option value="10">รถสองแถว</option>
                                        <option value="11">รถโดยสาร 6 ล้อ</option>
                                        <option value="12">รถบรรทุก 6 ล้อ</option>
                                        <option value="13">รถไถนา</option>
                                        <option value="14">รถดัดแปลง</option>
                                        <option value="15">สัตว์ตัดหน้า</option>
                                        <option value="16">ไม่มี</option>
                                    </select><br>
                                    รถของคุ่กรณี
                                    <select class="mb-3 form-select form-select-sm"
                                        aria-label=".form-select-sm example">
                                        <option selected>เลือกประเภทรถ</option><br>
                                        <option value="1">เดินเท้า</option>
                                        <option value="2">จักรยาน</option>
                                        <option value="3">จักรยานยนต์</option>
                                        <option value="4">รถกระบะ(บิกอัพ)</option>
                                        <option value="5">รถเก๋ง</option>
                                        <option value="6">สามล้อเคลื่อน</option>
                                        <option value="7">รถซาเล้ง</option>
                                        <option value="8">รถแท็กซี่</option>
                                        <option value="9">รถตู้ทั่วไป</option>
                                        <option value="10">รถสองแถว</option>
                                        <option value="11">รถโดยสาร 6 ล้อ</option>
                                        <option value="12">รถบรรทุก 6 ล้อ</option>
                                        <option value="13">รถไถนา</option>
                                        <option value="14">รถดัดแปลง</option>
                                        <option value="15">สัตว์ตัดหน้า</option>
                                        <option value="16">ไม่มี</option>
                                    </select><br>
                                    สาเหตุของอาการบาดเจ็บ
                                    <select class="mb-3 form-select form-select-sm"
                                        aria-label=".form-select-sm example">
                                        <option selected>เลือกสาเหตุ</option><br>
                                        <option value="1">ถูกชน</option>
                                        <option value="2">ชนกับสัตว์</option>
                                        <option value="3">ชนสะพาน</option>
                                        <option value="4">ชนกับเสาไฟฟ้า</option>
                                        <option value="5">ชนกับป้ายจราจร</option>
                                        <option value="6">ชนกับสิ่งอื่น</option>
                                        <option value="7">ตกจากพาหนะ</option>
                                        <option value="8">พาหนะคว่ำ</option>
                                        <option value="9">พาหนะล้ม</option>
                                        <option value="10">พาหนะจมน้ำ</option>
                                        <option value="11">อื่นๆ</option>
                                        <option value="12">ไม่ทราบ</option>
                                    </select><br>
                                    รถของคุ่กรณี
                                    <select class="mb-3 form-select form-select-sm"
                                        aria-label=".form-select-sm example">
                                        <option selected>เลือกการป้องกัน</option><br>
                                        <option value="1">สวมหมวกนิรภัย</option>
                                        <option value="2">ไม่สวมหมวกนิรภัย</option>
                                        <option value="3">คาดเข็มขัดนิรภัย</option>
                                        <option value="4">ไม่คาดเข็มขัดนิรภัย</option>
                                        <option value="5">ไม่ทราบ</option>
                                        <option value="6">ไม่ต้องใช้</option>
                                    </select><br>
                                </div>

                                <!-- รายระเอียดจุดเกิดอุบัติเหตุ -->

                                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel"
                                    aria-labelledby="disabled-tab" tabindex="0">
                                    ประเภทถนน
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>เลือกประเภทถนน</option><br>
                                        <option value="1">ทางหลวง</option>
                                        <option value="2">ทางหลวงชนบท</option>
                                        <option value="3">ทางเทศบาล</option>
                                        <option value="4">ถนน อบต./หมู่บ้าน</option>
                                        <option value="5">ไม่ทราบ</option>
                                    </select><br>
                                    ลักษณะเฉพาะของถนน
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>เลือกลักษณะเฉพาะของถนน</option><br>
                                        <option value="1">ทางโค้ง</option>
                                        <option value="2">ทางตรง</option>
                                        <option value="3">ทางแยก</option>
                                        <option value="4">สะพาน</option>
                                        <option value="5">ชำรุด</option>
                                        <option value="6">ระหว่างซ่อมแซม</option>
                                        <option value="7">ไม่ทราบ</option>
                                        <option value="8">ระบุไม่ได้</option>
                                        <option value="9">อื่นๆ</option>
                                        <option value="10">มีวัสดุพิเศษ</option>
                                    </select><br>
                                    ลักษะสำคัญของสภาพอากาศ
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>เลือกลักษณะของสภาพอากาศ</option><br>
                                        <option value="1">หมอกลง</option>
                                        <option value="2">หมอกลงจัด</option>
                                        <option value="3">ฝนตก</option>
                                        <option value="4">ฝนตกหนัก</option>
                                        <option value="5">หมอกควัน</option>
                                        <option value="6">น้ำท่วมขัง</option>
                                        <option value="7">ไม่ทราบ</option>
                                        <option value="8">ระบุไม่ได้</option>
                                        <option value="9">อื่นๆ</option>
                                    </select><br>
                                    <div class="mb-3">
                                        <label for="Textarea-ACC" class="form-label">รายระเอียดจุดเกิดอุบติเหตุ</label>
                                        <textarea class="form-control" id="Textarea-ACC" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-KM" class="form-label">กม. ที่(ถ้ามี)</label>
                                        <textarea class="form-control" id="Textarea-KM" rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-G" class="form-label">หมู่</label>
                                        <textarea class="form-control" id="Textarea-G" rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-G" class="form-label">ตำบล</label>
                                        <textarea class="form-control" id="Textarea-G" rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-canton" class="form-label">อำเภอ</label>
                                        <textarea class="form-control" id="Textarea-canton" rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-KM" class="form-label">จังหวัด</label>
                                        <textarea class="form-control" id="Textarea-ACC" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Primary</button>
                <button type="button" class="btn btn-secondary">Secondary</button>
            </div>
        </div>
    </div>
</div>

<script>
var map;
$(function() {
    $("#googleMap").height($(window).height() - ($("#mainTopbar").height() + $(
        "#googleTitle").height() + 16));
    var mapProp = {
        center: new google.maps.LatLng(17.4151942494563, 103.78811052232832),
        zoom: 9,
        mapTypeId: google.maps.MapTypeId.HYBRID,
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    google.maps.event.addListener(map, 'click', function(e) {
        var latlng = e.latLng.toJSON();
        addNewMarker(latlng);
        $("#modal-map").modal('show');
    });
});

function addNewMarker(latlng) {
    var mapMark = {
        position: new google.maps.LatLng(latlng.lat, latlng.lng),
        map: map,
    }
    var marker = new google.maps.Marker(mapMark);
    var infowindow = new google.maps.InfoWindow({
        content: "Hello World!"
    });
    google.maps.event.addListener(marker, 'click', function(e) {
        infowindow.open(map, marker);
    });
}
</script>