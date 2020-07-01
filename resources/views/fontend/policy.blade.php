@extends('fontend.base')
@section('content')
<!-- content web -->
<div class="container-fluid">
    <div class="container">
        <div class="row mt-20">
            <!-- left layout -->
            <div class="col-md-4 sidebar left-layout">
                <h1 class="sidebar__headding headding__policy">
                    Chính sách của chúng tôi
                </h1>
                <div class="search-blog--box">
                    <input type="search" name="" id="" class="form__search" placeholder="Bạn muốn tìm gì ... ?">
                    <button type="submit" class="btn--blog">
                        <i class="fa fa-search btn--blog--icon"></i>
                    </button>
                </div>
                <h3 class="sidebar__title pt-20">
                    Danh mục chính sách
                </h3>
                <ul class="ct__blog--box">
                    <li class="ct__blog--item">
                        <a href="" class="ct__blog--link">
                            Bảo hành
                        </a>
                    </li>
                    <li class="ct__blog--item">
                        <a href="" class="ct__blog--link">
                            Cài đặt
                        </a>
                    </li>
                    <li class="ct__blog--item">
                        <a href="" class="ct__blog--link">
                            Nâng cấp
                        </a>
                    </li>
                    <li class="ct__blog--item">
                        <a href="" class="ct__blog--link">
                            Gia hạn
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right layout -->
            <div class="col-md-8 article right-layout">
                <div class="blog__box">
                    <img src="fontend/assets/img/blog-01-570x330.jpeg" class="img-fluid blog__img" alt="">
                    <div class="entry-category">
                        <a href="" class="btn-entry">
                            Bảo hành
                        </a>
                        <a href="" class="btn-entry">
                            Cài đặt
                        </a>
                    </div>
                    <h3 class="entry-title">
                        demo title policy
                    </h3>
                    <ul class="entry-meta-list">
                        <li class="entry-date">
                            <a href="" class="entry-icon">
                                <img src="fontend/assets/img/icon-calender.png" class="entry-img" alt="">

                            </a>
                            10/05/2020
                        </li>
                        <li class="entry-cmt">
                            <a href="" class="entry-icon">
                                <img src="fontend/assets/img/commetn-calender.png" class="entry-img" alt="">
                            </a>
                            2
                        </li>
                    </ul>
                    <p class="entry-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                    <a href="" class="btn entry-readmore">
                        Đọc tiếp
                    </a>
                </div>
                <div class="blog__box mt-5">
                    <img src="fontend/assets/img/blog-01-570x330.jpeg" class="img-fluid blog__img" alt="">
                    <div class="entry-category">
                        <a href="" class="btn-entry">
                            Bảo hành
                        </a>
                        <a href="" class="btn-entry">
                            Cài đặt
                        </a>
                    </div>
                    <h3 class="entry-title">
                        demo title policy
                    </h3>
                    <ul class="entry-meta-list">
                        <li class="entry-date">
                            <a href="" class="entry-icon">
                                <img src="fontend/assets/img/icon-calender.png" class="entry-img" alt="">

                            </a>
                            10/05/2020
                        </li>
                        <li class="entry-cmt">
                            <a href="" class="entry-icon">
                                <img src="fontend/assets/img/commetn-calender.png" class="entry-img" alt="">
                            </a>
                            2
                        </li>
                    </ul>
                    <p class="entry-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                    <a href="" class="btn entry-readmore">
                        Đọc tiếp
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection