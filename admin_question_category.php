<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$question_category_sql = "SELECT * FROM question_types";
$question_types_result = mysqli_query($link, $question_category_sql);
$question_types = $question_types_result->fetch_all(MYSQLI_ASSOC);

// //adding courses
// if (isset($_POST['add_course'])) {
//     $department_id = $_POST['department_id'];
//     $course = $_POST['course'];
//     $status = 1;

//     $query = "INSERT INTO courses(department_id, course, status)
//             VALUES ('$department_id', '$course', '$status')";
//     $query_run = mysqli_query($link, $query);

//     if ($query_run) {
//         $_SESSION['success_status'] = "You have successfully added a new course.";
//         header("location: manage_course.php");
//     }
// }

// if (isset($_POST['update_course'])) {
//     $course_id = $_POST['course_id'];
//     $course = $_POST['course'];

//     $query = "UPDATE course SET course = $course WHERE id = $course_id";
//     $query_run = mysqli_query($link, $query);

//     if ($query_run) {
//         $_SESSION['success_status'] = "You have successfully update the course.";
//         header("location: manage_course.php");
//     }
// }
// ?>

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
                    <h1 class="h3 mb-4 text-gray-800">Manage Question Category</h1>

                    <div class="mb-3">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add_question_type">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add New Question Type</span>
                        </a>
                    </div>

                    <div class="row">
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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Question Types</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Question Type</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($question_types as $question_type) { ?>
                                            <tr>
                                                <td><?php echo $question_type['type']; ?></td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#update_question_type_<?php echo $question_type['id']; ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm delete" data-id="<?php echo $question_type['id']; ?>" data-table-name="question_types">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                                <?php include 'update_question_type.php'; ?>
                                            </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
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

    <!-- Add New Student Modal-->
    <div class="modal fade" id="add_question_type" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question Type</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="course">Question Type</label>
                                    <input type="text" name="course" class="form-control" id="course" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_course" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>

</body>

</html>