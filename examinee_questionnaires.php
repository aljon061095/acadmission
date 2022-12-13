<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$user_id = $_SESSION["id"];

$questionnaires_sql = "SELECT * FROM questionnaires";
$questionnaires_result = mysqli_query($link, $questionnaires_sql);
$questionnaires = $questionnaires_result->fetch_all(MYSQLI_ASSOC);

//add checking for first and second choice
// $date_now = date("Y-m-d H:i:s");
// function filterByActivationDate($questionnaires, $dateNow)
// {
//     return array_filter($questionnaires, function ($item) use ($dateNow) {
//         if ($item['end_time'] >= $dateNow) {
//             return true;
//         }
//     });
// }

// $items = filterByActivationDate($items, $date_now);
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body id="page-top">

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'includes/navbar.php'; ?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Examinee Questionnaries</h1>

                    <div class="mt-1">
                        <?php
                        if (isset($_SESSION['success_status'])) {
                        ?>
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php echo $_SESSION['success_status']; ?>
                            </div>
                        <?php
                            unset($_SESSION['success_status']);
                        }
                        ?>
                    </div>

                    <div class="row">
                        <?php
                        if (array_filter($questionnaires) !== []) { 
                            foreach($questionnaires as $questionnaire) {
                                $settings =json_decode($questionnaire['settings']);
                            ?>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary"><?php print $settings->{'name'}; ?></h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php print $settings->{'description'}; ?>

                                        <?php
                                            $course_id = $settings->{'course'};
                                            $result = mysqli_query($link, "SELECT *
                                                FROM courses WHERE id = $course_id");
                                            $course = mysqli_fetch_array($result);
                                        ?>

                                        <?php
                                            $department_id = $course['department_id'];
                                            $result = mysqli_query($link, "SELECT *
                                                FROM department WHERE id = $department_id");
                                            $department = mysqli_fetch_array($result);
                                        ?>

                                        <div class="mt-4">
                                            <span class="badge badge-primary"><?php echo $department['department']; ?></span>
                                        </div>

                                        <div class="mt-2">
                                            <span class="badge badge-secondary"><?php echo $course['course']; ?></span>
                                        </div>
                                       

                                        <div class="mt-4">
                                            <small><strong>Date Added:</strong>
                                            <?php echo date('m-d-Y', strtotime($questionnaire['date_added'])); ?></small>
                                        </div>
                                        <div class="mt-1">
                                            <small><strong>Activated until:</strong>
                                            <?php print date('m-d-Y', strtotime($settings->{'activation_date'})); ?></small>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="examination.php?questionnaire_id=<?php echo $questionnaire['id'];  ?>" class="btn btn-success btn-sm float-right">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-play"></i>
                                            </span>
                                            <span class="text">Start</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } 
                        } else { ?>
                            <div>
                                <div class="col-lg-12">
                                    <div class="alert alert-primary" role="alert">
                                        No available questionnaire(s).
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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
</body>

</html>