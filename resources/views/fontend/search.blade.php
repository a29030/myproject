@extends('fontend.base')
@section('content')
<!-- content web -->
<div class="container">
    <div class="row row__content mt-40">
        <div class="col-md-3 left-layout">
            <h4 class="sidebar__title">
                Danh mục sản phẩm
            </h4>
            <ul class="sidebar__list">
                @foreach ($categories as $item)
                    <li class="sidebar__item">
                        <a href="" class="sidebar__link">
                            {{$item->category_name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9 right-layout">
            <!-- grid product -->
            <div class="row">
                @foreach ($data as $item)
                    <div class="col-md-4 mt-3">
                        <div class="grid__item">
                            <div class=" item__product">
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
                                    <div class="add-cart">
                                        <i class="fa fa-cart-plus group-button--icon"></i>
                                    </div>
                                    <div class="btn-wishliss">
                                        <i class="fa fa-heart group-button--icon"></i>
                                    </div>
                                    <div class="quick-view">
                                        <a href="{{ route('ctsp', ['id'=>$item->id]) }}"><i class="fa fa-eye group-button--icon"></i></a>
                                    </div>
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
                                    @endif
                                </div>
                                <img src="{{$item->link_image}}" class="product__img" alt="" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- pagination -->
            <?php
                if(isset($_GET['q'])&&!empty($_GET['q'])){
                    $q = $_GET['q'];
                }else{
                    $q = 'noresult';
                }
            ?>
            {{-- neu so trang lon hon 3 --}}
            @if ($data->lastPage()>3)
                <nav class="pagination mb-50">
                    <ul class="pagination__box">
                        <?php
                            if(isset($_GET['page'])&&!empty($_GET['page'])){
                                $page = $_GET['page'];
                            }else{
                                $page = 3;
                            }
                        ?>
                        <li class="pagination__item">
                            <a href="{{ route("search", ['q'=>$q,'page'=>1]) }}" class="pagination__link">1</a>
                        </li>
                        <li class="pagination__item">
                            <a href="{{ route('search', ['q'=>$q,'page'=>2]) }}" class="pagination__link">2</a>
                        </li>
                        <li class="pagination__item">
                            <a href="{{ route('search', ['q'=>$q,'page'=>3]) }}" class="pagination__link">3</a>
                        </li>
                        <li class="pagination__item">
                            <a href="{{ route('search', ['q'=>$q,'page'=>$page+1]) }}" class="pagination__link"><i class="fa fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            @else
                {{-- neu so trang bang 3 --}}
                @if ($data->lastPage()==3)
                    <nav class="pagination mb-50">
                        <ul class="pagination__box">
                            <li class="pagination__item">
                                <a href="{{ route('search', ['q'=>$q,'page'=>1]) }}" class="pagination__link">1</a>
                            </li>
                            <li class="pagination__item">
                                <a href="{{ route('search', ['q'=>$q,'page'=>2]) }}" class="pagination__link">2</a>
                            </li>
                            <li class="pagination__item">
                                <a href="{{ route('search', ['q'=>$q,'page'=>3]) }}" class="pagination__link">3</a>
                            </li>
                        </ul>
                    </nav>
                @else
                    {{-- neu so trang = 2 --}}
                    @if ($data->lastPage()==2)
                        <nav class="pagination mb-50">
                            <ul class="pagination__box">
                                <li class="pagination__item">
                                    <a href="{{ route('search', ['q'=>$q,'page'=>1]) }}" class="pagination__link">1</a>
                                </li>
                                <li class="pagination__item">
                                    <a href="{{ route('search', ['q'=>$q,'page'=>2]) }}" class="pagination__link">2</a>
                                </li>
                            </ul>
                        </nav>
                    @endif  
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
