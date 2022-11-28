<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$settings_sql = "SELECT * FROM settings";
$settings_result = mysqli_query($link, $settings_sql);
$settings = $settings_result->fetch_array(MYSQLI_ASSOC);

if (isset($_POST['save_settings'])) {
    $logo = strtotime(date('y-m-d H:i')) . '_' . $_POST['system_name'];
    $system_name = $_POST['system_name'];

    if (array_key_exists('logo', $_FILES)) {
        if ($_FILES['logo']['tmp_name'] != '') {
            $filename = 'logo' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['logo']['name']);
            $move = move_uploaded_file($_FILES['logo']['tmp_name'], 'uploads/' . $filename);

            if ($move) {
                $logo = $filename;
            }
        }
    }

    $query = "UPDATE settings SET system_logo = '$logo', system_name = '$system_name'";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully updated the system settings.";
        header("location: settings.php");
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
                    <h1 class="h3 mb-4 text-gray-800">System Settings</h1>

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

                    <div class="row ml-2">
                        <div class="card shadow mb-4">
                            <div class="card-body p-4">
                                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
                                    <div class="form-group row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">
                                            <img class="w-100 rounded-circle" src="uploads/<?php echo $settings['system_logo']; ?>" alt="<?php echo $settings['system_name']; ?>" id="cimg">
                                        </div>
                                        <div class="col-sm-9 mt-3 mb-3 mb-sm-0">
                                            <label for="" class="control-label">Logo</label>
                                            <input type="file" class="form-control form-control-user" name="logo" accept="image/png, image/gif, image/jpeg" onchange="displayImg(this,$(this))" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-4">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label for="course">System's Name <span class="small text-muted">(Maximum of 15 characters)</span></label>
                                            <input type="text" maxlength="15" name="system_name" value="<?php echo $settings["system_name"]; ?>" class="form-control form-control-user">
                                        </div>
                                    </div>
                                    <button type="submit" name="save_settings" class="btn btn-primary">
                                        Update
                                    </button>
                                </form>
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

</body>

</html>