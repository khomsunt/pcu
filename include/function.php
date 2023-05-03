<?php
function preventDirectCall()
{
    if (($_SERVER['HTTP_REFERER'] == $_SERVER['HTTP_ORIGIN'] . '/pcu/main/') or ($_SERVER['HTTP_REFERER'] == $_SERVER['HTTP_ORIGIN'] . '/pcu/main/index.php')) {
    } else {
        echo "คุณคือผู้บุกรุก";
        die();
    }
}

function getKpi($kpi_year_id){
    global $con;
    $sql = "select ky.*,k.kpi_name from kpi_year ky left join kpi k on ky.kpi_id=k.kpi_id where ky.kpi_year_id=:kpi_year_id";
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute(['kpi_year_id' => $kpi_year_id]);
    $kpi = $stmt->fetch(PDO::FETCH_ASSOC);
    return $kpi;
}

preventDirectCall();
