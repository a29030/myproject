       <!-- topbar -->
   <div class="container-fluid top__bar--box">
            <div class="container">
                <div class="row top__bar">
                    <div class="col-md-4 top__bar-left">
                        <p class="top__bar-left--phone">
                            <span class="top__bar-left--text">
                                Hotline: 0927151535
                            </span>


                            <span style="margin-left: 10px;"> Email: Contact@web88.vn</span>

                        </p>

                    </div>
                    <div class="col-md-4 top__bar-middle">

                    </div>
                    <div class="col-md-4 top__bar-right">
                        <div class="top__bar-right--social">
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-instagram"></i></a>
                            <a href=""><i class="fa fa-twitter"></i></a>
                        </div>
                        <div class="top__bar-right--language">

                            <span>
                                <img src="fontend/assets/img/en.png" class="img-fluid img__language" alt="USA" />
                                English
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </div>
                        <div class="top__bar-right--language">

                            @if(Auth::check())
                                <a href="{{ route('userprofile', ['id'=>Auth::user()->id]) }}"> {{strtoupper(Auth::user()->username)}} </a>
                            @else
                                <a href="login">Login</a>
                            @endif

                        </div>
                        <div class="top__bar-right--language">
                            <a href="logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-main -->
        <div class="container header-main">
            <div class="row header-main">
                <!-- logo -->
                <div class="col-md-3 header__logo">
                    <a href="./" class="header__logo--link">
                        <img src="fontend/assets/img/90e338a0349acec4978b.jpg" class="img-fluid header__logo--img" alt="logo" />
                    </a>
                </div>
                <!-- box search -->
                <div class="col-md-6 header__search">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Danh mục sản phẩm <span class="caret"></span></button>
                        <ul class="dropdown-menu scrollable-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                        </ul>
                    </div>
                    <form action="{{ route('search')}}" method="get">
                        <div class="box__search">
                            <input type="text" name="q" class="import__search" placeholder="Bạn muốn tìm gì ?" />
                            <button type="submit" class="submit__search">
                                <i class="fa fa-search submit__search--icon"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 header__right">
                    <a href="{{ route('wishlist') }}" class="top-wishlist">
                        <i class="fa fa-heart header__right--icon"></i>

                        <span class="header__right--number1">
                            @if(!empty(session('wishlist')))
                                {{ session('wishlist') }}
                            @else
                                0
                            @endif
                        </span>
                    </a>
                    <a href="{{ route('getcart') }}" class="top-cart">
                        <i class="fa fa-shopping-cart header__right--icon"></i>
                        @if (!empty(session('countcart')))
                            <span id='countcart' class="header__right--number2">{{session('countcart')}}</span>
                        @else
                            <span id="countcart" class="header__right--number2">0</span>
                        @endif
                        <p class="top-cart--info">
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <!-- menu -->
        <div class="container-fluid main-menu">
            <!-- main menu -->
            <div class="container main-menu">
                <div class="row">
                    <ul class="top__menu col-md-9">
                        <li class="menu__item">
                            <a href="{{route('index')}}" class="menu__link menu__link--home"> Trang chủ</a>
                        </li>
                        <li class="menu__item">
                            <a href="{{route('shop')}}" class="menu__link"> Danh mục phần mềm </a>
                            <ul class="mega__menu">
                                <div class="row row__mega__menu">
                                    <div class="col-md-4 column__mega__menu">
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link mega__menu--title">
                                                Văn Phòng
                                            </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> Bartender </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> betterWMF </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> Codesoft </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> compareDWG </a>
                                        </li>
                                    </div>
                                    <div class="col-md-4 column__mega__menu mega__menu--title">
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link mega__menu--title">
                                                Bảo Mật
                                            </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> Burp Suite Interprise </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> HTTPCS Security </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> Intruder </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> Kaspersky Antivirus 1PC </a>
                                        </li>
                                    </div>
                                    <div class="col-md-4 column__mega__menu mega__menu--title">
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link mega__menu--title">
                                                Đồ họa
                                            </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> 2D PNG City Builder </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> 3D PNG City Builder </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> 3D Painting Tool </a>
                                        </li>
                                        <li class="mega__menu--item">
                                            <a href="" class="mega__menu--link"> 3Delight </a>
                                        </li>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <li class="menu__item">
                            <a href="{{route('blog')}}" class="menu__link"> Tin tức </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{route('policy')}}" class="menu__link"> Chính sách </a>
                            <ul class="sub__menu ">
                                <li class="sub__menu--link">
                                    <a href="" class="sub__menu--link">
                                        Bảo hành
                                    </a>
                                </li>
                                <li class="sub__menu--link">
                                    <a href="" class="sub__menu--link">
                                        Cài đặt
                                    </a>
                                </li>
                                <li class="sub__menu--link">
                                    <a href="" class="sub__menu--link">
                                        Nâng cấp
                                    </a>
                                </li>
                                <li class="sub__menu--link">
                                    <a href="" class="sub__menu--link">
                                        Gia hạn
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu__item">
                            <a href="{{route('contact')}}" class="menu__link"> Liên hệ </a>
                        </li>
                    </ul>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </div>

        <!-- responsive menu -->
        <div class="menu-mobile clearfix">
            <button class="openbtn" onclick="openNav()">☰</button>
            <div class="menu-mobile-img">
                <img src="fontend/assets/img/90e338a0349acec4978b.jpg">
            </div>
            <div class="menu-mobile-input">
                <button><i class="fa fa-search"></i></button>

                <button><i class="fa fa-shopping-cart"></i></button>
                <span class="shop-span">10</span>
            </div>
        </div>

        <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="#">Trang chủ</a>
            <button class="dropdown-btn">Danh mục
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Phần mềm 1</a>
                <a href="#">Phần mềm 2</a>
                <a href="#">Phần mềm 3</a>
            </div>
            <a href="#">Tin tức</a>

            <button class="dropdown-btn">Chính sách
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Bảo hành</a>
                <a href="#">Cài đặt</a>
                <a href="#">Nâng cấp</a>
                <a href="#">Gia hạn</a>
            </div>
            <a href="#">Liên hệ</a>
            <button class="dropdown-btn">Ngôn Ngữ
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Vie</a>
                <a href="#">Eng</a>
            </div>
        </div>
