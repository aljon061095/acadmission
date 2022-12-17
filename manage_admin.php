<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$user_sql = "SELECT * FROM users WHERE role = 2";
$user_result = mysqli_query($link, $user_sql);
$admins = $user_result->fetch_all(MYSQLI_ASSOC);

//adding admin
if (isset($_POST['add_admin'])) {
    $profile = strtotime(date('y-m-d H:i')) . '_' . $_POST['first_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $username = $_POST['username'];
    $role = 2;

    if (array_key_exists('profile', $_FILES)) {
        if ($_FILES['profile']['tmp_name'] != '') {
            $filename = 'profile' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['profile']['name']);
            $move = move_uploaded_file($_FILES['profile']['tmp_name'], 'uploads/' . $filename);

            if ($move) {
                $profile = $filename;
            }
        }
    }

    $query = "INSERT INTO users(profile, first_name, last_name, email_address, username, role)
            VALUES ('$profile', '$first_name', '$last_name' , '$email_address' , '$username', '$role')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully added a new administrator.";
        header("location: manage_admin.php");
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
                    <h1 class="h3 mb-4 text-gray-800">Manage Admin</h1>

                    <div class="mb-3">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add_admin">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add New Admin</span>
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
                            <h6 class="m-0 font-weight-bold text-primary">Administrator List</h6>
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
                                                    <button type="button" class="btn <?php echo $admin['status'] == 0 ? "btn-success" : "btn-secondary" ?> btn-circle btn-sm enable" data-id="<?php echo $admin['id']; ?>" data-table-name="users" title="<?php echo $admin['status'] == 0 ? "Disabled": "Enabled"?>">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm delete" data-id="<?php echo $admin['id']; ?>" data-table-name="users">
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
    <div class="modal fade" id="add_admin" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Administrator</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <img class="w-100 rounded-circle" src="images/male_avatar.svg" id="cimg">
                            </div>
                            <div class="col-sm-9 mt-3 mb-3 mb-sm-0">
                                <label for="" class="control-label">Profile</label>
                                <input type="file" class="form-control form-control-user" name="profile" onchange="displayImg(this,$(this))" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="last_name">Email Address</label>
                                    <input type="email" name="email_address" class="form-control" id="email_address" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">Password</label>
                                    <input type="text" name="password" class="form-control" id="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_admin" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>

</body>

</html>

<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>