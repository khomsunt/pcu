<?php
include "../include/connection.php";
include "../include/function.php";
?>

<div class="list-group pt-3 p-1 list-group-flush" style="width:240px;">
    <a href="#" class="list-group-item list-group-item-action navbar-btn" show_type="page" layout=""
        page="../dashboard/dashboard01.php" target_div="display">Dashboard</a>
    <?php
    $sql = "select ky.kpi_year_id,ky.kpi_no,k.kpi_name from kpi_year ky left join kpi k on ky.kpi_id=k.kpi_id where ky.`year`='2566' and ky.status_id=:status_id order by ky.kpi_no*1";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute(['status_id' => 1]);
    while ($kpi = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <a href="#" class="list-group-item list-group-item-action navbar-btn" show_type="page" layout="" page="../dashboard/dashboard_kpi.php" target_div="display" kpi_year_id="<?php echo $kpi['kpi_year_id']; ?>">
            <?php echo $kpi['kpi_no'].". ".$kpi['kpi_name']; ?>
        </a>
        <?php
    } ?>
</div>
