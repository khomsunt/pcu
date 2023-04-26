<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select * from chart01 where status_id=:status_id order by chart_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['status_id' => 1]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart01"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;

new Chart($("#myChart01"), {
    type: 'bar',
    data: {
        labels: rows.map(row => row.chart_name),
        datasets: [{
            label: '# of Votes',
            data: rows.map(row => row.chart_value),
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>