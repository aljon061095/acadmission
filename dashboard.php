<?php 
    // Include config file
    require_once "includes/config.php";

    // Initialize the session
    session_start();

   // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    //get questionnnires count
    $questionnaires_sql = "SELECT * FROM questionnaires";
    $questionnaires_result = mysqli_query($link, $questionnaires_sql);
    $questionnaires = $questionnaires_result->fetch_all(MYSQLI_ASSOC);

    //get examinees count
    $examinee_sql = "SELECT * FROM examinee";
    $examinee_result = mysqli_query($link, $examinee_sql);
    $examinees = $examinee_result->fetch_all(MYSQLI_ASSOC);

    //get courses count
    $courses_sql = "SELECT * FROM courses";
    $courses_result = mysqli_query($link, $courses_sql);
    $courses = $courses_result->fetch_all(MYSQLI_ASSOC);

    //get department count
    $department_sql = "SELECT * FROM department";
    $department_result = mysqli_query($link, $department_sql);
    $departments = $department_result->fetch_all(MYSQLI_ASSOC);

    //get courses count
    $questions_sql = "SELECT * FROM questions LIMIT 10";
    $questions_result = mysqli_query($link, $questions_sql);
    $questions = $questions_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body id="page-top">
    <?php include 'includes/preloader.php'; ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'includes/navbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "professor" || $_SESSION["user"] === "admin") { ?>
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Questionnaires
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($questionnaires); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Examinees
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($examinees); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                               Courses
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($courses); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-star fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                               Department
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($departments); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-building fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>

                    <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "examinee") { ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Questionnaires
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($questionnaires); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Courses
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($courses); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-star fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Department
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($departments); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-building fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          <?php include 'includes/footer.php'; ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   <?php include 'includes/scripts.php'; ?>
   <?php include 'includes/background.php'; ?>

</body>

</html>