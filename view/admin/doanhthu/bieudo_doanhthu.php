<div class="nen">
<?php
    foreach($bieude_doanhthu as $value){
        $ngay[] = $value['ngay'];
        $tongdoanhthutheongay[] = $value['tongdoanhthu'];
    }

?>

<div style="width: 1200px;">
<h1>Thống kê doanh thu</h1>
    <canvas id="myChart">
        
    </canvas>
</div>
<script>
    const labels = <?php echo json_encode($ngay) ?>

    const data = {
        labels: labels,
        datasets: [{
            label: 'VNĐ',
            data: <?php echo json_encode($tongdoanhthutheongay) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>   
</div>