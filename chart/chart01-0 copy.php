<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select * from summary where status_id=:status_id order by summary_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['status_id' => 1]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart01-0"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;
console.log(rows);
var chart_div = $("#myChart01-0");
new Chart(chart_div, {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.ampur_name),
        datasets: [{
            label: '# of Votes',
            data: rows.map(row => row.summary),
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
        },
        onClick: function (e, items) {
            console.log(rows[items[0].index]);
            // var activePointLabel = this.getElementsAtEvent(e)[0]._model.label;
            // alert(activePointLabel);
        }

    }
});
</script>