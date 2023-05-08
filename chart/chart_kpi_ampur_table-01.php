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
	`year`,
IF
	( `month` = '10', percent, '' ) AS month_10,
IF
	( `month` = '11', percent, '' ) AS month_11,
IF
	( `month` = '12', percent, '' ) AS month_12,
IF
	( `month` = '01', percent, '' ) AS month_01,
IF
	( `month` = '02', percent, '' ) AS month_02,
IF
	( `month` = '03', percent, '' ) AS month_03,
IF
	( `month` = '04', percent, '' ) AS month_04,
IF
	( `month` = '05', percent, '' ) AS month_05,
IF
	( `month` = '06', percent, '' ) AS month_06,
IF
	( `month` = '07', percent, '' ) AS month_07,
IF
	( `month` = '08', percent, '' ) AS month_08,
IF
	( `month` = '09', percent, '' ) AS month_09 
FROM
	sum_hospital 
WHERE
	office_code = '".$_POST['office_code']."' 
	AND kpi_year_id = ".$_POST['kpi_year_id']." 
GROUP BY
	`year`";

$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($_POST);
echo $sql;
?>
<div>
    <canvas id="canvas_chart_kpi_ampur_table-01"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;
console.log(rows);
var chart_div = $("#canvas_chart_kpi_ampur_table-01");
new Chart(chart_div, {
    plugins: [ChartDataLabels],
    type: 'line',
    data: {
        labels: ['month_10','month_11','month_12','month_01','month_02','month_03','month_04','month_05','month_06','month_07','month_08','month_09'],
        datasets: [            
            <?php
            foreach ($rows as $key => $value) {
                ?>
                {
                    label: <?php echo $value['year']; ?>,
                    data: [
                        <?php echo $value['month_10']; ?>,
                        <?php echo $value['month_11']; ?>,
                        <?php echo $value['month_12']; ?>,
                        <?php echo $value['month_01']; ?>,
                        <?php echo $value['month_02']; ?>,
                        <?php echo $value['month_03']; ?>,
                        <?php echo $value['month_04']; ?>,
                        <?php echo $value['month_05']; ?>,
                        <?php echo $value['month_06']; ?>,
                        <?php echo $value['month_07']; ?>,
                        <?php echo $value['month_08']; ?>,
                        <?php echo $value['month_09']; ?>
                    ],
                    yAxisID: 'year_<?php echo $value['year']; ?>',
                },    
                <?php
            }
            ?>
        ]
    },
    options: {
        scales: {
            year_2566: {
                type: 'linear',
                display: true,
                position: 'left',
            },            
        },
        plugins: {
            title: {
                display: true,
                text: 'Chart.js Line Chart - Multi Axis'
            }
        },
    }
});
</script>