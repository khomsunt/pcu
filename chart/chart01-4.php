<?php
include "../include/connection.php";
include "../include/function.php";

$kpi=getKpi($_POST['kpi_year_id']);
?>
<script>
    var kpi = <?php echo json_encode($kpi); ?>;
</script>
<?php

$now_thai_year=date("Y")+543;
$now_month=date("m");

$sql="SELECT
	q1.ampur_fullcode,
	q2.ampur_name,
	format( q2.sum_percent / q1.count_office, 2 ) AS avg_percent,
	if(q2.sum_percent / q1.count_office ".$kpi['operator_target']." ".$kpi['target'].",'rgba(93, 156, 89, 0.4)','rgba(223, 46, 56, 0.4)') as avg_percent_color,
	if(q2.sum_percent / q1.count_office ".$kpi['operator_target']." ".$kpi['target'].",'rgba(93, 156, 89, 1)','rgba(223, 46, 56, 1)') as avg_percent_border_color,
	format( q2.sum_percent_moph / q1.count_office_moph, 2 ) AS avg_percent_moph,
	if(q2.sum_percent_moph / q1.count_office_moph ".$kpi['operator_target']." ".$kpi['target'].",'rgba(93, 156, 89, 0.4)','rgba(223, 46, 56, 0.4)') as avg_percent_moph_color,
	if(q2.sum_percent_moph / q1.count_office_moph ".$kpi['operator_target']." ".$kpi['target'].",'rgba(93, 156, 89, 1)','rgba(223, 46, 56, 1)') as avg_percent_moph_border_color,
	format( q2.sum_percent_pao / q1.count_office_pao, 2 ) AS avg_percent_pao,
	if(q2.sum_percent_pao / q1.count_office_pao ".$kpi['operator_target']." ".$kpi['target'].",'rgba(93, 156, 89, 0.4)','rgba(223, 46, 56, 0.4)') as avg_percent_pao_color,
	if(q2.sum_percent_pao / q1.count_office_pao ".$kpi['operator_target']." ".$kpi['target'].",'rgba(93, 156, 89, 1)','rgba(223, 46, 56, 1)') as avg_percent_pao_border_color
FROM
	(
	SELECT
		o.ampur_fullcode,
		count(*) AS count_office,
		sum(
		IF
		( o.belong_to = 'moph', 1, 0 )) AS count_office_moph,
		sum(
		IF
		( o.belong_to = 'pao', 1, 0 )) AS count_office_pao 
	FROM
		office AS o 
	WHERE
		o.office_type_code IN ( '03', '06', '07', '08', '12', '13' ) 
	GROUP BY
		o.ampur_fullcode 
	) AS q1
	LEFT JOIN (
	SELECT
		s.ampur_fullcode,
		s.ampur_name,
		sum( s.percent ) AS sum_percent,
		sum(
		IF
		( o.belong_to = 'moph', s.percent, 0 )) AS sum_percent_moph,
		sum(
		IF
		( o.belong_to = 'pao', s.percent, 0 )) AS sum_percent_pao 
	FROM
		sum_hospital s
		LEFT JOIN office o ON s.office_code = o.office_code 
	WHERE s.kpi_year_id=".$_POST['kpi_year_id']." AND s.year='".$now_thai_year."' AND s.month='".$now_month."'
	GROUP BY
	s.ampur_fullcode 
	) AS q2 ON q1.ampur_fullcode = q2.ampur_fullcode";

$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart01-4"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;
// console.log(rows);
var chart_div = $("#myChart01-4");
new Chart(chart_div, {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.ampur_name),
        datasets: [{
            label: 'ร้อยละ',
            data: rows.map(row => row.avg_percent),
            borderWidth: 1,
            backgroundColor: rows.map(row => row.avg_percent_color),
            borderColor: rows.map(row=>row.avg_percent_border_color),
        }],
        
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },

        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'top',
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
        onClick: function (e, items) {
            console.log(rows[items[0].index]);
            var this_params={};
            console.log(this_params);
            this_params.ampur_fullcode=rows[items[0].index].ampur_fullcode;
            this_params.kpi_year_id=<?php echo $_POST['kpi_year_id']; ?>;
            console.log(this_params);
            setCurrentPage("", "../dashboard/dashboard_kpi_ampur.php", "display",{params:this_params});

            loadPage("", "../dashboard/dashboard_kpi_ampur.php", "display",this_params);

            // var activePointLabel = this.getElementsAtEvent(e)[0]._model.label;
            // alert(activePointLabel);
        }
    }
});

function average(ctx) {
  const values = ctx.chart.data.datasets[0].data;
  return values.reduce((a, b) => a + b, 0) / values.length;
}
</script>