@extends('fontend.base')
@section('content')
<!-- content web -->
<div class="container-fluid">
    <div class="container">
        <div class="row mt-20">
            <!-- left layout -->
            <div class="col-md-4 sidebar left-layout">
                <h1 class="sidebar__headding">
                    Tin tức mới
                </h1>
                <form action="{{ route('searchnew') }}" method="get">
                    <div class="search-blog--box">
                        <input type="search" name="q" id="" class="form__search" placeholder="Bạn muốn tìm gì ... ?">
                        <button type="submit" class="btn--blog">
                            <i class="fa fa-search btn--blog--icon"></i>
                        </button>
                    </div>
                </form>   
                    <h3 class="sidebar__title pt-20">
                        Danh mục tin tức
                    </h3>
                    <ul class="ct__blog--box">
                        @foreach ($datacategory as $item)
                            <li class="ct__blog--item">
                                <a href="{{ route('detailcategory', ['category'=>$item->slug_name]) }}" class="ct__blog--link">
                                    {{$item->news_name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- right layout -->
            <div class="col-md-8 article right-layout" >
                @if (!empty($datanew))
                    @foreach ($datanew as $item)
                        <div class="blog__box">
                            <img src="{{ $item->link_image }}" class="img-fluid blog__img" alt="">
                            <div class="entry-category">
                                <a href="" class="btn-entry">
                                    {{ $item->category_news->news_name }}
                                </a>
                            </div>
                            <h3 class="entry-title">
                                {{ $item->title }}
                            </h3>
                                <ul class="entry-meta-list">
                                    <li class="entry-date">
                                        <a href="" class="entry-icon">
                                            <img src="fontend/assets/img/icon-calender.png" class="entry-img" alt="">

                                        </a>
                                        {{ $item->created_at }}
                                    </li>
                                    <li class="entry-cmt">
                                        <a href="" class="entry-icon">
                                            <img src="fontend/assets/img/commetn-calender.png" class="entry-img" alt="">
                                        </a>
                                        {{ $item->comment->count() }}
                                    </li>
                                </ul>
                                <p class="entry-description">
                                    {{-- {{ $item->content }} --}}
                                </p>
                                <a style="margin: 10px" href="{{ route('detailnew', ['id'=>$item->id]) }}" class="btn entry-readmore">
                                    Đọc tiếp
                                </a>
                        </div>
                    @endforeach
                @endif
                <nav aria-label="Page navigation" style="text-align: center">
                    <b>{{$datanew->links() }}</b>
                </nav>
            </div>
            
        </div>
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript">
            function openNav() {
              document.getElementById("mySidepanel").style.width = "250px";
            }

            function closeNav() {
              document.getElementById("mySidepanel").style.width = "0";
            }
        </script>
        <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
          dropdown[i].addEventListener("click", function() {
          this.classList.toggle("active-1");
          var dropdownContent = this.nextElementSibling;
          if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
          } else {
          dropdownContent.style.display = "block";
          }
          });
        }
        </script>
        @endsection