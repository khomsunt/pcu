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
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                    aria-labelledby="profile-tab" tabindex="0">

                                    <input class="form-control form-control-lg" type="text"
                                        placeholder=".form-control-lg" aria-label=".form-control-lg example">
                                    <input class="form-control" type="text" placeholder="Default input"
                                        aria-label="default input example">
                                    <input class="form-control form-control-sm" type="text"
                                        placeholder=".form-control-sm" aria-label=".form-control-sm example">

                                </div>
                                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                    aria-labelledby="contact-tab" tabindex="0">...</div>
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
                                        <textarea class="form-control" id="Textarea-ACC"rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-KM" class="form-label">กม. ที่(ถ้ามี)</label>
                                        <textarea class="form-control" id="Textarea-KM"rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-G" class="form-label">หมู่</label>
                                        <textarea class="form-control" id="Textarea-G"rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-district" class="form-label">ตำบล</label>
                                        <textarea class="form-control" id="Textarea-district"rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-canton" class="form-label">อำเภอ</label>
                                        <textarea class="form-control" id="Textarea-canton"rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Textarea-province" class="form-label">จังหวัด</label>
                                        <textarea class="form-control" id="Textarea-province"rows="1"></textarea>
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