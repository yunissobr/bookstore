
<!doctype html>
<html lang="ar" dir="rtl">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Bookstore - <?=$data['title']?></title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?=URLROOT?>assets/images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?=URLROOT?>assets/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?=URLROOT?>assets/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?=URLROOT?>assets/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?=URLROOT?>assets/css/responsive.css">
      <link rel="stylesheet" href="<?=URLROOT?>assets/css/arabic-font.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center page-content rounded">
                    <div class="row m-0">
                      <div class="col-sm-12 sign-in-page-data">
                          <div class="sign-in-from bg-primary rounded">
                              <h3 class="mb-0 text-center text-white">تسجيل</h3>
                              <p class="text-center text-white">أدخل اسمك وعنوان بريدك الإلكتروني وكلمة المرور للتسجيل.</p>
                              <?php show_alert(false)?>
                              <form class="mt-4 form-text" method="post">
                                  <div class="form-group">
                                      <label for="fullname">اسمك الكامل</label>
                                      <input type="text" name="fullname" class="form-control mb-0" id="fullname" placeholder="اسمك الكامل" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="email">البريد الإلكتروني</label>
                                      <input type="email" name="email" class="form-control mb-0" id="email" placeholder="البريد الإلكتروني" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="password">كلمه السر</label>
                                      <input type="password" name="password" class="form-control mb-0" id="password" placeholder="كلمه السر" required>
                                  </div>
                                  <!-- <div class="d-inline-block w-100">
                                      <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1">I accept <a href="#" class="text-light">Terms and Conditions</a></label>
                                      </div>
                                  </div> -->
                                  <div class="sign-info text-center">
                                      <button type="submit" name="create" class="btn btn-white d-block w-100 mb-2">تسجيل</button>
                                      <span class="text-dark d-inline-block line-height-2">هل لديك حساب؟ <a href="<?=URLROOT . 'auth/login'?>" class="text-white">تسجيل الدخول </a></span>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="<?=URLROOT?>assets/js/jquery.min.js"></script>
      <script src="<?=URLROOT?>assets/js/popper.min.js"></script>
      <script src="<?=URLROOT?>assets/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="<?=URLROOT?>assets/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="<?=URLROOT?>assets/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="<?=URLROOT?>assets/js/waypoints.min.js"></script>
      <script src="<?=URLROOT?>assets/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="<?=URLROOT?>assets/js/wow.min.js"></script>
      <!-- lottie JavaScript -->
      <script src="<?=URLROOT?>assets/js/lottie.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="<?=URLROOT?>assets/js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="<?=URLROOT?>assets/js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="<?=URLROOT?>assets/js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="<?=URLROOT?>assets/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="<?=URLROOT?>assets/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="<?=URLROOT?>assets/js/smooth-scrollbar.js"></script>
      <!-- Style Customizer -->
      <script src="<?=URLROOT?>assets/js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="<?=URLROOT?>assets/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="<?=URLROOT?>assets/js/custom.js"></script>
   </body>
</html>