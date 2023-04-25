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
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" value="Readonly input here..."
                                    aria-label="readonly input example" readonly>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" multiple aria-label="multiple select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckIndeterminate1">
                                        <label class="form-check-label" for="flexCheckIndeterminate">Indeterminate
                                            checkbox</label><br>
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckIndeterminate2">
                                        <label class="form-check-label" for="flexCheckIndeterminate">Indeterminate
                                            checkbox</label><br>
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckIndeterminate3">
                                        <label class="form-check-label" for="flexCheckIndeterminate">Indeterminate
                                            checkbox</label><br>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Default radio
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">Default checked
                                            radio</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
                                    <label class="btn btn-outline-primary"
                                        for="btn-check-outlined">Singletoggle</label><br>
                                    <input type="checkbox" class="btn-check" id="btn-check-2-outlined" checked
                                        autocomplete="off">
                                    <label class="btn btn-outline-secondary"
                                        for="btn-check-2-outlined">Checked</label><br>
                                    <input type="radio" class="btn-check" name="options-outlined" id="success-outlined"
                                        autocomplete="off" checked>
                                    <label class="btn btn-outline-success" for="success-outlined">Checked success
                                        radio</label>
                                    <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="danger-outlined">Danger radio</label>
                                </div>
                                <div class="mb-3">
                                    <label for="customRange3" class="form-label">Example range</label>
                                    <input type="range" class="form-range" min="0" max="5" step="0.25"
                                        id="customRange3">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <span class="input-group-text">0.00</span>
                                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>

                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                    <span class="input-group-text">$</span>
                                    <span class="input-group-text">0.00</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
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