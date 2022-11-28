<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$result_id = $_GET["result_id"];

$exam_result_sql = "SELECT * FROM exam_result_details WHERE $result_id";
$exam_result = mysqli_query($link, $exam_result_sql);
$result_details = $exam_result->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body id="page-top">
    <?php include 'includes/preloader.php' ?>

    <div id="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'includes/navbar.php'; ?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Examination Result</h1>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Label</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Correct Answer</td>
                                                    <td><span><?php echo $result_details['correct_answer'] ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Question</td>
                                                    <td><span><?php echo $result_details['total_questions'] ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Correct Answer Points</td>
                                                    <td><span><?php echo $result_details['correct_answer_points'] ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Points</td>
                                                    <td><span><?php echo $result_details['total_points'] ?></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Donut Chart -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Exam Result Visualization</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="exam-result"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php include 'includes/footer.php'; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>

    <script>
        // Pie Chart Example
        var ctx = document.getElementById("exam-result");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Direct", "Referral", "Social"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#172a52', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>

</body>

</html>