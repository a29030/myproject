@extends('fontend.base')
@section('content')
@if (empty(session("wishlist")))
	<center style="margin-top: 100px;margin-bottom: 100px;">Danh sách sản phẩm yêu thích của bạn đang rỗng</center>
@else
	<section id="cart_items" style="margin-bottom: 100px;">
		<div class="container">
			<div class="table-responsive cart_info" style="margin-top: 50px;">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td style="" class="image">Sản phẩm</td>
							<td style="" class="description"></td>
							<td style="" class="price">Giá</td>
							<td style=""></td>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $item)
							<tr>
								<td class='cart_product'>
									<a href='{{ route('ctsp', ['id'=>$item->id]) }}'><img width='100px' src='{{ $item->link_image }}' alt=''></a>
								</td>
								<td class='cart_description' style="padding-top: 30px">
									<h4><a href='{{ route('ctsp', ['id'=>$item->id]) }}'>{{ $item->product_name }}</a></h4>
									<p>Web ID: {{ $item->id }}</p>
								</td>
								<td class='cart_price' style="padding-top: 30px">
									<p>{{ number_format($item->price) }} đ</p>
								</td>
								<td class='cart_delete' style="padding-top: 30px">
									<a class='cart_quantity_delete' href='{{ route('deletewishlist', ['id'=>$item->id]) }}'><i class='fa fa-times'></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{-- <form action="" method="get">
				@csrf
				<button class="btn btn-lg btn-success pull-right" name="buynow" style="margin-bottom:20px;" type="submit">Mua ngay</i></button>
			</form> --}}
		</div>
	</section> <!--/#cart_items-->	
@endif
@endsection