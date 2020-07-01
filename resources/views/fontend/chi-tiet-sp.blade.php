@extends('fontend.base')
@section('content')
		<div class="ct-banner pb-5">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="container-img">
							<ul class="thumb">
								<li><a href="{{ $data->link_image }}" target="imgBox"> <img src="{{ $data->link_image }}" alt=""> </a></li>
								<li><a href="{{ $data->link_image }}" target="imgBox"> <img src="{{ $data->link_image }}" alt=""> </a></li>
								<li><a href="{{ $data->link_image }}" target="imgBox"> <img src="{{ $data->link_image }}" alt=""> </a></li>
							</ul>
							<div class="imgBox">
								<img src="{{ $data->link_image }}" alt="" srcset="">
							</div>
							
						</div>
					</div>
					<div class="col-md-6">
						<div class="detail mt-5">
								<h1>{{ $data->product_name }}</h1>
							<div class="detail-star">
								<div class="ratingStarContainer">
									{{--  <input type="radio" name="starRating-2" id="star1">
									<label for="star1"><i class="fa fa-star"></i></label>
									<input type="radio" name="starRating-2" id="star2">
									<label for="star2"><i class="fa fa-star"></i></label>
									<input type="radio" name="starRating-2" id="star3">
									<label for="star3"><i class="fa fa-star"></i></label>
									<input type="radio" name="starRating-2" id="star4">
									<label for="star4"><i class="fa fa-star"></i></label>
									<input type="radio" name="starRating-2" id="star5"> 
									<label for="star5"><i class="fa fa-star"></i></label> --}}
									@for ($i = 1; $i <= $data->review->avg('star'); $i++)
										<label for="star1"><i style="color: yellow" class="fa fa-star"></i></label>
									@endfor
								</div>
								<div class="detail-star-span">
									<span class="detail-span"> ({{ $data->review->count() }} customer reviews) </span>
									<span> {{$data->sold}} sold</span>
								</div>
							</div>
						</div>
						<div class="detail-content mt-3">
							<h3>{{ number_format($data->price) }} đ</h3>
							<p>{{ $data->description }}</p>
						</div>
						<div class="detail-button">
							<button onclick="return addcart(this);" id="{{$data->id}}" value="{{$data->id}}" type="submit" class="btn-1">Thêm vào giỏ</button>
							@if ($check==0)
								<form action="{{ route('addwishlist', ['id'=>$data->id]) }}">
									<button class="btn-2">Mua ngay</button>
									<button class="btn-3"><i style="color: black" class="fa fa-heart"></i></button>
								</form>
							@else
								<form action="{{ route('deletewishlist', ['id'=>$data->id]) }}">
									<button class="btn-2">Mua ngay</button>
									<button class="btn-3"><i style="color: yellow" class="fa fa-heart"></i></button>
								</form>
							@endif
						</div>
						<hr>
						<div class="detail-info mt-3">
							<span class="sku-wrapper">Categories:
								<span class="sku">
									<a href="#">khanh</a>,
									<a href="#">khanh2</a>,
									<a href="#">khanh3</a>.
								</span>
							</span>
							<span class="sku-wrapper">Tags:
								<span class="sku">
									<a href="#">khanh</a>,
									<a href="#">khanh2</a>,
									<a href="#">khanh3</a>.
								</span>
							</span>
							<span class="sku-wrapper">Nike:
								<span class="sku">
									<a href="#">khanh</a>,
									<a href="#">khanh2</a>,
									<a href="#">khanh3</a>.
								</span>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="container">
		<div class="ct-info" id="abc">
			<div class="tabs mt-5">
			    <input id="tab1" type="radio" name="grp" checked="checked" />
			    <label for="tab1"><span>Description</span></label>
			    <div class="ct-info-content">
			    	<div class="row">
			    		<div class="col-md-6">
			    			<h3>Product Details</h3>
			    			<ul>
			    				<li>Name: {{$data->product_name}}</li>
			    				<li>Material: PP+ iron</li>
			    				<li>Gross weight: 550g</li>
			    				<li>Summary: PP+ iron material, thick legs, strong bearing capacity, stable and firm, foldable, free to open and close, no space to carry, non-slip mat on the bottom, not easy to slip, easy to carry at home and outdoor, easy to carry</li>
			    			</ul>
			    		</div>
			    		<div class="col-md-6">
			    			<h3>Item specifics</h3>
			    			<ul>
			    				<li>General Use:Outdoor Furniture</li>
			    				<li>Specific Use:Beach Chair</li>
			    				<li>Appearance:Modern</li>
			    				<li>Size:23.5*32*5cm</li>
			    				<li>Style:FOLDING CHAIR</li>
			    				<li>Material:Plastic</li>
			    			</ul>
			    		</div>
			    	</div>
			    </div>

			    <input id="tab2" type="radio" name="grp" />
			    <label for="tab2"><span>Review ({{ $data->review->count() }})</span></label>
			    <div>
					@foreach ($reviews as $review)
						{{$review->fullname}}
						@for ($i = 1; $i <= $review->star; $i++)
							<i style="color: yellow" class="fa fa-star"></i>
						@endfor
						@if (Auth::check())
							@if ($review->id_user == Auth::user()->id)
								<i onclick="editreview()" class="far fa-edit"></i>
							@endif
						@endif
						<br>
						@if ($review->content)
							{{ $review->content }}
						@endif <hr>
					@endforeach
					@if (Auth::check() && isset($oldreview) && !empty($oldreview))
						<input readonly style="display: none" type="text" name="oldreview" id="oldreview" value="{{$oldreview[0]->content}}">
						<div id="formreview">
							<form action="{{ route('editreview') }}" method="post">
								@csrf
								<input readonly type="text" style="display: none" name="id_product" value="{{$data->id}}" id="">
								<textarea style="width: 100%;height: 100px;" name="contentreview" id="contentreview" cols="30" rows="10"></textarea>
								<div class="row">
									<strong>Vote: &nbsp</strong>
									<div class="detail-star">
										<div class="ratingStarContainer">
											<input type="radio" name="rate" value="5" id="star1">
											<label for="star1"><i class="fa fa-star"></i></label>
											<input type="radio" name="rate" value="4" id="star2">
											<label for="star2"><i class="fa fa-star"></i></label>
											<input type="radio" name="rate" value="3" id="star3">
											<label for="star3"><i class="fa fa-star"></i></label>
											<input type="radio" name="rate" value="2" id="star4">
											<label for="star4"><i class="fa fa-star"></i></label>
											<input type="radio" name="rate" value="1" id="star5">
											<label for="star5"><i class="fa fa-star"></i></label>
										</div>
									</div>
								</div>
								<div>
									<button type="submit">Đánh giá</button>
								</div>
							</form>
						</div>
					@else
						@if (Auth::check() && isset($checkreviewexist) && $checkreviewexist==0)
						<form action="{{ route('addreview') }}" method="post">
							@csrf
							<input readonly type="text" style="display: none" name="id_product" value="{{$data->id}}" id="">
							<textarea style="width: 100%;height: 100px;" name="contentreview" id="contentreview" cols="30" rows="10"></textarea>
							<div class="row">
								<strong>Vote: &nbsp</strong>
								<div class="detail-star">
									<div class="ratingStarContainer">
										<input type="radio" name="rate" value="5" id="star1">
										<label for="star1"><i class="fa fa-star"></i></label>
										<input type="radio" name="rate" value="4" id="star2">
										<label for="star2"><i class="fa fa-star"></i></label>
										<input type="radio" name="rate" value="3" id="star3">
										<label for="star3"><i class="fa fa-star"></i></label>
										<input type="radio" name="rate" value="2" id="star4">
										<label for="star4"><i class="fa fa-star"></i></label>
										<input type="radio" name="rate" value="1" id="star5">
										<label for="star5"><i class="fa fa-star"></i></label>
									</div>
								</div>
							</div>
							<div>
								<button type="submit">Đánh giá</button>
							</div>
						</form>
						@else
							@if (!Auth::check())
								<strong><i>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đánh giá sản phẩm</i></strong>	
							@endif
						@endif
					@endif
					
				</div>
			    <input id="tab3" type="radio" name="grp" />
				<label for="tab3"><span>Question & Answers ({{$comments->count()}})</span></label>
					{{-- lay ra cac comment --}}
					<div>
						<input style="display: none" readonly type="text" name="" id="comments" value="{{Request::fullurl()}}">
						@foreach ($comments as $comment)
							<div>
								<b>{{$comment->fullname}}: </b>{{$comment->comment}}
							</div>
							<div><i style="font-size: smaller">Date: {{$comment->created_at}}</i></div>
							<hr>
						@endforeach
						{{-- hien thi form comment khi nguoi dung da dang nhap --}}
						@if (Auth::check())
							<form action="{{ route('addcomment') }}" method="post">
								@csrf
								<input readonly type="text" style="display: none" name="id_product" value="{{$data->id}}" id="">
								<textarea style="width: 100%;height: 100px;" name="contentcomment" id="" cols="30" rows="10" required></textarea>
								<button type="submit">Bình luận</button>
							</form>
						@endif
					</div>
			    <input id="tab4" type="radio" name="grp" />
			    <label for="tab4"><span>Shipping</span></label>
			    <div>Accusamus recusandae quam cupiditate eius, aspernatur voluptates, provident odit autem, dolor nesciunt mollitia neque corrupti repudiandae eveniet? Iusto, iure? Impedit tempore ullam possimus rerum maxime quisquam autem nostrum delectus. Ullam.</div>
			</div>
		</div>
	</div>
	<script>
		document.getElementById("formreview").style.display = "none";

		function editreview(){
			var oldreview = document.getElementById("oldreview").value;
			document.getElementById("contentreview").value = oldreview;
			document.getElementById("formreview").style.display = "block";
		}
	</script>
	<script src="https://kit.fontawesome.com/9160225bd1.js" crossorigin="anonymous"></script>
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