<?php
include "../include/connection.php";
include "../include/function.php";

$kpi=getKpi($_POST['kpi_year_id']);
?>
<script>
    var kpi = <?php echo json_encode($kpi); ?>;
</script>
<?php

$sql = "select q1.ampur_fullcode,q2.ampur_name,format(q2.sum_percent/q1.count_office,2) as avg_percent,format(q2.sum_percent_moph/q1.count_office_moph,2) as avg_percent_moph,format(q2.sum_percent_pao/q1.count_office_pao,2) as avg_percent_pao from
(select o.ampur_fullcode,count(*) as count_office,sum(if(o.belong_to='moph',1,0)) as count_office_moph,sum(if(o.belong_to='pao',1,0)) as count_office_pao from office as o where o.office_type_code in ('03','06','07','08','12','13') group by o.ampur_fullcode) as q1 left join
(select s.ampur_fullcode,s.ampur_name,sum(s.percent) as sum_percent,sum(if(o.belong_to='moph',s.percent,0)) as sum_percent_moph,sum(if(o.belong_to='pao',s.percent,0)) as sum_percent_pao from sum_hospital s left join office o on s.office_code=o.office_code ".(($_POST['kpi_year_id']>0)?" where s.kpi_year_id=".$_POST['kpi_year_id']:"")."  group by s.ampur_fullcode) as q2 on q1.ampur_fullcode=q2.ampur_fullcode";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <canvas id="myChart01-7"></canvas>
</div>

<script>
var rows = <?php echo json_encode($rows); ?>;

new Chart($("#myChart01-7"), {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: rows.map(row => row.ampur_name),
        datasets: [{
            label: 'สสจ.',
            data: rows.map(row => row.avg_percent_moph),
            borderWidth: 1
        }, {
            label: 'อบจ.',
            data: rows.map(row => row.avg_percent_pao),
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
                font: {
                    weight: 'normal',
                    size: 10
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

        }
    }
});
</script>