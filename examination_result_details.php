<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$examinee_id = $_GET["examinee_id"] ? $_GET["examinee_id"] : $_SESSION['id'];
$result_id = $_GET["result_id"];

$exam_result_sql = "SELECT * FROM exam_result_details WHERE $result_id";
$exam_result = mysqli_query($link, $exam_result_sql);
$result_details = $exam_result->fetch_array(MYSQLI_ASSOC);

$examination_result_sql = "SELECT * FROM examination_result WHERE examinee_id = $examinee_id && id = $result_id";
$examination_result = mysqli_query($link, $examination_result_sql);
$exam_result = $examination_result->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .progress {
        width: 150px !important;
        height: 150px !important;
        background-color: transparent !important;
        background: none;
        position: relative;
    }

    .progress::after {
        content: "";
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 6px solid #eee;
        position: absolute;
        top: 0;
        left: 0;
    }

    .progress>span {
        width: 50%;
        height: 100%;
        overflow: hidden;
        position: absolute;
        top: 0;
        z-index: 1;
    }

    .progress .progress-left {
        left: 0;
    }

    .progress .progress-bar {
        width: 100%;
        height: 100%;
        background: none;
        border-width: 6px;
        border-style: solid;
        position: absolute;
        top: 0;
    }

    .progress .progress-left .progress-bar {
        left: 100%;
        border-top-right-radius: 80px;
        border-bottom-right-radius: 80px;
        border-left: 0;
        -webkit-transform-origin: center left;
        transform-origin: center left;
    }

    .progress .progress-right {
        right: 0;
    }

    .progress .progress-right .progress-bar {
        left: -100%;
        border-top-left-radius: 80px;
        border-bottom-left-radius: 80px;
        border-right: 0;
        -webkit-transform-origin: center right;
        transform-origin: center right;
    }

    .progress .progress-value {
        position: absolute;
        top: 0;
        left: 0;
    }
</style>

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
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-6 mb-4">
                                        <div class="bg-white rounded-lg p-5 shadow">
                                            <h2 class="h6 font-weight-bold text-center mb-4">Overall progress</h2>

                                            <div class="progress mx-auto" data-value='<?php echo $exam_result["grade"]; ?>'>
                                                <span class="progress-left">
                                                    <span class="progress-bar border-primary"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar border-primary"></span>
                                                </span>
                                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                    <div class="h2 font-weight-bold"><?php echo $exam_result["grade"]; ?><sup class="small">%</sup></div>
                                                </div>
                                            </div>

                                            <div class="row text-center mt-4">
                                                <div class="col-6 border-right">
                                                    <div class="h4 font-weight-bold mb-0"><?php echo $exam_result["result"]; ?></div><span class="small text-gray">Grade</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="h4 font-weight-bold mb-0"><?php echo $exam_result["date_completed"]; ?></div><span class="small text-gray">Date Completed</span>
                                                </div>
                                            </div>
                                        </div>
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
        $(function() {

            $(".progress").each(function() {

                var value = $(this).attr('data-value');
                var left = $(this).find('.progress-left .progress-bar');
                var right = $(this).find('.progress-right .progress-bar');

                if (value > 0) {
                    if (value <= 50) {
                        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                    } else {
                        right.css('transform', 'rotate(180deg)')
                        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                    }
                }

            })

            function percentageToDegrees(percentage) {
                return percentage / 100 * 360
            }

        });
    </script>

</body>

</html>