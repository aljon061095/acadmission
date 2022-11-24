<?php
//Include config file
require_once "includes/config.php";

$sql = "SELECT * FROM department";
$result = mysqli_query($link, $sql);
$departments = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Acadmission - Online Examination System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
  <link href="landing-assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="css/acadmission.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="landing-assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="landing-assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="landing-assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="landing-assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="landing-assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="landing-assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="landing-assets/css/landing.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  header-transparent ">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light">
          <a href="landing.php">
            <img class="p-0" src="images/logo.png" />
            <span class="mt-4">Acadmission</span>
          </a>
        </h1>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="#features">Site Features</a></li>
          <li><a href="#testimonials">Programs</a></li>
          <li><a href="#faq">F.A.Q.</a></li>
          <li class="register">
            <a href="professor_login.php">
              Professor Login
            </a>
          </li>
          <li class="login">
            <a href="login.php">
              Student Login
            </a>
          </li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
          <div>
            <h1>Online Examination System</h1>
            <h2>Easy, convenient and user-friendly examination system!</h2>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
          <img src="landing-assets/img/exam-landing.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section>

  <main id="main">

    <section id="features" class="features">
      <div class="container">

        <div class="section-title">
          <h2>Site Features</h2>
          <p>
            Below are the list of features that this system can provide
          </p>
        </div>

        <div class="row no-gutters">
          <div class="col-xl-7 d-flex align-items-stretch order-2 order-lg-1">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="bx bx-spreadsheet"></i>
                  <h4>Create departments and courses</h4>
                  <p>Admin and Instructor can create departments and courses</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-cog"></i>
                  <h4>Site settings</h4>
                  <p>Admin can have an access on site settings (change themes, logo and name)</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-message"></i>
                  <h4>Test Questionnaires</h4>
                  <p>Admin and Instructor can create test questionnaires</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-question-mark"></i>
                  <h4>Examination</h4>
                  <p>Students can take examination</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-stats"></i>
                  <h4>Results and Recommendation</h4>
                  <p>Students can view exam result, ratings and recommendation.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                  <i class="bx bx-id-card"></i>
                  <h4>User accounts</h4>
                  <p>Admin and Instructor can create students/users.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="landing-assets/img/features.png" class="img-fluid" alt="">
          </div>
        </div>

      </div>
    </section><!-- End App Features Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Programs Offered</h2>
          <p>Make the best decision in choosing the right path for you, click through the list of programs offered by Systems Plus College Foundation below.</p>
        </div>

        <div class="owl-carousel testimonials-carousel" data-aos="fade-up">
          <?php if (array_filter($departments) != []) {
            foreach ($departments as $key => $department) { ?>
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="landing-assets/img/department/<?php echo $key; ?>.jpg" class="testimonial-img" alt="">
                  <h3 class="text-center"><?php echo $department["department"]; ?></h3>
                  <p style="word-wrap: break-word;">
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    <?php
                        $department_id = $department['id'];
                        $course_result = mysqli_query($link, "SELECT *
                            FROM courses WHERE department_id = $department_id");
                        $courses = $course_result->fetch_all(MYSQLI_ASSOC);
                    ?>
                    <ul>
                      <?php foreach($courses as $course) { ?>
                         <li> <?php echo $course["course"]; ?></li>
                      <?php } ?>
                    </ul>
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
          <?php  }
          } ?>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <div class="accordion-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i>
              <a data-toggle="collapse" class="collapse" href="#accordion-list">
                What do you mean by online examination?
                <i class="bx bx-chevron-down icon-show"></i>
                <i class="bx bx-chevron-up icon-close"></i>
              </a>
              <div id="accordion-list" class="collapse show" data-parent=".accordion-list">
                <div class="ml-4">
                  <p>
                    An online examination system is a computer-based test system that can be used to 
                    conduct computer based tests online. This examination system uses fewer
                    resources and reduces the need for question papers and answer scripts, exam room scheduling,
                    arranging invigilators, coordinating with examiners, and more.
                  </p>
                </div>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="50">
              <i class="bx bx-help-circle icon-help"></i>
              <a data-toggle="collapse" class="collapsed" href="#accordion-list-1">
                What are the steps on online examination?
                <i class="bx bx-chevron-down icon-show"></i>
                <i class="bx bx-chevron-up icon-close"></i>
              </a>
              <div id="accordion-list-1" class="collapse" data-parent=".accordion-list">
                <div class="ml-4">
                  <p>1. Register your account by requesting it to the administrator.</p>
                  <p>2. Find appropriate test questionnaires to your choosen course.</p>
                  <p>3. Take the examination.</p>
                  <p>4. View result and ratings.</p>
                  <p>5. See the course recommendation.</p>
                </div>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i>
              <a data-toggle="collapse" href="#accordion-list-2" class="collapsed">
                What is the purpose of online examination system?
                <i class="bx bx-chevron-down icon-show"></i>
                <i class="bx bx-chevron-up icon-close"></i>
              </a>
              <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
                <p>
                The purpose of the online examination system is to test the subject knowledge 
                of the students. Such a system eliminates logistical hassles and drawbacks
                in the traditional mode of the pen-and-paper examination. 
                Students don't have to assemble in the classroom to give the exam.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i>
              <a data-toggle="collapse" href="#accordion-list-3" class="collapsed">
                What is the main advantage of examination?
                <i class="bx bx-chevron-down icon-show"></i>
                <i class="bx bx-chevron-up icon-close"></i>
              </a>
              <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                <div class="ml-4">
                 <p>
                  This competition encourages students to work harder and acts as a motivation for them. 
                  The most significant part is that students learn to manage 
                  competition which they are unquestionably going to face later in life.
                 </p>
                </div>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container py-4">
      <div class="copyright text-center">
        Copyright &copy; <strong><span><a href="">Acadmission</a></span></strong>
      </div>
      <div class="credits">
        Online Examination System - <?php echo date("Y"); ?>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="landing-assets/vendor/jquery/jquery.min.js"></script>
  <script src="landing-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="landing-assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="landing-assets/vendor/php-email-form/validate.js"></script>
  <script src="landing-assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="landing-assets/vendor/venobox/venobox.min.js"></script>
  <script src="landing-assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="landing-assets/js/main.js"></script>

</body>

</html>