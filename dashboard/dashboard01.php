<div class="container-fluid col-12 p-4 bg-primary text-white shadow">
    <div class="row">
        <div class="col-lg-8 col-12 pt-4">
            <h1><i class="bi bi-ubuntu"></i> PCU Dashboard</h1>
            <p class="text-info">dashboard overview and content summary</p>
            <br><br><br><br>
        </div>
        <div class="col-lg-4 col-12 pt-4">
            <input id="startDate" class="form-control" type="date" />

        </div>
    </div>
</div>

<div class="row p-4" style="margin-top:-150px;">
    <div class="col-12 p-2">
        <div class="card shadow">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-lg col-12">
                        <h1 class="text-primary">ดัชนีวัดความสำเร็จตามเป้าหมายของหน่วยบริการปฐมภูมิ</h1>
                        ในจังหวัดสกลนคร ประจำปีงบประมาณ 2566
                    </div>
                    <div class="col-lg-auto col-12">
                        <img src="../image/at-work.svg" width="200px" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 p-2">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                ภาพรวมจังหวัด
                <span>
                    <i class="bi bi-table"></i>
                </span>
            </div>
            <div class="card-body" id="chart01-0">
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-12 p-2">
        <div class="card shadow">
            <div class="card-header">
                สสจ.
            </div>
            <div class="card-body" id="chart01-1">
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-12 p-2">
        <div class="card shadow">
            <div class="card-header">
                อบจ.
            </div>
            <div class="card-body" id="chart01-2">
            </div>
        </div>
    </div>
    <div class="col-12 p-2">
        <div class="card shadow">
            <div class="card-header">
                สสจ./อบจ.
            </div>
            <div class="card-body" id="chart01-3">
            </div>
        </div>
    </div>



    <div class="row text-info pt-5">
        <div class="col-sm-8 col-12">
            Copyright © Your Website 2021
        </div>
        <div class="col-sm-4 col-12 text-end">
            Privacy Policy · Terms & Conditions
        </div>
    </div>

</div>

<script>
$(function() {
    loadPage("", "../chart/chart01-0.php", "chart01-0");
    loadPage("", "../chart/chart01-1.php", "chart01-1");
    loadPage("", "../chart/chart01-2.php", "chart01-2");
    loadPage("", "../chart/chart01-3.php", "chart01-3");
})
</script>