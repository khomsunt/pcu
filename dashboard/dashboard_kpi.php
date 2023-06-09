<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select ky.*,k.kpi_name from kpi_year ky left join kpi k on ky.kpi_id=k.kpi_id where ky.kpi_year_id=:kpi_year_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['kpi_year_id' => $_POST['kpi_year_id']]);
$kpi = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="row p-4">
    <div class="col-12 p-2">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-primary">
                            <?php 
                            echo $kpi['kpi_no'].". ".$kpi['kpi_name'];
                            ?>
                        </h4>
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
            <div class="card-body" id="chart01-4">
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-12 p-2">
        <div class="card shadow">
            <div class="card-header">
                สสจ.
            </div>
            <div class="card-body" id="chart01-5">
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-12 p-2">
        <div class="card shadow">
            <div class="card-header">
                อบจ.
            </div>
            <div class="card-body" id="chart01-6">
            </div>
        </div>
    </div>
    <div class="col-12 p-2">
        <div class="card shadow">
            <div class="card-header">
                สสจ./อบจ.
            </div>
            <div class="card-body" id="chart01-7">
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
    loadPage("", "../chart/chart01-4.php", "chart01-4",<?php echo json_encode($_POST); ?>);
    loadPage("", "../chart/chart01-5.php", "chart01-5",<?php echo json_encode($_POST); ?>);
    loadPage("", "../chart/chart01-6.php", "chart01-6",<?php echo json_encode($_POST); ?>);
    loadPage("", "../chart/chart01-7.php", "chart01-7",<?php echo json_encode($_POST); ?>);
})
</script>