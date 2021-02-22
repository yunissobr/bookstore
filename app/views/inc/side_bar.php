<div class="iq-sidebar">
   <div class="iq-sidebar-logo d-flex justify-content-between">
      <a href="index.html" class="header-logo">
         <img src="<?=URLROOT.'assets/'?>images/logo.png" class="img-fluid rounded-normal" alt="">
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
   <div id="sidebar-scrollbar">
      <nav class="iq-sidebar-menu">
         <ul id="iq-sidebar-toggle" class="iq-menu">
            <li <?=$data['title'] == 'dashboard' ? 'class="active active-menu"' : ''?>>
               <a href="<?=URLROOT.'admin'?>" class="iq-waves-effect">
                  <span class="ripple rippleEffect"></span>
                  <i class="las la-home iq-arrow-left"></i>
                  <span>لوحة التحكم</span>
               </a>
            </li>
            <li <?=$data['title'] == 'books' ? 'class="active active-menu"' : ''?>>
               <a href="<?=URLROOT.'admin/book/all'?>" class="iq-waves-effect">
                  <span class="ripple rippleEffect"></span>
                  <i class="ri-book-2-line"></i>
                  <span>الكتب</span>
               </a>
            </li>
            <li <?=$data['title'] == 'categories' ? 'class="active active-menu"' : ''?>>
               <a href="<?=URLROOT.'admin/category/all'?>" class="iq-waves-effect">
                  <span class="ripple rippleEffect"></span>
                  <i class="ri-function-line"></i>
                  <span>الاصناف</span>
               </a>
            </li>
            <li <?=$data['title'] == 'authors' ? 'class="active active-menu"' : ''?>>
               <a href="<?=URLROOT.'admin/author/all'?>" class="iq-waves-effect">
                  <span class="ripple rippleEffect"></span>
                  <i class="ri-file-user-line"></i>
                  <span>المؤلفون</span>
               </a>
            </li>
            
         </ul>
      </nav>
      <!-- <div id="sidebar-bottom" class="p-3 position-relative">
         <div class="iq-card">
            <div class="iq-card-body">
               <div class="sidebarbottom-content">
                  <div class="image"><img src="<?=URLROOT.'assets/'?>images/page-img/side-bkg.png" alt=""></div>
                  <button type="submit" class="btn w-100 btn-primary mt-4 view-more">Become Membership</button>
               </div>
            </div>
         </div>
      </div> -->
   </div>
</div>