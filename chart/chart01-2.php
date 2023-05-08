<?php
include "../include/connection.php";
include "../include/function.php";

$now_thai_year=date("Y")+543;
$now_month=date("m");

$sql = "select q1.ampur_fullcode,q2.ampur_name,format(q2.sum_grade_weight/q1.count_office,2) as avg_grade_weight,format(q2.sum_grade_weight_moph/q1.count_office_moph,2) as avg_grade_weight_moph,format(q2.sum_grade_weight_pao/q1.count_office_pao,2) as avg_grade_weight_pao from
(select o.ampur_fullcode,count(*) as count_office,sum(if(o.belong_to='moph',1,0)) as count_office_moph,sum(if(o.belong_to='pao',1,0)) as count_office_pao from office as o where o.office_type_code in ('03','06','07','08','12','13') group by o.ampur_fullcode) as q1 left join
(select s.ampur_fullcode,s.ampur_name,sum(s.grade_weight) as sum_grade_weight,sum(if(o.belong_to='moph',s.grade_weight,0)) as sum_grade_weight_moph,sum(if(o.belong_to='pao',s.grade_weight,0)) as sum_grade_weight_pao from sum_hospital s left join office o on s.office_code=o.office_code ".(($_POST['kpi_year_id']>0)?" where s.kpi_year_id=".$_POST['kpi_year_id']." and ":"where ")."year='".$now_thai_year."' and month='".$now_month."' group by s.ampur_fullcode) as q2 on q1.ampur_fullcode=q2.ampur_fullcode";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart01-2"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;

new Chart($("#myChart01-2"), {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.ampur_name),
        datasets: [{
            label: 'คะแนนรวม',
            data: rows.map(row => row.avg_grade_weight_pao),
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