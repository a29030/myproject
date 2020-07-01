@extends('fontend.base')
@section('content')
        <!-- mega slide -->
        <div class="container-fluid mega__slide">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11">
                    <div id="carouselExampleControls" class="carousel slide mega__slide__box" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="slide__text">
                                    <p class="slide__text--top">
                                        Meet The Celebrities
                                    </p>
                                    <h3 class="slide__text--title">
                                        Kitchenware, Table Lamp and Black Goji
                                    </h3>
                                    <p class="slide__text--price">
                                        Only from
                                        <span class="slide__text--price--dolar">$19. <sup>99</sup></span>
                                    </p>
                                    <a href="shop" class="btn slide__text--btn">
                                        Shop Now >
                                    </a>
                                </div>
                                <img src="fontend/assets/img/image-slider-011.png" class="d-block" alt="..." />
                            </div>
                            <div class="carousel-item">
                                <div class="slide__text">
                                    <p class="slide__text--top">
                                        Meet The Celebrities
                                    </p>
                                    <h3 class="slide__text--title">
                                        Kitchenware, Table Lamp and Black Goji
                                    </h3>
                                    <p class="slide__text--price">
                                        Only from
                                        <span class="slide__text--price--dolar">$19. <sup>99</sup></span>
                                    </p>
                                    <a href="shop" class="btn slide__text--btn">
                                        Shop Now >
                                    </a>
                                </div>
                                <img src="fontend/assets/img/image-slider-021.png" class="d-block" alt="..." />
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next next-img" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner grid -->
        <div class="container">
            <div class="banner__grid row">
                <div class="banner__grid--item col-md-3 col-6">
                    <div class="banner__item--icon">
                        <i class="fa fa-truck banner--icon"></i>
                    </div>
                    <div class="banner__box--text">
                        <h3 class="banner__text--title">
                            ispem ispem ispem
                        </h3>
                        <p class="banner__text--detail">
                            Free
                        </p>
                    </div>
                </div>
                <div class="banner__grid--item col-md-3 col-6">
                    <div class="banner__item--icon">
                        <i class="fa fa-truck banner--icon"></i>
                    </div>
                    <div class="banner__box--text">
                        <h3 class="banner__text--title">
                            ispem ispem ispem
                        </h3>
                        <p class="banner__text--detail">
                            Free
                        </p>
                    </div>
                </div>
                <div class="banner__grid--item col-md-3 col-6">
                    <div class="banner__item--icon">
                        <i class="fa fa-truck banner--icon"></i>
                    </div>
                    <div class="banner__box--text">
                        <h3 class="banner__text--title">
                            ispem ispem ispem
                        </h3>
                        <p class="banner__text--detail">
                            Free
                        </p>
                    </div>
                </div>
                <div class="banner__grid--item col-md-3 col-6">
                    <div class="banner__item--icon">
                        <i class="fa fa-truck banner--icon"></i>
                    </div>
                    <div class="banner__box--text">
                        <h3 class="banner__text--title">
                            ispem ispem ispem
                        </h3>
                        <p class="banner__text--detail">
                            Free
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner column -->
        <div class="container">
            <div class="row banner__column">
                <div class="col-md-4 banner__column-item">
                    <a href="" class="banner__column-item--link">
                        <img src="fontend/assets/img/banner-01.jpg" class="img-fluid banner__column-item--img" alt="banner product" />
                    </a>
                </div>
                <div class="col-md-4 banner__column-item">
                    <a href="" class="banner__column-item--link">
                        <img src="fontend/assets/img/banner-02.jpg" class="img-fluid banner__column-item--img" alt="banner product" />
                    </a>
                </div>
                <div class="col-md-4 banner__column-item">
                    <a href="" class="banner__column-item--link">
                        <img src="fontend/assets/img/banner-03.jpg" class="img-fluid banner__column-item--img" alt="banner product" />
                    </a>
                </div>
            </div>
        </div>
        <!-- custom view category -->
        <div class="container ctvc mt-5">
            <h3 class="ctvc__title">
                Danh mục sản phẩm
            </h3>
           <div class="row ctvc__border">
               @foreach($DProduct as $value)
                <div class="col-md-2 col-6 col-sm-4 ctvc__item">

                    <img src="{{$value -> link_image}}" class="img-fluid ctvc__img" alt="">
                    <div class="ctvc__item-content">
                        <a href="{{ route('ctsp', ['id'=>$value->id]) }}">
                            {{$value -> product_name}}
                        </a>
                        <span>{{$value->quantity-$value->sold}} item</span>
                    </div>

                </div>
               @endforeach
                <div class="ctvc__item-content text-center mb-5" style="width: 100%">
                    <a href="{{ route('shop') }}">Show More <i class="fa fa-chevron-right"></i></a>
                </div>
           </div>
        </div>
        <!-- ctvp -->
        @for ($i = 0; $i < $quantityCategory; $i++)
            <div class="container ctvp">
                <a style="color: black" href="{{ route('getproductwithcategory', ['slug_name'=>$listNameCategory[$i]->slug_name]) }}">
                    <h3 class="ctvp__title">
                        {{$listNameCategory[$i]->category_name}}
                    </h3>
                </a>
                <div class="ctvp__box">
                    <div class="carousel-inner ctvp__box__slide">
                        <div class="carousel-item active">
                            <div class=" row__item__product">
                                <!-- item product -->
                                @foreach ($list[$i] as $item)
                                    <div id="listproductwithcategory" class=" item__product">
                                        <span class="onsale">
                                            @if ($item->sale_percent>0)
                                                <span class="saled">
                                                    -{{$item->sale_percent}}%
                                                </span>
                                                <br />
                                            @endif
                                            <span class="featured">
                                                Hot
                                            </span>
                                        </span>
                                        <!-- group button on hover -->
                                        <div class="group-button">
                                            <button onclick="return addcart(this);" id="{{$item->id}}" value="{{$item->id}}" style="color: black">
                                                <div class="add-cart">
                                                    <i class="fa fa-cart-plus group-button--icon"></i>
                                                </div>
                                            </button>
                                            <a style="color: black" href="{{ route('addwishlist', ['id'=>$item->id]) }}">
                                                <div class="btn-wishliss">
                                                    <i  class="fa fa-heart group-button--icon"></i>
                                                </div>
                                            </a>  
                                            <a style="color: black" href="{{ route('ctsp', ['id'=>$item->id]) }}">
                                                <div class="quick-view">
                                                    <i class="fa fa-eye group-button--icon"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- caption -->
                                        <div class="caption">
                                            <h3 class="name-product">{{$item->product_name}}</h3>
                                            @if ($item->sale_percent>0)
                                                <div class="price-product">
                                                    <span class="price-product--cost">
                                                        {{$item->price}}
                                                    </span>

                                                    <span class="price-product--sale">-{{($item->price/100)*(100-$item->sale_percent)}}</span>
                                                </div>
                                            @else
                                                <span class="price-product--sale">{{$item->price}}</span>
                                            @endif
                                        </div>
                                        <img src="{{$item->link_image}}" class="product__img" alt="" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
        <!-- Blog -->
        <div class="container blog">
            <h3 class="blog__title">
                Blog
            </h3>
            <div class="blog__box">
                    <div class="carousel-inner ctvp__box__slide">
                        <div class="carousel-item active">
                            <div class="row__item__blog">
                                <!-- item blog -->
                                @foreach ($news as $item)
                                    <div class="item__blog">
                                        <div class="item__blog--box">
                                            <img src="{{$item->link_image}}" class="img-fluid blog__img" alt="" />
                                            <div class="blog__time">
                                                <div class="blog__time--date">
                                                    <img src="fontend/assets/img/icon-calender.png" class="img-fluid icon__blog" alt="" srcset="" />
                                                    <p class="blog__time--date">{{date_format($item->created_at,'Y-m-d')}}</p>
                                                </div>
                                                <div class="blog__time--comment">
                                                    <img src="fontend/assets/img/commetn-calender.png" class="img-fluid icon__blog" alt="" />
                                                    <p class="comment__amount">
                                                        {{count($item->comment)}}
                                                    </p>
                                                </div>
                                            </div>
                                            <h4 class="blog__title">
                                                <a href="blog.html" class="blog__title">
                                                    {{$item->title}}
                                                </a>
                                            </h4>
                                            <a href="{{ route('detailnew', ['id'=>$item->id]) }}" class="blog__link">
                                                Read more
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
        </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        function addcart(e){
            var id = e.value;
            $.ajax(
                {
                    url:"{{route('addcart')}}",
                    method:'GET',
                    data:{
                        id:id
                    },
                    success: function(data){
                        document.getElementById('countcart').innerHTML = data;
                    },
                    error: function(error){

                    }
                }
            );
        }
    </script>
@endsection
