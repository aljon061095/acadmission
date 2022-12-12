<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$user_id = $_SESSION["id"];

$user_sql = "SELECT * FROM examinee WHERE examinee_id = $user_id";
$user_result = mysqli_query($link, $user_sql);
$user = $user_result->fetch_array(MYSQLI_ASSOC);

//adding courses
if (isset($_POST['update_examinee_profile'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $gender = $_POST['gender'];

    $query = "UPDATE examinee SET 
            first_name = '$first_name',
            middle_name = '$middle_name',
            last_name = '$last_name',
            email_address = '$email_address',
            address = '$address',
            gender = '$gender',
            phone_number = '$phone_number'
            WHERE examinee_id = $user_id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully update your profile information.";
        header("location: examinee_profile.php");
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
                    <div class="container">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="user">
                                        <div class="card-body">
                                            <div class="row gutters">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <h4 class="mb-4 text-primary">Personal Details</h4>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="form-group">
                                                        <label for="firstname">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user["first_name"]; ?>" placeholder="Enter full name">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="form-group">
                                                        <label for="lastName">Middle Name</label>
                                                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $user["middle_name"]; ?>" placeholder="Enter full name">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="form-group">
                                                        <label for="lastName">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user["last_name"]; ?>" placeholder="Enter full name">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="emai_address" value="<?php echo $user["email_address"]; ?>" placeholder="Enter email ID">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $user["address"]; ?>" placeholder="Enter phone number">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $user["gender"]; ?>" placeholder="Enter phone number">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label for="phone_number">Phone Number</label>
                                                        <input type="number" class="form-control" id="number" name="phone_number" value="<?php echo $user["phone_number"]; ?>" placeholder="Enter phone number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row gutters">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="text-right">
                                                        <button type="button" id="submit" name="update_examinee_profile" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

</body>

</html>