<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="iq-navbar-logo d-flex justify-content-between">
                    <a href="<?=URLROOT?>" class="header-logo">
                        <img src="<?=URLROOT.'assets/'?>images/logo.png" class="img-fluid rounded-normal" alt="" />
                        <div class="logo-title">
                            <span class="text-primary text-uppercase">Booksto</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="iq-search-bar">
                <form action="<?=URLROOT.'pages/search'?>" method="get" class="searchbox">
                    <input type="text" name="keyword" class="text search-input" placeholder="ما الذي تبحث عنه؟" />
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item nav-icon search-content">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-search-line"></i>
                        </a>
                        <form action="#" class="search-box p-0">
                            <input type="text" class="text search-input" placeholder="Type here to search..." />
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                        </form>
                    </li>
                    <!-- <li class="nav-item nav-icon">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-notification-2-fill"></i>
                            <span class="bg-primary dots"></span>
                        </a>
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">All Notifications<small class="badge badge-light float-right pt-1">4</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/01.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Emma Watson Barry</h6>
                                                <small class="float-right font-size-12">Just Now</small>
                                                <p class="mb-0">95 MB</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/02.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">New customer is join</h6>
                                                <small class="float-right font-size-12">5 days ago</small>
                                                <p class="mb-0">Cyst Barry</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/03.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Two customer is left</h6>
                                                <small class="float-right font-size-12">2 days ago</small>
                                                <p class="mb-0">Cyst Barry</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/04.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">New Mail from Fenny</h6>
                                                <small class="float-right font-size-12">3 days ago</small>
                                                <p class="mb-0">Cyst Barry</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item nav-icon dropdown">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span class="bg-primary count-mail"></span>
                        </a>
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">All Messages<small class="badge badge-light float-right pt-1">5</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="<?=URLROOT.'assets/'?>images/user/01.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Barry Emma Watson</h6>
                                                <small class="float-left font-size-12">13 Jun</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="<?=URLROOT.'assets/'?>images/user/02.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Lorem Ipsum Watson</h6>
                                                <small class="float-left font-size-12">20 Apr</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="<?=URLROOT.'assets/'?>images/user/03.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Why do we use it?</h6>
                                                <small class="float-left font-size-12">30 Jun</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="<?=URLROOT.'assets/'?>images/user/04.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Variations Passages</h6>
                                                <small class="float-left font-size-12">12 Sep</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="<?=URLROOT.'assets/'?>images/user/05.jpg" alt="" />
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Lorem Ipsum generators</h6>
                                                <small class="float-left font-size-12">5 Dec</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li> -->
                    <li class="nav-item nav-icon dropdown">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-shopping-cart-2-line"></i>
                            <span class="badge badge-danger count-cart rounded-circle" id="cartlength"></span>
                        </a>
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 toggle-cart-info">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">السلة<small class="badge badge-light float-right pt-1" id="cartlength"></small></h5>
                                    </div>
                                    <div id="cartItems">
                                       
                                    </div>
                                    <div class="d-flex align-items-center text-center p-3">
                                        <a id="btnCheckout" class="btn btn-primary mr-2 iq-sign-btn" href="<?=URLROOT?>pages/checkout" role="button">المتابعة الى الدفع</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php if(get_is_loggedin()): ?>
                        <li class="line-height pt-3">
                           
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                <img src="<?=URLROOT.'img/users/'.$data['user']->image?>" class="img-fluid rounded-circle mr-3" alt="user" />
                                <div class="caption">
                                    <h6 class="mb-1 line-height"><?=$data['user']->fullname ?></h6>
                                    <p class="mb-0 text-primary">$0.00</p>
                                </div>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height">مرحبا <?=explode(' ',trim($data['user']->fullname))[0]?></h5>
                                            <span class="text-white font-size-12">Available</span>
                                        </div>
                                        <a href="<?=URLROOT.'users/profile'?>" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">حسابي</h6>
                                                    <p class="mb-0 font-size-12">عرض تفاصيل الملف الشخصي.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="<?=URLROOT.'users/library'?>" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-profile-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">مكتبتي</h6>
                                                    <p class="mb-0 font-size-12">عرض الكتب المشتراة.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="<?=URLROOT.'users/favorite'?>" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-account-box-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">المفضلة</h6>
                                                    <p class="mb-0 font-size-12">عرض الكتب المفضلة</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <a class="bg-primary iq-sign-btn" href="<?=URLROOT.'auth/logout'?>" role="button">تسجيل خروج<i class="ri-logout-box-line ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php else: ?>    
                        <li class="line-height pt-3">
                            <div class="btn w-100 text-center p-2" style="font-size: 14px;">
                                <a class="bg-primary iq-sign-btn" href="<?=URLROOT.'auth/login'?>" role="button">دخول</a>
                            </div>
                        </li>
                        <li class="line-height pt-3">
                            <div class="btn w-100 text-center p-2" style="font-size: 14px;">
                                <a class="bg-primary iq-sign-btn" href="<?=URLROOT.'auth/register'?>" role="button">حساب جديد</a>
                            </div>
                        </li>
                    <?php endif ?>    
                </ul>
            </div>
        </nav>
    </div>
</div>
