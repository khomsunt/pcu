<?php
include "../include/connection.php";
include "../include/function.php";

$now_thai_year=date("Y")+543;
$now_month=date("m");

$sql = "SELECT
	o.belong_to,
	s.sum_grade_weight/o.count_belong_to as avg_grade_weight
FROM
	(
	SELECT
		o.belong_to,
        count(*) as count_belong_to 
	FROM
		office o 
	WHERE
		o.ampur_fullcode = '".$_POST['ampur_fullcode']."' 
	AND o.office_type_code IN ( '03', '06', '07', '08', '12', '13' )
    GROUP BY o.belong_to
    ) AS o
	LEFT JOIN (
	SELECT
		o.belong_to,
		sum( s.grade_weight ) AS sum_grade_weight 
	FROM
		sum_hospital s left join office o on s.office_code=o.office_code
	WHERE
		s.ampur_fullcode = '".$_POST['ampur_fullcode']."' 
        AND s.year='".$now_thai_year."'
        AND s.month='".$now_month."'
	GROUP BY
	o.belong_to 
	) AS s ON o.belong_to = s.belong_to";

$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart02-3"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;

new Chart($("#myChart02-3"), {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.belong_to),
        datasets: [{
            label: 'คะแนนรวม',
            data: rows.map(row => row.avg_grade_weight),
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