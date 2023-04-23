<?php
include "../include/connection.php";
$sql = "select * from chart02 where status_id=:status_id order by chart_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['status_id' => 1]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart02"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;
var data = {
    labels: rows.map(row => row.chart_name),
    datasets: [{
        label: 'Dataset 1',
        data: rows.map(row => row.chart_value),
        borderColor: '#36A2EB',
        backgroundColor: '#9BD0F5',
    }]
};
new Chart($("#myChart02"), {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Chart.js Line Chart'
            }
        }
    },
});
</script>