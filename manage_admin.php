<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$user_sql = "SELECT * FROM users WHERE role = 2";
$user_result = mysqli_query($link, $user_sql);
$admins = $user_result->fetch_all(MYSQLI_ASSOC);

//adding courses
if (isset($_POST['add_course'])) {
    $department_id = $_POST['department_id'];
    $course = $_POST['course'];
    $status = 1;

    $query = "INSERT INTO courses(department_id, course, status)
            VALUES ('$department_id', '$course', '$status')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully added a new course.";
        header("location: manage_course.php");
    }
}
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
                    <h1 class="h3 mb-4 text-gray-800">Manage Course</h1>

                    <div class="mb-3">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add_course">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add New Course</span>
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
                            <h6 class="m-0 font-weight-bold text-primary">Course List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email Adddress</th>
                                            <th>Username</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($admins as $admin) { ?>
                                            <tr>
                                                <td><?php echo $admin['first_name']; ?></td>
                                                <td><?php echo $admin['last_name']; ?></td>
                                                <td><?php echo $admin['email_address']; ?></td>
                                                <td><?php echo $admin['username']; ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm delete" data-id="<?php echo $admin['id']; ?>" data-table-name="userss">
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

    <!-- Add New Student Modal-->
    <div class="modal fade" id="add_course" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Course</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <select name="department_id" id="department_id" class="form-control" required>
                                        <option value="" selected>Choose Department...</option>
                                        <?php foreach ($departments as $department) { ?>
                                            <option value="<?php echo $department['id']; ?>"><?php echo $department['department']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="course">Course</label>
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