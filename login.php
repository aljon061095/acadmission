<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Include config file
require_once "includes/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

//Student Login
if (isset($_POST['login_examinee'])) {

    // Check if email address is empty
    if (empty(trim($_POST["email_address"]))) {
        $email_address_err = "Please enter email address.";
    } else {
        $email_address = trim($_POST["email_address"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_address_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, email_address, password FROM examinee WHERE email_address = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email_address);

            // Set parameters
            $param_email_address = $email_address;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email_address, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            //place otp verification here

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $email_address;
                            $_SESSION["user"] = "examinee";

                            header("location: dashboard.php");
                        } else {
                            $_SESSION['login_err'] = 'Invalid email address or password';
                        }
                    }
                } else {
                    $_SESSION['login_err']  = 'Invalid email address or password';
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<style>

</style>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body class="main-bg-primary">
    <div class="container">
        <div class="col-md-10 ml-auto col-xl-6 mr-auto">
            <!-- Nav tabs -->
            <div class="card p-3">
                <div class="mt-2">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Login your account</h1>
                    </div>
                    <div class="text-center">
                        <?php
                        if (isset($_SESSION['login_err'])) {
                        ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php echo $_SESSION['login_err']; ?>
                            </div>
                        <?php
                            unset($_SESSION['login_err']);
                        }
                        ?>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="user">
                        <div class="form-group">
                            <input type="text" name="email_address" class="form-control form-control-user" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                        </div>
                        <button type="submit" name="login_examinee" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <span>Don't have an account? Contact your administrator.</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>