
<!doctype html>
<html lang="en" dir="rtl">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Booksto - <?=$data['title'] ?></title>
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
                                <h3 class="mb-0 text-white">اكتب كلمة مرورك الجديدة</h3>
                                <?php show_alert() ?>
                                <form method="post" class="mt-4 form-text">
                                    <div class="form-group">
                                        <label for="password">كلمة المرور الجديدة</label>
                                        <input type="password" class="form-control mb-0" name="password" id="password" placeholder="كلمة المرور الجديدة" required>
                                    </div>
                                    <div class="d-inline-block w-100">
                                        <button type="submit" class="btn btn-white" name="update">تحديث</button>
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
      <!-- lottie JavaScript -->
      <script src="<?=URLROOT?>assets/js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="<?=URLROOT?>assets/js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="<?=URLROOT?>assets/js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="<?=URLROOT?>assets/js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="<?=URLROOT?>assets/js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="<?=URLROOT?>assets/js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="<?=URLROOT?>assets/js/worldLow.js"></script>
      <!-- Style Customizer -->
      <script src="<?=URLROOT?>assets/js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="<?=URLROOT?>assets/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="<?=URLROOT?>assets/js/custom.js"></script>
   </body>
</html>