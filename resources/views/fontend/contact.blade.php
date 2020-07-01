@extends('fontend.base')
@section('content')
<div class="container-fluid">
    <div class="container ">
        <div class="row contact mt-20">
            <div class="col-md-6 contact__info">
                <ul class="contact__info">
                    <li class="contact__info--phone">
                        <span class="contact__info--head">
                            Số điện thoại:
                        </span>
                        <br>
                        0108134425
                    </li>
                    <li class="contact__info--email">
                        <span class="contact__info--head">
                            Email:
                        </span>
                        <br>
                        contact@web88.vn
                    </li>
                    <li class="contact__info--address">

                        <span class="contact__info--head">
                            Địa chỉ:
                        </span>
                        <br>
                        CT2 Constrexim Thái Hà, Phạm Văn Đồng, Bắc Từ Liêm, Hà Nội
                    </li>
                    <li class="flow-us">
                        <span class="contact__info--head">
                            Theo dõi chúng tôi
                        </span>
                        <a href="" class="flow-us--link">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="" class="flow-us--link">
                            <i class="fa fa-instagram"></i>
                        </a>
                        <a href="" class="flow-us--link">
                            <i class="fa fa-twitter-square"></i>
                        </a>

                    </li>
                </ul>
            </div>
            <div class="col-md-6 contact__map">
                <div class="contact__map__box">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.8580470817415!2d105.78534501533268!3d21.078331091459138!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aacbe6b051d3%3A0x99154d3da13e19eb!2zNDMgUGjhuqFtIFbEg24gxJDhu5NuZywgWHXDom4gxJDhu4luaCwgVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1588995713143!5m2!1svi!2s"
                        width="" height="" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
        <!-- contact form -->
        <div class="row contact__form mt-20 mb-80">
            <div class="col-md-12">
                <h3 class="contact__heading">
                    <span class="title">
                        Liên hệ
                    </span>
                    <span class="subtitle">
                        Địa chỉ email của bạn sẽ không được công bố.
                    </span>
                </h3>
            </div>
            <div class="col-md-12">
                <form action="{{ route('contact') }}" method="post" class="contact__form">
                    @csrf
                    <div class="box__info">
                        <div class="box__info--item">
                            <p class="box__info--text">
                                Họ và tên <span class="star">*</span>:
                            </p>
                            <input type="text" name="fullname" id="" class="box__info--input">
                        </div>
                        <div class="box__info--item">
                            <p class="box__info--text">
                                Email<span class="star">*</span>:
                            </p>
                            <input type="text" name="email" id="" class="box__info--input">
                        </div>
                        <div class="box__info--item">
                            <p class="box__info--text">
                                Số điện thoại<span class="star">*</span>:
                            </p>
                            <input type="text" name="phone" id="" class="box__info--input">
                        </div>
                    </div>
                    <div class="box__mesager">
                        <p class="box__info--text">
                            Nội dung <span class="star">*</span>:
                        </p>
                        <textarea name="content" id="" cols="40" rows="10" class="box__mesager--detail"></textarea>
                        <input type="submit" value="Gửi" class="box__mesager-btn">
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
@endsection