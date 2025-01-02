<?php
include('database.php'); // Ensure database connection file is included

// Fetch total counts from the database
$total_schools = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM school"));
$total_staff = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM staff"));
$total_students = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student"));

// Calculate totals and percentages
$total = $total_schools + $total_staff + $total_students;

// Avoid division by zero
if ($total > 0) {
    $percent_schools = ($total_schools / $total) * 100;
    $percent_staff = ($total_staff / $total) * 100;
    $percent_students = ($total_students / $total) * 100;
} else {
    $percent_schools = $percent_staff = $percent_students = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style5.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center" style="color:blue">Data Dashboard</h1>
        <div class="row">
            <?php
            // Data for the cards
            $cards = [
                "Total Schools" => ["count" => $total_schools, "percent" => $percent_schools],
                "Total Staff" => ["count" => $total_staff, "percent" => $percent_staff],
                "Total Students" => ["count" => $total_students, "percent" => $percent_students],
            ];

            // Generate cards dynamically
            foreach ($cards as $title => $data) {
                $count = $data['count'];
                $percent = number_format($data['percent'], 2); // Format percentage to 2 decimal places
                echo "
                <div class='col-md-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <h4 class='mb-3'>$count</h4>
                            <p class='text-muted'>($percent%)</p>
                        </div>
                        <div class='card-footer d-flex align-items-center justify-content-between'>
                            <a class='small text-black stretched-link' href='displayData.php'>View Details</a>
                            <div class='small text-black'><i class='fas fa-angle-right'></i></div>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
            <button style="
            background: blue;
            width: 300px;
            height: 50px;
            display: flex;
            justify-content:center;
            text-align:center;
            border-radius: 10px;
            align-items:center;
            border: none;
            cursor: pointer;
            box-shadow: rgba(0, 0, 0, 0.6) 0px 5px 15px;
            ">
            <a href="index.php" style="font-weight: bold;color: white;padding: 10px 10px 10px 10px;">Add data</a>
            </button>
    </div>
    <!-- Chart Container -->
    <div class="chart-container d-flex justify-content-center flex-wrap" style="width: 80%; margin: 50px auto;">
        <!-- Horizontal Bar Chart -->
        <div class="chart" style="width: 50%; margin-bottom: 50px;">
            <canvas id="horizontalBarChart"></canvas>
        </div>

        <!-- Vertical Bar Chart -->
        <div class="chart" style="width: 50%; margin-bottom: 50px;">
            <canvas id="barChart"></canvas>
        </div>

        <!-- Pie Chart -->
        <div class="chart" style="width: 50%;">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        var total = <?php echo $total; ?>;
        if (total === 0) total = 1; // Prevent division by zero

        // Horizontal Bar Chart
        var ctxHorizontal = document.getElementById('horizontalBarChart').getContext('2d');
        var horizontalBarChart = new Chart(ctxHorizontal, {
            type: 'horizontalBar', 
            data: {
                labels: ['Schools', 'Staff', 'Students'],
                datasets: [{
                    label: 'Total Count',
                    data: [<?php echo $total_schools; ?>, <?php echo $total_staff; ?>, <?php echo $total_students; ?>],
                    backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            var percentage = (value / total) * 100;
                            return `${value} (${percentage.toFixed(2)}%)`;
                        }
                    }
                },
                scales: {
                    xAxes: [{ ticks: { beginAtZero: true } }]
                }
            }
        });

        // Vertical Bar Chart
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar', 
            data: {
                labels: ['Schools', 'Staff', 'Students'],
                datasets: [{
                    label: 'Total Count',
                    data: [<?php echo $total_schools; ?>, <?php echo $total_staff; ?>, <?php echo $total_students; ?>],
                    backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            var percentage = (value / total) * 100;
                            return `${value} (${percentage.toFixed(2)}%)`;
                        }
                    }
                },
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }]
                }
            }
        });

        // Pie Chart
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie', 
            data: {
                labels: ['Schools', 'Staff', 'Students'],
                datasets: [{
                    label: 'Total Count',
                    data: [<?php echo $total_schools; ?>, <?php echo $total_staff; ?>, <?php echo $total_students; ?>],
                    backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var value = tooltipItem.raw;
                                var percentage = (value / total) * 100;
                                return `${tooltipItem.label}: ${value} (${percentage.toFixed(2)}%)`;
                            }
                        }
                    },
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>

    <script src="https://kit.fontawesome.com/2aebc1b0e1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="d-flex justify-content-center flex-wrap p-5">
    <h1 class="text-center" style="font-size:25px">School</h1>
    <?php include"displayschool.php" ?>
    <h1 class="text-center" style="font-size:25px">Staff</h1>
    <?php include"displayteacher.php" ?>
    <h1 class="text-center" style="font-size:25px">Student</h1>
    <?php include"displaystudent.php" ?>
    </div>
    
</body>
</html>

