<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$examinee_id = $_SESSION["id"];
$course_rec_sql = "SELECT * FROM examinee
            JOIN courses ON examinee.first_choice = courses.id
            JOIN department ON courses.department_id = department.id
            WHERE examinee_id = $examinee_id";
$course_rec_result = mysqli_query($link, $course_rec_sql);
$course_rec = $course_rec_result->fetch_array(MYSQLI_ASSOC);

$department_id = $course_rec["department_id"];
$course_sql = "SELECT * FROM courses WHERE department_id = $department_id";
$course_result = mysqli_query($link, $course_sql);
$courses = $course_result->fetch_all(MYSQLI_ASSOC);

// print_r($courses);
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
                    <h1 class="h3 mb-4 text-gray-800">Course Recommendation</h1>

                    <div class="container">
                        <div class="row">
                            <?php foreach($courses as $course) { ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        <?php echo $course_rec["department"]; ?>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $course["course"]; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-star fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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

</body>

</html>