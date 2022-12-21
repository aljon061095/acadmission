<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$questionnaires_sql = "SELECT * FROM questionnaires";
$questionnaires_result = mysqli_query($link, $questionnaires_sql);
$questionnaires = $questionnaires_result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['accept_questionnaire'])) {
    $questionnaire_id = $_POST['questionnaire_id'];
    $status = 2;

    $query = "UPDATE `questionnaires` SET `status` = $status WHERE id = $questionnaire_id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully accepted the questionnaire.";
        header("location: admin_manage_questionnaires.php");
    }
}
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
                    <h1 class="h3 mb-4 text-gray-800">Manage Questionnaires</h1>

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
                            <h6 class="m-0 font-weight-bold text-primary">List of Questionnaires</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Department</th>
                                            <th>Course</th>
                                            <th>Date Added</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($questionnaires as $questionnaire) {
                                            $settings = json_decode($questionnaire['settings']);
                                        ?>
                                            <tr>
                                                <td><?php print $settings->{'name'}; ?></td>
                                                <td><?php print $settings->{'description'}; ?></td>
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
                                                <td><?php echo $department['department']; ?></td>
                                                <td><?php echo $course['course']; ?></td>
                                                <td><?php echo date('m-d-Y', strtotime($questionnaire['date_added'])); ?></td>
                                                <td class="text-center">
                                                    <?php if ($questionnaire['status'] == 1) { ?>
                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="user">
                                                            <input type="hidden" name="questionnaire_id" value="<?php echo $questionnaire['id']; ?>">
                                                            <button type="submit" name="accept_questionnaire" class="btn btn-success btn-circle btn-sm" title="Accept Questionnaire">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    <?php } ?>
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm delete" data-id="<?php echo $questionnaire['id']; ?>" data-table-name="questionnaires" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
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

    <!-- Add New Examinee Modal-->
    <div class="modal fade" id="add_department" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Department</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="course">Department</label>
                                    <input type="text" name="department" class="form-control" id="department" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_department" class="btn btn-primary">
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