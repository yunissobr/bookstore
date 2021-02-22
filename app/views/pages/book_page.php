
<?php $current_book = $data['book'];?>
<?php $current_book_author = $this->user_model->read_by_id($current_book->author_id);?>
<?php $current_book_categroy = $this->category_model->read_by_id($current_book->category_id);?>
<!doctype html>
<html lang="en" dir="rtl">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=SITENAME?></title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?=URLROOT?>assets/images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?=URLROOT.'assets/'?>css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?=URLROOT.'assets/'?>css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?=URLROOT.'assets/'?>css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?=URLROOT.'assets/'?>css/responsive.css">
      <link rel="stylesheet" href="<?=URLROOT ?>assets/css/arabic-font.css">
      <link rel="stylesheet" href="<?=URLROOT ?>css/style.css">
   </head>
   <body class="sidebar-main-active right-column-fixed">
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
               <a href="index.html" class="header-logo">
                  <img src="><?=URLROOT?>assets/images/logo.png" class="img-fluid rounded-normal" alt="">
                  <div class="logo-title">
                     <span class="text-primary text-uppercase">Booksto</span>
                  </div>
               </a>
               <div class="iq-menu-bt-sidebar">
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="las la-bars"></i></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- TOP Nav Bar -->
         <?php require APPROOT . '/views/inc/top_nav.php'; ?>
        <!-- TOP Nav Bar END -->
         
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
               <div class="col-sm-12">
                      <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                          <div class="iq-card-header d-flex justify-content-between align-items-center">
                              <h4 class="card-title mb-0">تفاصيل الكتاب</h4>
                          </div>
                          <div class="iq-card-body pb-0">
                              <div class="description-contens align-items-top row">
                                  <div class="col-md-6">
                                      <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                          <div class="iq-card-body p-0">
                                              <div class="row align-items-center">
                                                  <div class="col-3">
                                                      <ul id="description-slider-nav" class="list-inline p-0 m-0  d-flex align-items-center">
                                                          <li>
                                                              <a href="javascript:void(0);">
                                                              <img src="<?=URLROOT.'img/book/'.$current_book->image ?>" class="img-fluid rounded w-100" alt="">
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                                  <div class="col-9">
                                                      <ul id="description-slider" class="list-inline p-0 m-0  d-flex align-items-center">
                                                          <li>
                                                              <a href="javascript:void(0);">
                                                              <img src="<?=URLROOT.'img/book/'.$current_book->image?>" class="img-fluid w-100 rounded" alt="">
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                          <div class="iq-card-body p-0">
                                              <h3 class="mb-3"><?=$current_book->name?></h3>
                                              <div class="price d-flex align-items-center font-weight-500 mb-2">
                                                  <span class="font-size-20 pr-2 old-price">$<?=$current_book->promo_price?></span>
                                                  <span class="font-size-24 text-dark">$<?=$current_book->price?></span>
                                              </div>
                                              <div class="mb-3 d-block">
                                                  <span class="font-size-20 text-warning">
                                                  <i class="fa fa-star mr-1"></i>
                                                  <i class="fa fa-star mr-1"></i>
                                                  <i class="fa fa-star mr-1"></i>
                                                  <i class="fa fa-star mr-1"></i>
                                                  <i class="fa fa-star"></i>
                                                  </span>
                                              </div>
                                              <div class="iq-border-bottom pb-4 mb-4">
                                                <span class="text-dark d-block description-text" id="description">
                                                   <?=$current_book->description?>
                                                </span>
                                                <p onclick="toggleDescription()" class="read-more p-btn">أظهر المزيد</p>
                                              </div>
                                              <div class="text-primary mb-4">مؤلف: <span class="text-body"><?=$current_book_author->fullname?></span></div>
                                              <div class="mb-4 d-flex align-items-center">
                                                 <?php if(!$this->is_user_have_book($current_book->id)): ?>                                    
                                                  <p class="btn btn-primary view-more mr-2" id="addToCart" onclick="handleCart('<?=$current_book->id?>','<?=$current_book->name?>','<?=$current_book->price?>','<?=$current_book->image?>')">أضف إلى السلة</p>
                                                  <a class="btn btn-primary view-more mr-2 mt--4" id="buyNow" style="margin-top: -17px !important;" href="<?=URLROOT.'pages/checkout'?>" onclick="buyNow('<?=$current_book->id?>','<?=$current_book->name?>','<?=$current_book->price?>','<?=$current_book->image?>')">اشتري الان</a>
                                                <?php else: ?>
                                                   <a href="<?=URLROOT.'users/library/'.$current_book->id?>" class="btn btn-primary view-more mr-2" >تابع القراءة</a>
                                                <?php endif; ?>
                                                </div>
                                              <div class="mb-3">
                                                  <a href="#" class="text-body text-center"><span class="avatar-30 rounded-circle bg-primary d-inline-block mr-2"><i class="ri-heart-fill"></i></span><span>اضافة الى المفضلة</span></a>
                                              </div>
                                              <div class="iq-social d-flex align-items-center">
                                                  <h5 class="mr-2">شارك:</h5>
                                                  <ul class="list-inline d-flex p-0 mb-0 align-items-center">
                                                      <li>
                                                          <a href="#" class="avatar-40 rounded-circle bg-primary mr-2 facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                      </li>
                                                      <li>
                                                          <a href="#" class="avatar-40 rounded-circle bg-primary mr-2 twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                      </li>
                                                      <li>
                                                          <a href="#" class="avatar-40 rounded-circle bg-primary mr-2 youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                                      </li>
                                                      <li >
                                                          <a href="#" class="avatar-40 rounded-circle bg-primary pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 trendy-detail">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">أقوى العروض</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <a href="<?=URLROOT.'pages/search'?>" class="btn btn-sm btn-primary view-more">عرض المزيد</a>
                           </div>
                        </div>
                        <div class="iq-card-body trendy-contens">
                           <ul id="trendy-slider" class="list-inline p-0 mb-0 row">
                              <?php foreach ($data['top_discount'] as $book): ?>
                              <?php $author = $this->user_model->read_by_id($book->author_id);?>
                              <?php
                                 $discount_percentage = intval(((($book->promo_price - $book->price) *  $book->promo_price) / 100)/10) * 10;
                              ?>
                              <li class="col-md-3">
                                 <div class="discount-container">
                                 <?=$discount_percentage ?>% خصم
                                 </div>
                                 <div class="d-flex align-items-center">
                                    <div class="col-5 p-0 position-relative image-overlap-shadow">
                                       <a href="javascript:void();"><img class="img-fluid rounded w-100" src="<?=URLROOT.'img/book/'.$book->image?>" alt=""></a>
                                       <div class="view-book">
                                          <a href="<?=URLROOT.'pages/book/'.$book->id?>" class="btn btn-sm btn-white">عرض الكتاب</a>
                                       </div>
                                    </div>
                                    <div class="col-7">
                                       <div class="mb-2">
                                          <h6 class="mb-1"><?=$book->name  ?></h6>
                                          <p class="font-size-13 line-height mb-1"><?=$author->fullname?></p>
                                          <div class="d-block">
                                             <span class="font-size-13 text-warning">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             </span>
                                          </div>
                                       </div>
                                       <div class="price d-flex align-items-center">
                                          <span class="pr-1 old-price">$<?=$book->promo_price?></span>
                                          <h6><b>$<?=$book->price?></b></h6>
                                       </div>
                                       <div class="iq-product-action">
                                          <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                          <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <?php endforeach ?>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 trendy-detail">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">قد يعجبك: <?=$current_book_categroy->name?></h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <a href="<?=URLROOT.'pages/search&category='.$current_book_categroy->id?>" class="btn btn-sm btn-primary view-more">عرض المزيد</a>
                           </div>
                        </div>
                        <div class="iq-card-body trendy-contens">
                           <ul id="single-similar-slider" class="list-inline p-0 mb-0 row">
                              <?php foreach ($data['related'] as $book): ?>
                              <?php $author = $this->user_model->read_by_id($book->author_id);?>
                              <li class="col-md-3">
                                 <div class="d-flex align-items-center">
                                    <div class="col-5 p-0 position-relative image-overlap-shadow">
                                       <a href="javascript:void();"><img class="img-fluid rounded w-100" src="<?=URLROOT.'img/book/'.$book->image?>" alt=""></a>
                                       <div class="view-book">
                                          <a href="<?=URLROOT.'pages/book/'.$book->id?>" class="btn btn-sm btn-white">التفاصيل</a>
                                       </div>
                                    </div>
                                    <div class="col-7">
                                       <div class="mb-2">
                                          <h6 class="mb-1"><?=$book->name  ?></h6>
                                          <p class="font-size-13 line-height mb-1"><?=$author->fullname?></p>
                                          <div class="d-block">
                                             <span class="font-size-13 text-warning">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             </span>
                                          </div>
                                       </div>
                                       <div class="price d-flex align-items-center">
                                          <span class="pr-1 old-price">$<?=$book->promo_price?></span>
                                          <h6><b>$<?=$book->price?></b></h6>
                                       </div>
                                       <div class="iq-product-action">
                                          <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                          <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <?php endforeach ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
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
                  Copyright 2020 <a href="<?=URLROOT?>"><?=SITENAME?></a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="<?=URLROOT.'assets/'?>js/jquery.min.js"></script>
      <script src="<?=URLROOT.'assets/'?>js/popper.min.js"></script>
      <script src="<?=URLROOT.'assets/'?>js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/waypoints.min.js"></script>
      <script src="<?=URLROOT.'assets/'?>js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/worldLow.js"></script>
      <!-- Style Customizer -->
      <script src="<?=URLROOT.'assets/'?>js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="<?=URLROOT.'assets/'?>js/custom.js"></script>
      <script src="<?=URLROOT?>js/main.js"></script>
      <script>
         var isDescVisible = false;
         $(document).ready(function(){
            
            toggleDescription();
            updateCartContent();
            updateAddToCart();

         

         });
         function updateAddToCart(){
            let cart = JSON.parse(localStorage.getItem('cart') || '[]')
            $("#addToCart").text('أضف إلى عربة التسوق');
            cart.map((cartItem) => {
               if(cartItem.id === '<?=$current_book->id?>'){
                  $("#addToCart").text('حذف من عربة التسوق');
                  return;
               }
            });
         }

         
         function toggleDescription(){
            var description = '<?=$current_book->description;?>'
            if(!isDescVisible){
               $("#description").empty();
               $(".read-more").html('أظهر المزيد');
               $("#description").append(ellipsify(description));
            } else {
               $("#description").empty();
               $(".read-more").html('أظهر اقل');
               $("#description").append(description);
            }
            isDescVisible = !isDescVisible;

         }
         function updateCheckoutProducts(){
            let cart = JSON.parse(localStorage.getItem("cart") || "[]");
            $("#checkoutProducts").empty()
            if(cart.length === 0){
               $("#checkoutProducts").append('<div class="cart-empty-container"> <p style="margin-top: 8%;">لا يوجد كتب في عربة تسوقك</p>  <a href="<?=URLROOT.'pages/search'?>" class="btn btn-primary mt-1">تصفح الكتب</a> </div>')
            }
            cart.forEach(element => {
              
               $("#checkoutProducts").append('<li class="checkout-product"> <div class="row align-items-center"> <div class="col-sm-2"> <span class="checkout-product-img"> <a href="javascript:void();"><img class="img-fluid rounded" src="<?=URLROOT?>img/book/'+element.image+'" alt=""></a> </span> </div> <div class="col-sm-4"> <div class="checkout-product-details"> <h5>'+element.title+'</h5> <p class="text-success">In stock</p> <div class="price"> <h5>$'+element.price+'</h5> </div> </div> </div> <div class="col-sm-6"> <div class="row"> <div class="col-sm-10"> <div class="row align-items-center mt-2">  <div class="col-sm-5 col-md-6"> <span class="product-price">$'+element.price+'</span> </div> </div> </div> <div class="col-sm-2"> <a href="javascript:void(0);" onclick="removeBook(\''+element.id+'\')" class="text-dark font-size-20"><i class="ri-delete-bin-7-fill"></i></a> </div> </div> </div> </div> </li>');
            });
         }

         function ellipsify (str) {
            if (str.length > 250) {
               return (str.substring(0, 250) + "...");
            }
            else {
               return str;
            }
         }
      </script>
   </body>
</html>