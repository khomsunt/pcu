<?php
include "../include/connection.php";
include "../include/function.php";

$kpi=getKpi($_POST['kpi_year_id']);
?>
<script>
    var kpi = <?php echo json_encode($kpi); ?>;
</script>
<?php


$sql = "SELECT
	o.office_code,
	o.office_name_short,
	s.percent 
FROM
	(
	SELECT
		* 
	FROM
		office o 
	WHERE
        o.belong_to='moph' AND 
		o.ampur_fullcode = '".$_POST['ampur_fullcode']."' 
	AND o.office_type_code IN ( '03', '06', '07', '08', '12', '13' )) AS o
	LEFT JOIN (
	SELECT
		s.office_code,
		s.office_name,
		s.percent 
	FROM
		sum_hospital s 
	WHERE
        s.kpi_year_id='".$_POST['kpi_year_id']."' AND
		s.ampur_fullcode = '".$_POST['ampur_fullcode']."' 
	) AS s ON o.office_code = s.office_code";

$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($_POST);
?>
<div>
    <canvas id="myChart03-5"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;
// console.log(rows);
var chart_div = $("#myChart03-5");
new Chart(chart_div, {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.office_name_short),
        datasets: [{
            label: 'คะแนนรวม',
            data: rows.map(row => row.percent),
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
            },
            annotation: {
                annotations: {
                    line1: {
                        type: 'line',
                        yMin: kpi.target,
                        yMax: kpi.target,
                        borderColor: 'rgb(255, 99, 132)',
                        borderWidth: 2,
                        label: {
                            display: true,
                            content: kpi.target+" "+kpi.target_unit,
                            position: 'center',
                            backgroundColor: 'rgba(0,0,0,0.4)',
                            font: {
                                weight: 'normal',
                                size: 12
                            }

                        }
                    }
                }
            },
        },
    }
});
</script>