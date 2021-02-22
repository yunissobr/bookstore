
<?php
 $default_books = $data['default_books'];
 $current_user = $data['user'];
 $categories = $data['categories'];
 $authors = $data['authors'];

 $category_id = isset($_GET['category']) ? $_GET['category'] : '';
 $author_id = isset($_GET['author']) ? $_GET['author'] : '';
 $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

?>
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
                  <div class="col-lg-12">
                     <div class="iq-card-transparent mb-0">
                        <div class="d-block text-center">
                           <h2 class="mb-3"> ابحث عن اي كتاب</h2>    
                           <div class="w-100 iq-search-filter">
                              <ul class="list-inline p-0 m-0 row justify-content-center search-menu-options">
                                 <li class="search-menu-opt">
                                    <div class="iq-dropdown">
                                       <div class="form-group mb-0">
                                          <select class="form-control form-search-control bg-white border-0" id="category_op" onchange="updateCategory()" name="category">
                                             <option selected="" value="">الصنف</option>
                                             <?php foreach ($categories as $category):?>
                                                <option value="<?=$category->id?>" <?=($category->id == $category_id) ? 'selected=""' : ''?>><?=$category->name?></option>
                                             <?php endforeach ?>
                                          </select>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="search-menu-opt">
                                    <div class="iq-dropdown">
                                       <div class="form-group mb-0">
                                          <select class="form-control form-search-control bg-white border-0" id="author_op" onchange="updateAuthor()" name="author">
                                             <option selected="" value="">المؤلف</option>
                                             <?php foreach ($authors as $author):?>
                                                <option value="<?=$author->id?>" <?=($category->id == $category_id) ? 'selected=""' : ''?>> <?=$author->fullname?> </option>
                                             <?php endforeach ?>
                                          </select>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="search-menu-opt">
                                    <div class="iq-search-bar search-book d-flex align-items-center">
                                         <div class="searchbox">
                                          <input type="text" id="keyword" class="text search-input" placeholder="كلمة مفتاحية" value="<?=$keyword?>">
                                          <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                         </div>
                                         <button type="submit" onclick="updateKeyword()" class="btn btn-primary search-data ml-2">بحث</button>
                                     </div>
                                 </li>
                              </ul>
                           </div> 
                        </div>
                     </div>
                     <div class="iq-card">
                        <div class="iq-card-body b-dashed" id="booksContainer">
                            
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
        var author_id = '';
        var category_id = '';
        var keyword = '';
       $(document).ready(function(){
         updateCartContent();
         loadBooks();
          
      

       });
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

       var htmlLoading = '<div class="loader">Loading...</div>';
       var booksContainer = document.getElementById('booksContainer');

       function loadDefault(){
          console.log('loading');
          $('#booksContainer').empty();
          $('#booksContainer').append(htmlLoading);
          var data = {
             search: 'default',
             author_id: '',
             category_id: '',
             keyword: '',
          }
          console.log(data);
          $.ajax({
             url: "<?=URLROOT.'pages/search/'?>",
             type: "post",
             data: data ,
             success: function (response) {
                $('#booksContainer').empty();
                $('#booksContainer').append(response);
             },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
          });
       }  
       function loadBooks(){
          $('#booksContainer').empty();
          $('#booksContainer').append(htmlLoading);
          var data = {
             search: 'default',
             author_id: author_id,
             category_id: category_id,
             keyword: keyword,
          }
          // console.log(data);
          $.ajax({
             url: "<?=URLROOT.'pages/search/'?>",
             type: "post",
             data: data ,
             success: function (response) {
              // console.log(response);
                $('#booksContainer').empty();
                $('#booksContainer').append(response);
             },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
          });
       }  

       function updateCategory(){
         category_id = document.getElementById('category_op').value
         loadBooks();
       }
       function updateAuthor(){
         author_id = document.getElementById('author_op').value
         loadBooks();
       }
       function updateKeyword(){
         keyword = document.getElementById('keyword').value
         loadBooks();
       }

       function insertParam(key, value) {
           key = encodeURIComponent(key);
           value = encodeURIComponent(value);

           // kvp looks like ['key1=value1', 'key2=value2', ...]
           var kvp = document.location.search.substr(1).split('&');
           let i=0;

           for(; i<kvp.length; i++){
               if (kvp[i].startsWith(key + '=')) {
                   let pair = kvp[i].split('=');
                   pair[1] = value;
                   kvp[i] = pair.join('=');
                   break;
               }
           }

           if(i >= kvp.length){
               kvp[kvp.length] = [key,value].join('=');
           }

           // can return this or...
           let params = kvp.join('&');

           // reload page with new params
           document.location.search = params;
       }
       function handleFavorite(book_id){
            var data = {add_favorite:'rr',book_id:book_id}
            $.ajax({
               url: "<?=URLROOT.'users/favorite/'?>",
               type: "post",
               data: data ,
               success: function (response) {
                  try {
                     let jsonParsed =  JSON.parse(response)
                     if(jsonParsed.code === 200){
                        $("#heart_icon_" + book_id).removeClass("text-secondary");
                        $("#heart_icon_" + book_id).addClass("text-danger");
                     } else {
                        $("#heart_icon_" + book_id).addClass("text-secondary");
                        $("#heart_icon_" + book_id).removeClass("text-danger");
                     }
                  } catch (error) {
                     
                     alert('الرجاء تسجيل الدخول');
                  };
                  
                  
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
               }
            });
         }
      </script>
   </body>
</html>