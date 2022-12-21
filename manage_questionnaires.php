<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$questionnaires_sql = "SELECT * FROM questionnaires";
$questionnaires_result = mysqli_query($link, $questionnaires_sql);
$questionnaires = $questionnaires_result->fetch_all(MYSQLI_ASSOC);

// print_r($questionnaires);
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
                    <h1 class="h3 mb-4 text-gray-800">Manage Questionnaries</h1>

                    <div class="mb-3">
                        <a href="questionnaires_form.php" class="btn btn-success">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add New Questionnaries</span>
                        </a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Questionnaire List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Questionnaire's Name</th>
                                            <th>Description</th>
                                            <!-- <th>Department</th> -->
                                            <th>Strands</th>
                                            <th>Date Added</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($questionnaires as $questionnaire) {
                                            $settings =json_decode($questionnaire['settings']);
                                        ?>
                                            <tr>
                                                <td><?php print $settings->{'name'}; ?></td>
                                                <td><?php print $settings->{'description'}; ?></td>
                                                <td>
                                                    <?php
                                                        $strand_id = $questionnaire['strand'];
                                                        $result = mysqli_query($link, "SELECT *
                                                            FROM strands WHERE id = $strand_id");
                                                        $strand = mysqli_fetch_array($result);
                                                    ?>
                                                    <?php echo $strand['strand']; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('m-d-Y', strtotime($questionnaire['date_added'])); ?></small>
                                                </td>
                                                <td>
                                                <?php if ($questionnaire['status'] == 1) { ?>
                                                        <span class="badge light badge-warning text-center">
                                                                Pending
                                                            </span>
                                                        <?php } ?>
                                                        <?php 
                                                            if ($questionnaire['status'] == 2) { ?>
                                                            <span class="badge light badge-success text-center">
                                                                Approved
                                                            </span>
                                                        <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="questionnaires_info.php?questionnaire_id=<?php echo $questionnaire['id'];  ?>" class="btn btn-info btn-circle btn-sm">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm delete" data-id="<?php echo $questionnaire['id']; ?>" data-table-name="examinee">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                                <?php include 'update_examinee.php'; ?>
                                            </tr>
                                        <?php } ?>
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