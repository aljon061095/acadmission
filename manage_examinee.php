<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$examinee_sql = "SELECT * FROM examinee";
$examinee_result = mysqli_query($link, $examinee_sql);
$examinees = $examinee_result->fetch_all(MYSQLI_ASSOC);
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
                    <h1 class="h3 mb-4 text-gray-800">Manage Examinee</h1>

                    <div class="mb-3">
                        <a href="add_examinee.php" class="btn btn-success">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add New Examinee</span>
                        </a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Examinee List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>K12 Strand</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($examinees as $examinee) { ?>
                                            <tr>
                                                <td><?php echo $examinee['last_name'] ?> <?php echo $examinee['first_name'] ?> <?php echo $examinee['middle_name'] ?></td>
                                                <td><?php echo $examinee['address'] ?></td>
                                                <td><?php echo $examinee['gender'] ?></td>
                                                <td><?php echo $examinee['email_address'] ?></td>
                                                <td><?php echo $examinee['phone_number'] ?></td>
                                                <td>
                                                    <?php
                                                        $strand_id = $examinee['strand_id'];
                                                        $result = mysqli_query($link, "SELECT *
                                                            FROM strands WHERE id = $strand_id");
                                                        $strands = mysqli_fetch_array($result);
                                                    ?>
                                                    <?php echo $strands['strand']; ?>
                                                </td>
                                                <td><?php echo $examinee['status'] ?></td>
                                                <td>
                                                    <!-- <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#update_examinee_<?php echo $examinee['examinee_id']; ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a> -->
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm examinee-delete" data-id="<?php echo $examinee['examinee_id']; ?>" data-is-examinee="true" data-table-name="examinee">
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
    <div class="modal fade" id="add_new_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control" id="middle_name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label for="gender">Gender</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" checked>
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="inlineRadio3">Other</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Email Address</label>
                                    <input type="email" name="email_address" class="form-control" id="email_address" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control" id="phone_number" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_choice">First Choice</label>
                                    <select id="first_choice" class="form-control">
                                        <option value="" selected>Choose your first course...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Submit</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>

</body>

</html>

<script>
      $(document).ready(function() {
         // Delete 
         $('.examinee-delete').click(function() {
            var el = this;

            var deleteId = $(this).data('id');
            var tableName = $(this).data('table-name');
            var isExaminee = $(this).data('is-examinee');

            var confirmalert = confirm("Are you sure you want to delete?");
            if (confirmalert == true) {
               // AJAX Request
               $.ajax({
                  url: 'remove.php',
                  type: 'POST',
                  data: {
                     id: deleteId,
                     tableName: tableName,
                     isExaminee: isExaminee
                  },
                  success: function(response) {
                     if (response == 1) {
                        // Remove row from HTML Table
                        $(el).closest('tr').css('background', 'tomato');
                        $(el).closest('tr').fadeOut(800, function() {
                           $(this).remove();
                        });

                        $('.deleted-message').removeClass('hidden');
                     }

                  }
               });
            }

         });

      });
   </script>