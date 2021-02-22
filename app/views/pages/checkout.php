

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
            <div class="container-fluid checkout-content">
               <div class="row">
                  <div id="cart" class="card-block show p-0 col-12">
                     <div class="row align-item-center">
                        <div class="col-lg-8">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between iq-border-bottom mb-0">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">عربة التسوق</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <ul class="list-inline p-0 m-0" id="checkoutProducts">
                                    
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="iq-card">
                              <div class="iq-card-body">
                                 <p>مراجعة الطلب</p>
                                 <div class="d-flex justify-content-between">
                                    <span>كوبون</span>
                                    <span><a href="#"><strong>اضف</strong></a></span>
                                 </div>
                                 <hr>
                                 <div class="d-flex justify-content-between mb-1">
                                    <span>المجموع الفرعي</span>
                                    <span id="subtotal">$829</span>
                                 </div>
                                 <div class="d-flex justify-content-between mb-1">
                                    <span>خصم الكوبون</span>
                                    <span class="text-success">$0-</span>
                                 </div>
                                 <!-- <div class="d-flex justify-content-between">
                                    <span>رسوم الشحن</span>
                                    <span class="text-success">مجانا</span>
                                 </div> -->
                                 <hr>
                                 <div class="d-flex justify-content-between">
                                    <span class="text-dark"><strong>المجموع الكلّي	</strong></span>
                                    <span class="text-dark"><strong id="total">$824</strong></span>
                                 </div>
                                 <a href="javascript:void();" id="btnCompleteOrder" data-toggle="modal" data-target="#placeorder" class="btn btn-primary d-block mt-3 " >اتمام عملية الشراء</a>
                              </div>
                           </div>
                           <div class="iq-card ">
                              <div class="card-body iq-card-body p-0 iq-checkout-policy">
                                 <ul class="p-0 m-0">
                                    <li class="d-flex align-items-center">
                                       <div class="iq-checkout-icon">
                                          <i class="ri-checkbox-line"></i>
                                       </div>
                                       <h6>سياسة الأمان (الدفع الآمن.)</h6>
                                    </li>
                                    <li class="d-flex align-items-center">
                                       <div class="iq-checkout-icon">
                                          <i class="ri-truck-line"></i>
                                       </div>
                                       <h6>سياسة التوصيل (التسليم الفوري)</h6>
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
         <!-- Page Content End  -->
      <!-- Wrapper END -->
      <?php if(!get_is_loggedin()): ?>
         <div class="modal fade" id="placeorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">اتمام عملية الشراء</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                  يجب تسجيل الدخول لإتمام عملية الشراء 
                  </div>
                  <div class="modal-footer">
                     <a href="<?=URLROOT.'auth/register&redirect=checkout'?>" type="button" class="btn btn-secondary">حساب جديد</a>
                     <a href="<?=URLROOT.'auth/login&redirect=pages/checkout'?>" type="button" class="btn btn-primary">تسجيل الدخول</a>
                  </div>
               </div>
            </div>
         </div>
      <?php else: ?>  
         <div class="modal fade" id="placeorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">اتمام عملية الشراء</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                  محاكاة الشراء
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                     <button type="button" id="confirmPayment" class="btn btn-primary">تأكيد</button>
                  </div>
               </div>
            </div>
         </div>
      <?php endif ?>    
                           
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
            updateCheckoutProducts();
            updateTotals();

            $("#confirmPayment").click(function(){

               let cart = JSON.parse(localStorage.getItem("cart") || "[]");   
               var data = {cart:cart,confirm:"confirm"};
               $.ajax({
                  url: "<?=URLROOT.'pages/checkout/'?>",
                  type: "post",
                  data: data ,
                  success: function (response) {

                     console.log(JSON.parse(response));
                     let jsonParsed =  JSON.parse(response)
                     if(jsonParsed.errors === 0){
                        window.open('<?=URLROOT?>users/library','_self');
                        clearCart();
                     } else {
                        alert('Ther was an error ' + jsonParsed.message);
                     }
                     
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                     console.log(textStatus, errorThrown);
                  }
               });
            });
         

         });

         function clearCart(){
            localStorage.setItem("cart", JSON.stringify([]));
         }

         function setBtnCompleteOrderDisable(val){
            $('#btnCompleteOrder').prop('disabled', val);
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



         function handleFavorite(book_id){
            var data = {add_favorite:'rr',book_id:book_id}
            $.ajax({
               url: "<?=URLROOT.'users/favorite/'?>",
               type: "post",
               data: data ,
               success: function (response) {
                  console.log(JSON.parse(response));
                  let jsonParsed =  JSON.parse(response)
                  if(jsonParsed.code === 200){
                     $("#heart_icon_" + book_id).removeClass("text-secondary");
                     $("#heart_icon_" + book_id).addClass("text-danger");
                  } else {
                     $("#heart_icon_" + book_id).addClass("text-secondary");
                     $("#heart_icon_" + book_id).removeClass("text-danger");
                  }
                  
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
               }
            });
         }
      
      
      </script>
   </body>
</html>