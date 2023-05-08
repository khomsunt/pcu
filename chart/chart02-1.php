<?php
include "../include/connection.php";
include "../include/function.php";

$now_thai_year=date("Y")+543;
$now_month=date("m");

$sql = "SELECT
	o.office_code,
	o.office_name_short,
	s.sum_grade_weight 
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
		sum( s.grade_weight ) AS sum_grade_weight 
	FROM
		sum_hospital s 
	WHERE
		s.ampur_fullcode = '".$_POST['ampur_fullcode']."' 
        AND s.year='".$now_thai_year."'
        AND s.month='".$now_month."'
	GROUP BY
	s.office_code 
	) AS s ON o.office_code = s.office_code";

$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart02-1"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;

new Chart($("#myChart02-1"), {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.office_name_short),
        datasets: [{
            label: 'คะแนนรวม',
            data: rows.map(row => row.sum_grade_weight),
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