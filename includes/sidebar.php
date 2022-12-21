<?php 
    $settings_sql = "SELECT * FROM settings";
    $settings_result = mysqli_query($link, $settings_sql);
    $settings = $settings_result->fetch_array(MYSQLI_ASSOC);
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-4" href="dashboard.php">
        <div class="sidebar-brand-text mx-3">
            <img src="uploads/<?php echo $settings['system_logo']; ?>" alt="<?php echo $settings['system_name']; ?>" width="50" style="margin-top: 1rem;"/>
            <span style="word-break: break-word;"><?php echo $settings["system_name"]; ?></span>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "admin") { ?>
        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/dashboard.php') { ?>active <?php } ?>">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/admin_manage_instructor.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#instructor" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Instructors</span>
            </a>
            <div id="instructor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_manage_instructor.php"><i class="fas fa-fw fa-users"></i>  Manage Instructor</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/add_examinee.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_examinee.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Examinees</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="add_examinee.php"><i class="fas fa-fw fa-user-plus"></i>  Add Examinee</a>
                    <a class="collapse-item" href="manage_examinee.php"><i class="fas fa-fw fa-users"></i>  Manage Examinee</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/manage_department.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_course.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Course" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-star"></i>
                <span>Academic Program</span>
            </a>
            <div id="Course" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="manage_department.php"> <i class="fas fa-fw fa-building"></i> Department</a>
                    <a class="collapse-item" href="manage_course.php"> <i class="fas fa-fw fa-star"></i> Course</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/admin_manage_questionnaires.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Questionnaires" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-file"></i>
                <span>Questionnaires</span>
            </a>
            <div id="Questionnaires" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_manage_questionnaires.php"> <i class="fas fa-fw fa-question-circle"></i> Manage Questionnaire</a>
                    <a class="collapse-item" href="admin_question_category.php"><i class="fas fa-fw fa-question"></i> Question Category</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/examination_result_summary.php') { ?>active <?php } ?>">
            <a class="nav-link" href="examination_result_summary.php">
                <i class="fas fa-fw fa-list"></i>
                <span>Examination Result</span></a>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/settings.php') { ?>active <?php } ?>">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-fw fa-cog"></i>
                <span>System Settings</span></a>
        </li>
    <?php  } ?>

    <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "headAdmin") { ?>
        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/dashboard.php') { ?>active <?php } ?>">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/manage_admin.php') { ?>active <?php } ?>">
            <a class="nav-link" href="manage_admin.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Administrators</span></a>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/admin_manage_instructor.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#instructor" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Instructors</span>
            </a>
            <div id="instructor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_manage_instructor.php"><i class="fas fa-fw fa-users"></i>  Manage Instructor</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/add_examinee.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_examinee.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Examinees</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="add_examinee.php"><i class="fas fa-fw fa-user-plus"></i>  Add Examinee</a>
                    <a class="collapse-item" href="manage_examinee.php"><i class="fas fa-fw fa-users"></i>  Manage Examinee</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/manage_department.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_course.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Course" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-star"></i>
                <span>Academic Program</span>
            </a>
            <div id="Course" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="manage_department.php"> <i class="fas fa-fw fa-building"></i> Department</a>
                    <a class="collapse-item" href="manage_course.php"> <i class="fas fa-fw fa-star"></i> Course</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/admin_manage_questionnaires.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Questionnaires" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-file"></i>
                <span>Questionnaires</span>
            </a>
            <div id="Questionnaires" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_manage_questionnaires.php"> <i class="fas fa-fw fa-question-circle"></i> Manage Questionnaire</a>
                    <a class="collapse-item" href="utilities-animation.html"><i class="fas fa-fw fa-star"></i> Course Category</a>
                    <a class="collapse-item" href="admin_question_category.php"><i class="fas fa-fw fa-question"></i> Question Category</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/examination_result_summary.php') { ?>active <?php } ?>">
            <a class="nav-link" href="examination_result_summary.php">
                <i class="fas fa-fw fa-list"></i>
                <span>Examination Result</span></a>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/settings.php') { ?>active <?php } ?>">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-fw fa-cog"></i>
                <span>System Settings</span></a>
        </li>
    <?php  } ?>

    <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "professor") { ?>
        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/dashboard.php') { ?>active <?php } ?>">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/add_examinee.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_examinee.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Examinee</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="add_examinee.php"><i class="fas fa-fw fa-user-plus"></i> Add Examinee</a>
                    <a class="collapse-item" href="manage_examinee.php"><i class="fas fa-fw fa-users"></i> Manage Examinee</a>
                    <a class="collapse-item" href="add_qualifiers.php"><i class="fas fa-fw fa-user-plus"></i> Add Qualifiers</a>
                    <a class="collapse-item" href="manage_qualifiers.php"><i class="fas fa-fw fa-users"></i> Manage Qualifiers</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/manage_department.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_course.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Course" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-star"></i>
                <span>Academic Program</span>
            </a>
            <div id="Course" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="manage_department.php"> <i class="fas fa-fw fa-building"></i> Department</a>
                    <a class="collapse-item" href="manage_course.php"> <i class="fas fa-fw fa-star"></i> Course</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/manage_questionnaires.php' || $_SERVER['PHP_SELF'] == '/acadmission/questionnaires_form.php') { ?>active <?php } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Questionnaires" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-file"></i>
                <span>Questionnaires</span>
            </a>
            <div id="Questionnaires" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="manage_questionnaires.php"> <i class="fas fa-fw fa-question-circle"></i> Manage Questionnaire</a>
                    <a class="collapse-item" href="admin_question_category.php"><i class="fas fa-fw fa-question"></i> Question Category</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/examination_result_summary.php') { ?>active <?php } ?>">
            <a class="nav-link" href="examination_result_summary.php">
                <i class="fas fa-fw fa-list"></i>
                <span>Examination Result</span></a>
        </li>
    <?php  } ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "examinee") { ?>
        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/dashboard.php') { ?>active <?php } ?>">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-file"></i>
                <span>Questionnaires</span>
            </a>
            <div id="settings" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="examinee_questionnaires.php"><i class="fas fa-fw fa-eye"></i> View Questionnaires</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/examination_result.php' || $_SERVER['PHP_SELF'] == '/acadmission/examination_result_details.php') { ?>active <?php } ?>">
            <a class="nav-link" href="examination_result.php">
                <i class="fas fa-fw fa-list"></i>
                <span>Examination Result</span></a>
        </li>

        <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/course_recommendation.php') { ?>active <?php } ?>">
            <a class="nav-link" href="course_recommendation.php">
                <i class="fas fa-fw fa-star"></i>
                <span>Course Recommendation</span></a>
        </li>
    <?php } ?>

 

</ul>
<!-- End of Sidebar -->