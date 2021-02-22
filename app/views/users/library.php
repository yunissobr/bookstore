
<?php
 $user_books = $data['user_books'];
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
                           <h2 class="mb-3"> مكتبة <?=explode(" ",$current_user->fullname)[0]?></h2>    
                           <div class="w-100 iq-search-filter">
                              <ul class="list-inline p-0 m-0 row justify-content-center search-menu-options">
                                 <li class="search-menu-opt">
                                    <div class="iq-dropdown">
                                       <div class="form-group mb-0">
                                          <select class="form-control form-search-control bg-white border-0" id="category_op" onchange="updateCategory()" name="category">
                                             <option selected="" disabled>الصنف</option>
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
                                             <option selected="" disabled>المؤلف</option>
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
                        <div class="iq-card-body b-dashed">
                           <?php if(!empty($user_books)): ?>
                              <ul  class="list-inline p-0 mb-0 row">
                              <?php foreach ($user_books as $user_book): ?>
                                    <?php $book = $user_book->details; 
                                          $author = $this->user_model->read_by_id($book->author_id);
                                    ?>
                                    <li class="col-md-4 mb-3">
                                       <div class="d-flex align-items-center">
                                          <div class="col-5 p-0 position-relative">
                                             <a href="javascript:void();">
                                                <img src="<?=URLROOT.'img/book/'.$book->image?>" class="img-fluid rounded w-100" alt="">
                                             </a>                                
                                          </div>
                                          <div class="col-7">
                                             <h5 class="mb-2"><?=$book->name?></h5>
                                             <p class="mb-2">المؤلف : <?=$author->fullname?></p>                                          
                                             <div class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                                <span>قراءة</span>
                                                <?php $percent = rand(33,100); ?>
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
                           <?php else: ?>
                            <div class="no-book-container">
                               <div class="img-empty-icon">
                               <svg xmlns="http://www.w3.org/2000/svg" width="117px"  viewBox="0 0 480.012 480">
                                  <g id="book" transform="translate(0 -0.004)">
                                    <path id="Path_1" data-name="Path 1" d="M128,104V72a8,8,0,0,0-8-8H8a8,8,0,0,0-8,8v32Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_2" data-name="Path 2" d="M0,120V384H128V120ZM96,224H32a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8H96a8,8,0,0,1,8,8v64A8,8,0,0,1,96,224Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_3" data-name="Path 3" d="M0,432v40a8,8,0,0,0,8,8H120a8,8,0,0,0,8-8V432Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_4" data-name="Path 4" d="M0,400H128v16H0Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_5" data-name="Path 5" d="M144,400H248v16H144Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_6" data-name="Path 6" d="M248,32V8a8,8,0,0,0-8-8H152a8,8,0,0,0-8,8V32Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_7" data-name="Path 7" d="M144,88H248V384H144Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_8" data-name="Path 8" d="M144,432v40a8,8,0,0,0,8,8h88a8,8,0,0,0,8-8V432Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_9" data-name="Path 9" d="M144,48H248V72H144Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_10" data-name="Path 10" d="M263.809,165.668,268.09,182.1l135.484-36.129-4.285-16.434Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_11" data-name="Path 11" d="M330.664,421.949l135.48-36.129-8.578-32.887L322.078,389.063Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_12" data-name="Path 12" d="M453.527,337.453l-45.91-176L272.129,197.582l45.91,176Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_13" data-name="Path 13" d="M259.77,150.188l135.477-36.125L383.762,70a8.181,8.181,0,0,0-9.84-5.758l-120,32A8.059,8.059,0,0,0,248.238,106Zm0,0" fill="#b7c5d2"/>
                                    <path id="Path_14" data-name="Path 14" d="M470.184,401.3,334.7,437.43,344.238,474A8.026,8.026,0,0,0,348,478.887,7.725,7.725,0,0,0,352,480a9.292,9.292,0,0,0,2.078-.238l120-32A8.063,8.063,0,0,0,479.762,438Zm0,0" fill="#b7c5d2"/>
                                  </g>
                                </svg>

                               </div>
                               <div class="action">
                                <p class="p-light">لا توجد كتب في مكتبتك</p>
                                <a href="<?=URLROOT.'pages/'?>"><button class="btn btn-primary">تصفح الكتب</button></a>
                               </div>
                            </div>
                           <?php endif ?>   
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

         $(document).ready(function(){
            
            updateCartContent();
         

         });
      </script>
      <script>

       function updateCategory(){
         var category = document.getElementById('category_op').value
         insertParam('category',category);
       }
       function updateAuthor(){
         var author = document.getElementById('author_op').value
         insertParam('author',author);
       }
       function updateKeyword(){
         var keyword = document.getElementById('keyword').value
         insertParam('keyword',keyword);
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
      </script>
   </body>
</html>