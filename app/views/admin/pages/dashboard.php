<?php 

   $goals = $data['goals'];
   $percent_goal_sales =intval( ($data['month_total_sales'] * 100) / $goals->sales_goal);
   $percent_goal_orders =intval( (sizeof($data['month_orders']) * 100) / $goals->orders_goal);
   $percent_goal_users =intval( (sizeof($data['month_new_users']) * 100) / $goals->users_goal);

?>

<!doctype html>
<html lang="ar" dir="rtl">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=SITENAME?> - Dashboard</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?=URLROOT.'assets/'?>images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?=URLROOT .'assets/'?>css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=URLROOT .'assets/'?>css/dataTables.bootstrap4.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?=URLROOT .'assets/'?>css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?=URLROOT .'assets/'?>css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?=URLROOT .'assets/'?>css/responsive.css">
      <link rel="stylesheet" href="<?=URLROOT ?>assets/css/arabic-font.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <?php require_once APPROOT .'/views/inc/side_bar.php' ?>
         <!-- TOP Nav Bar -->
         <?php require_once APPROOT .'/views/inc/top_nav_admin.php' ?>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-line"></i></div>
                              <div class="text-left ml-3">                                 
                                 <h2 class="mb-0"><span class="counter"><?=$data['users_count']?></span></h2>
                                 <h5 class="">المستخدمين</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-book-line"></i></div>
                              <div class="text-left ml-3">                                 
                                 <h2 class="mb-0"><span class="counter"><?=$data['books_count']?></span></h2>
                                 <h5 class="">كتب</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-shopping-cart-2-line"></i></div>
                              <div class="text-left ml-3">                                 
                                 <h2 class="mb-0">$<span class="counter"><?=$data['sales']?></span></h2>
                                 <h5 class="">مبيعات</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-info"><i class="ri-radar-line"></i></div>
                              <div class="text-left ml-3">                                 
                                 <h2 class="mb-0"><span class="counter"><?=$data['orders_count']?></span></h2>
                                 <h5 class="">الطلبيات</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">المبيعات اليومية</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="iq-sale-chart"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">هدف الشهر</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                    <a class="dropdown-item" href="javascript:void()" data-toggle="modal" data-target="#changeGoalsModel"><i class="ri-pencil-fill mr-2"></i>تعديل</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="changeGoalsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">تعديل هدف الشهر</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <form method="post">
                                       <div class="modal-body">
                                          <div class="form-group">
                                             <label for="sales_form">مبيعات:</label>
                                             <input type="number" class="form-control" name="sales_goal" id="sales_form" placeholder="حدد الهدف الذي تطمح لتحقيقه في المبيعات" 
                                             value="<?=(isset($data['goals']) ? $data['goals']->sales_goal: '0')?>">
                                          </div>
                                          <div class="form-group">
                                             <label for="orders_form">الطلبيات:</label>
                                             <input type="number" class="form-control" name="orders_goal" id="orders_form" placeholder="حدد الهدف الذي تطمح لتحقيقه في عدد الطلبات" value="<?=(isset($data['goals']) ? $data['goals']->orders_goal: '0')?>">
                                          </div>
                                          <div class="form-group">
                                             <label for="users_form">المستخدمين:</label>
                                             <input type="number" class="form-control" name="users_goal" id="users_form" placeholder="حدد الهدف الذي تطمح لتحقيقه في عدد مستخدمي الموقع"  value="<?=(isset($data['goals']) ? $data['goals']->users_goal: '0')?>">
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                          <button type="submit" name="changeGoals" class="btn btn-primary">حفظ</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        <div class="iq-card-body">
                           <ul class="list-inline p-0 mb-0">
                              <li>
                                 <div class="iq-details mb-2">
                                    <span class="title">مبيعات</span>
                                    <div class="percentage float-right text-<?=$percent_goal_sales < 50 ? 'danger' : 'success'?>"><?=$percent_goal_sales?> <span>%</span></div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                       <div class="iq-progress-bar iq-bg-<?=$percent_goal_sales < 50 ? 'danger' : 'success'?>">
                                          <span class="bg-<?=$percent_goal_sales < 50 ? 'danger' : 'success'?>" data-percent="<?=$percent_goal_sales > 100 ? 100 : $percent_goal_sales?>"></span>
                                       </div>
                                    </div>
                                 </div>                                       
                              </li>
                              <li>
                                 <div class="iq-details mb-2">
                                    <span class="title">الطلبيات</span>
                                    <div class="percentage float-right text-<?=$percent_goal_orders < 50 ? 'danger' : 'success'?>"><?=$percent_goal_orders?> <span>%</span></div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                       <div class="iq-progress-bar iq-bg-<?=$percent_goal_orders < 50 ? 'danger' : 'success'?>">
                                          <span class="bg-<?=$percent_goal_orders < 50 ? 'danger' : 'success'?>" data-percent="<?=$percent_goal_sales > 100 ? 100 : $percent_goal_orders?>"></span>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                <div class="iq-details mb-2">
                                    <span class="title">المستخدمين</span>
                                    <div class="percentage float-right text-<?=$percent_goal_users < 50 ? 'danger' : 'success'?>"><?=$percent_goal_users?> <span>%</span></div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                       <div class="iq-progress-bar iq-bg-<?=$percent_goal_users < 50 ? 'danger' : 'success'?>">
                                          <span class="bg-<?=$percent_goal_users < 50 ? 'danger' : 'success'?>" data-percent="<?=$percent_goal_users > 100 ? 100 : $percent_goal_users?>"></span>
                                       </div>
                                    </div>
                                 </div> 
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <h4 class="text-uppercase text-black mb-0">المستخدمين النشطين (الآن)</h4>
                              <div class="d-flex justify-content-between align-items-center">
                                 <div class="font-size-80 text-black">0</div>
                                 <div class="text-left">
                                    <!-- <p class="m-0 text-uppercase font-size-12">1 Hours Ago</p>
                                    <div class="mb-1 text-black">1500<span class="text-danger"><i class="ri-arrow-down-s-fill"></i>3.25%</span></div>
                                    <p class="m-0 text-uppercase font-size-12">1 Day Ago</p>
                                    <div class="mb-1 text-black">1890<span class="text-success"><i class="ri-arrow-down-s-fill"></i>1.00%</span></div>
                                    <p class="m-0 text-uppercase font-size-12">1 Week Ago</p>
                                    <div class="text-black">1260<span class="text-danger"><i class="ri-arrow-down-s-fill"></i>9.87%</span></div> -->
                                 </div>
                              </div>
                              <!-- <div id="wave-chart-7"></div> -->
                           </div>
                        </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">أحدث الطلبات</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table class="table mb-0 table-borderless">
                                 <thead>
                                    <tr>
                                       <th scope="col">عميل</th>
                                       <th scope="col">تاريخ</th>
                                       <th scope="col">رقم الفاتورة</th>
                                       <th scope="col">السعر</th>
                                       <th scope="col">الحالة</th>
                                       <!-- <th scope="col">تعديل</th> -->

                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($data['month_orders'] as $order): ?>
                                       <?php
                                          $user = $this->user_model->read_by_id($order->user_id);

                                       ?>
                                       <tr>
                                          <td>
                                             <?=$user->fullname?>
                                          </td>
                                          <td><?=date( "Y-m-d", strtotime($order->created_at) );?></td>
                                          <td><?=$order->id?></td>
                                          <td>$<?=$order->amount?></td>
                                          <td><div class="badge badge-pill badge-<?=$order->status == STATUS_PAIED ? 'success' : 'danger'?>"> تم الدفع</div></td>
                                          <!-- <td>Copy</td> -->
                                       </tr>
                                    <?php endforeach ?>   
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content Page End -->
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright 2020 <a href="#">Booksto</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="<?=URLROOT .'assets/'?>js/jquery.min.js"></script>
      <script src="<?=URLROOT .'assets/'?>js/popper.min.js"></script>
      <script src="<?=URLROOT .'assets/'?>js/bootstrap.min.js"></script>
      <script src="<?=URLROOT .'assets/'?>js/jquery.dataTables.min.js"></script>
      <script src="<?=URLROOT .'assets/'?>js/dataTables.bootstrap4.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/waypoints.min.js"></script>
      <script src="<?=URLROOT .'assets/'?>js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/worldLow.js"></script>
      <!-- Raphael-min JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/raphael-min.js"></script>
      <!-- Morris JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/morris.js"></script>
      <!-- Morris min JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/morris.min.js"></script>
      <!-- Flatpicker Js -->
      <script src="<?=URLROOT .'assets/'?>js/flatpickr.js"></script>
      <!-- Style Customizer -->
      <script src="<?=URLROOT .'assets/'?>js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="<?=URLROOT .'assets/'?>js/custom.js"></script>
      <script>
         <?php
            $js_array = '[';
            $js_array2 = '[';
            for ($i=0; $i < 7; $i++) { 
               if(sizeof($data['last_seven']) > $i){
                  $js_array .= $data['last_seven'][$i]->Total.',';
                  $js_array2 .= '\''.date('D', strtotime($data['last_seven'][$i]->created_at)).'\''.',';
               } else {
                  $js_array2 .= '\'\',';
                  $js_array .= '0,';
               }
            }
            $js_array .=']';
            $js_array2 .=']';

            // echo(var_dump($js_array));
            // echo(var_dump($js_array2));

         ?>

         if(jQuery('#iq-sale-chart').length){
            var options = {
                  series: [{
                  name: '',
                  data: <?=$js_array?>
               }],
                  chart: {
                  type: 'bar'
               },
               colors:['#0dd6b8'],
               plotOptions: {
                  bar: {
                     horizontal: false,
                     columnWidth: '45%',
                     endingShape: 'rounded'
                  },
               },
               dataLabels: {
                  enabled: false
               },
               stroke: {
                  show: true,
                  width: 2,
                  colors: ['transparent']
               },
               xaxis: {
                  categories: <?=$js_array2?>,
               },
               yaxis: {
                  title: {
                     text: ''
                  },
                  labels: {
                     offsetX: -20,
                     offsetY: 0
                  },
               },
                  grid: {
                  padding: {
                     left: -5,
                     right: 0
                  }
               },
               fill: {
                  opacity: 1
               },
               tooltip: {
                  y: {
                     formatter: function (val) {
                     return "$ " + val
                     }
                  }
               }
               };

               var chart = new ApexCharts(document.querySelector("#iq-sale-chart"), options);
               chart.render();
         }
      </script>
   </body>
</html>