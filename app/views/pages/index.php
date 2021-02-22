

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
      <link rel="stylesheet" href="<?=URLROOT ?>/css/style.css">
   </head>
   <body class="sidebar-main-active right-column-fixed sidebar-main">
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <!-- <div class="iq-sidebar">
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
         </div> -->
         <!-- TOP Nav Bar -->
         <?php require APPROOT . '/views/inc/top_nav.php'; ?>
        <!-- TOP Nav Bar END -->
         
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height rounded">
                        <div class="newrealease-contens">
                           <ul id="newrealease-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                              <?php foreach ($data['new_releases'] as $new_releases_book) : ?>
                                 <li class="item">
                                    <a href="javascript:void(0);">
                                       <img src="<?=URLROOT.'img/book/'.$new_releases_book->image?>" class="img-fluid w-100 rounded" alt="">
                                    </a>
                                 </li>
                              <?php endforeach ?>   
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">تصفح الكتب</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">                              
                              <a href="<?=URLROOT.'pages/search'?>" class="btn btn-sm btn-primary view-more">عرض المزيد</a>
                           </div>
                        </div> 
                        <div class="iq-card-body">  
                           <div class="row">
                              <?php foreach ($data['browse'] as $browse_book): ?>
                                 <?php
                                    $author = $this->user_model->read_by_id($browse_book->author_id);
                                    if(get_is_loggedin()){
                                       $favorite = [
                                          'user_id' => get_current_user_id(),
                                          'book_id' => $browse_book->id
                                       ];
                                       $rowFav = $this->book_model->read_favorite_by_user_id_and_book_id($favorite);
                                       if($rowFav){
                                          $class = 'danger';
                                       } else {
                                          $class = 'secondary';
                                       }
                                    } else {
                                       $class = 'secondary';
                                    }
                                 ?>
                                 <?php if(!$this->is_user_have_book($browse_book->id)): ?>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                       <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                          <div class="iq-card-body p-0">
                                             <div class="d-flex align-items-center">
                                                <div class="col-6 p-0 position-relative image-overlap-shadow">
                                                   <a href="javascript:void();"><img class="img-fluid rounded w-100" src="<?=URLROOT.'img/book/'.$browse_book->image?>" alt=""></a>
                                                   <div class="view-book">
                                                      <a href="<?=URLROOT.'pages/book/'.$browse_book->id?>" class="btn btn-sm btn-white">تفاصيل</a>
                                                   </div>
                                                </div>
                                                <div class="col-6">
                                                   <div class="mb-2">
                                                      <h6 class="mb-1"><?=$browse_book->name?></h6>
                                                      <p class="font-size-13 line-height mb-1"><?=$author->fullname?></p>
                                                      <div class="d-block line-height">
                                                         <span class="font-size-11 text-warning">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                         </span>                                             
                                                      </div>
                                                   </div>
                                                   <div class="price d-flex align-items-center">
                                                      <span class="pr-1 old-price">$<?=$browse_book->promo_price?></span>
                                                      <h6><b>$<?=$browse_book->price?></b></h6>
                                                   </div>
                                                   <div class="iq-product-action">
                                                      <a href="javascript:void(0);" onclick="handleCart('<?=$browse_book->id?>','<?=$browse_book->name?>','<?=$browse_book->price?>','<?=$browse_book->image?>')"><i id="shopping_cart_icon<?=$browse_book->id?>" class="ri-shopping-cart-2-fill text-secondary"></i></a>
                                                      <a href="javascript:void(0);" onclick="handleFavorite('<?=$browse_book->id?>')" class="ml-2"><i id="heart_icon_<?=$browse_book->id?>" class="ri-heart-fill text-<?=$class?>"></i></a>
                                                   </div>                                      
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 <?php endif ?>   
                              <?php endforeach ?>   
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between mb-0">
                           <div class="iq-header-title">
                              <h4 class="card-title">اخترنا لك</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="row align-items-center">
                              <div class="col-sm-5 pr-0">
                                 <a href="javascript:void();"><img class="img-fluid rounded w-100" src="<?=URLROOT.'img/book/'.$data['featured_book']->image?>" alt=""></a>
                              </div>
                              <div class="col-sm-7 mt-3 mt-sm-0">
                                 <h4 class="mb-2"><?=$data['featured_book']->name?></h4>
                                 <p class="mb-2">المؤلف: <?=$this->user_model->read_by_id($data['featured_book']->author_id)->fullname?></p>
                                 <div class="mb-2 d-block">
                                    <span class="font-size-12 text-warning">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                    </span>
                                 </div>
                                 <div class="desc-container">
                                    <span class="text-dark mb-3 d-block text-small"><?=substr($data['featured_book']->description,0,250 + rand(10,20)).'...'?></span>
                                 </div>
                                 <a href="<?=URLROOT.'pages/book/'.$data['featured_book']->id?>" class="btn btn-primary learn-more">تفاصيل</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between mb-0">
                           <div class="iq-header-title">
                              <h4 class="card-title">أفضل المؤلفين</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                             
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul class="list-inline row mb-0 align-items-center iq-scrollable-block">
                              <?php foreach ($data['best_authors'] as $author) : ?>
                                 <li class="col-sm-6 d-flex mb-3 align-items-center">
                                    <div class="icon iq-icon-box mr-3">
                                       <a href="javascript:void();"><img class="img-fluid avatar-60 rounded-circle" src="<?=URLROOT.'img/author/'.$author->image?>" alt=""></a>
                                    </div>
                                    <div class="mt-1">
                                       <h6><?=$author->fullname ?></h6>
                                       <p class="mb-0 text-primary">عدد الكتب: <span class="text-body"><?=$author->total_books ?></span></p>
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
                        <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">مكتبتك</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <a href="<?=URLROOT.'users/library'?>" class="btn btn-sm btn-primary view-more"><?php echo((!get_is_loggedin() ? 'تسجيل الدخول' : 'اظهار الكل')) ?></a>
                           </div>
                        </div>     
                        <?php if(get_is_loggedin()): ?>                    
                           <div class="iq-card-body favorites-contens">
                              <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                                 <?php foreach ($data['user_lib'] as $user_book): ?>
                                 <?php
                                    $book = $user_book->details;
                                    $author = $this->user_model->read_by_id($book->author_id);?>
                                    <li class="col-md-4">
                                       <div class="d-flex align-items-center">
                                          <div class="col-5 p-0 position-relative">
                                             <a href="javascript:void();">
                                                <img src="<?=URLROOT.'img/book/'.$book->image?>" class="img-fluid rounded w-100" alt="">
                                             </a>                                
                                          </div>
                                          <div class="col-7">
                                             <h5 class="mb-2"><?=$book->name?></h5>
                                             <p class="mb-2">المؤلف : <?=$author->fullname?><p>                                          
                                             <div class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                                <span>قراءة</span>
                                                <?php $percent = rand(0,100); ?>
                                                <span class="mr-4"><?=$percent?>%</span>
                                             </div>
                                             <div class="iq-progress-bar-linear d-inline-block w-100">
                                                <div class="iq-progress-bar iq-bg-primary">
                                                   <span class="bg-<?php echo($percent > 70? 'danger' : 'primary') ?>" data-percent="<?=$percent?>"></span>
                                                </div>
                                             </div>
                                             <a href="<?=URLROOT.'users/library/'.$book->id?>" class="text-dark">اكمل القراءة<i class="ri-arrow-left-s-line"></i></a>
                                          </div>
                                       </div>
                                    </li>
                                 <?php endforeach ?>
                              </ul>
                           </div>
                        <?php endif ?>
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
         $(document).ready(function(){
            
            updateCartContent();
         

         });

         function handleFavorite(book_id) {
            console.log('hey')
            var data = { add_favorite: 'rr', book_id: book_id }
            $.ajax({
               url: "<?=URLROOT.'users/favorite/'?>",
               type: 'post',
               data: data,
               success: function (response) {
                  try {
                     console.log(JSON.parse(response))
                     let jsonParsed = JSON.parse(response)
                     if (jsonParsed.code === 200) {
                     $('#heart_icon_' + book_id).removeClass('text-secondary')
                     $('#heart_icon_' + book_id).addClass('text-danger')
                     } else {
                     $('#heart_icon_' + book_id).addClass('text-secondary')
                     $('#heart_icon_' + book_id).removeClass('text-danger')
                     }
                  } catch (error) {
                     alert('الرجاء تسجيل الدخول');
                  }
                 
               },
               error: function (jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown)
               },
            })
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
      
      
      </script>
   </body>
</html>