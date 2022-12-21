<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$user_id = $_SESSION["id"];
$user_sql = "SELECT * FROM examinee WHERE examinee_id = $user_id";
$user_result = mysqli_query($link, $user_sql);
$user = $user_result->fetch_array(MYSQLI_ASSOC);
$strand_id = $user['strand_id'];

$questionnaires_sql = "SELECT * FROM questionnaires WHERE strand = $strand_id && status = 2";
$questionnaires_result = mysqli_query($link, $questionnaires_sql);
$questionnaire_list = $questionnaires_result->fetch_all(MYSQLI_ASSOC);

//add checking questionnaire validity
$date_now = date("Y-m-d H:i:s");
function filterByActivationDate($questionnaires, $dateNow) {
    return array_filter($questionnaires, function ($item) use ($dateNow) {
        if ($item['activation_date'] >= $dateNow) {
            return true;
        }
    });
}

$questionnaires = filterByActivationDate($questionnaire_list, $date_now);
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
                    <h1 class="h3 mb-4 text-gray-800">Examinee Questionnaries</h1>

                    <div class="mt-1">
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

                    <div >
                        <?php
                        if (array_filter($questionnaires) !== []) { 
                            foreach($questionnaires as $questionnaire) {
                                $settings =json_decode($questionnaire['settings']);
                            ?>
                            <div >  
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary"><?php print $settings->{'name'}; ?></h6>
                                    </div>
                                    <div class="card-body">
                                    <small><strong>Description:</strong>
                                        <?php print $settings->{'description'}; ?>

                                        <?php
                                           $strand_id = $questionnaire['strand'];
                                           $result = mysqli_query($link, "SELECT *
                                               FROM strands WHERE id = $strand_id");
                                           $strand = mysqli_fetch_array($result);
                                        ?>

<<<<<<< HEAD
                                      

                                        <div class="mt-4">
                                            <span class="badge badge-success"><?php echo $strand['strand']; ?></span>
                                        </div>
=======
                                        <div class="mt-4">
                                            <span class="badge badge-success"><?php echo $strand['strand']; ?></span>
                                        </div>                                       
>>>>>>> eb2d66742c63ad69d000ceee7db9a0aaf4c18657

                                        <div class="mt-4">
                                            <small><strong>Date Added:</strong>
                                            <?php echo date('m-d-Y', strtotime($questionnaire['date_added'])); ?></small>
                                        </div>
                                        <div class="mt-1">
                                            <small><strong>Activated until:</strong>
                                            <?php print date('m-d-Y', strtotime($questionnaire['activation_date'])); ?></small>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="examination.php?questionnaire_id=<?php echo $questionnaire['id'];  ?>" class="btn btn-success btn-sm float-right">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-play"></i>
                                            </span>
                                            <span class="text">Start</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </div>
                           
                        <?php } 
                        } else { ?>
                            <div>
                                <div class="col-lg-12">
                                    <div class="alert alert-primary" role="alert">
                                        No available questionnaire(s).
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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