<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select * from summary where status_id=:status_id order by summary_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['status_id' => 1]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart01-1"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;

new Chart($("#myChart01-1"), {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.ampur_name),
        datasets: [{
            label: '# of Votes',
            data: rows.map(row => row.moph),
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'top',
                formatter: Math.round,
                font: {
                    weight: 'normal',
                    size: 12
                }
            }
        }
    }
});
</script>