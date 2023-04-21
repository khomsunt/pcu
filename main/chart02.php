<div>
    <canvas id="myChart02"></canvas>
</div>

<script>
const data = {
    labels: ['2563', '2564', '2565', '2566'],
    datasets: [{
        label: 'Dataset 1',
        data: [45, 50, 34, 25],
        borderColor: '#36A2EB',
        backgroundColor: '#9BD0F5',
    }]
};
new Chart($("#myChart02"), {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Chart.js Line Chart'
            }
        }
    },
});
</script>