@extends('fontend.base')
@section('content')
@if (!session("fecart")||empty(session("fecart")))
	<center style="margin-top: 100px;margin-bottom: 100px;">Giỏ hàng của bạn đang rỗng</center>
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
							<td style="" class="quantity">Số lượng</td>
							<td style="" class="total">Tổng tiền</td>
							<td style=""></td>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $temp)
							@if (session("fecart.{$temp['id']}")>0)
								<tr>
									<td class='cart_product'>
										<a href='#'><img width='100px' src='{{$temp['link_image']}}' alt=''></a>
									</td>
									<td class='cart_description' style="padding-top: 30px">
										<h4><a href='{{ route('ctsp', ['id'=>$temp['id']]) }}'>{{$temp['product_name']}}</a></h4>
										<p>Web ID: {{$temp['id']}}</p>
									</td>
									<td class='cart_price' style="padding-top: 30px">
										<p>{{number_format(($temp['price']/100)*(100-$temp['sale_percent']))}} đ</p>
									</td>
									<td class='cart_quantity' style="padding-top: 30px">
										<div class='cart_quantity_button'>
											<button value="{{$temp['id']}}" onclick="return updatecartup(this);"> + </button>
											<input readonly class='cart_quantity_input' id="{{$temp['id']}}" type='text' value='{{session("fecart.{$temp['id']}")}}' autocomplete='off' size='2'>
											<button value="{{$temp['id']}}" onclick="return updatecartdown(this);"> - </button>
										</div>
									</td>
									<td class='cart_total' style="padding-top: 30px">
										<p class='cart_total_price'>{{number_format((($temp['price']/100)*(100-$temp['sale_percent']))*session("fecart.{$temp['id']}"))}} đ</p>
									</td>
									<td class='cart_delete' style="padding-top: 30px">
										<a class='cart_quantity_delete' href='{{ route('deletecart', ['id'=>$temp['id']]) }}'><i class='fa fa-times'></i></a>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
			<form action="{{ route('payment')}}" method="get">
				@csrf
				<button class="btn btn-lg btn-success pull-right" name="continue" style="margin-bottom:20px;" type="submit">Mua ngay</button>
			</form>
		</div>
	</section> <!--/#cart_items-->	
@endif
@section('js')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script>
		function updatecartup(e){
			var productId = e.value;
			var oldquantity = document.getElementById(productId).value;
			var countcart = document.getElementById('countcart').innerHTML;
			$.ajax({
				url:"{{route('updatecartup')}}",
				method:'GET',
				data:{
					productId:productId,
					oldquantity:oldquantity
				},
				success: function(data){
					$("tbody").find("tr").remove();
					$("tbody").append(data);
					$.ajax({
						url: "{{route('updatecountcartup')}}",
						method:'GET',
						data:{
							countcart:countcart
						},
						success: function(data){
							document.getElementById('countcart').innerHTML = data
						},
						error: function(error){

						}
					});
				},
				error: function(error){

				}
			}
			);
		}

		function updatecartdown(e){
			var productId = e.value;
			var oldquantity = document.getElementById(productId).value;
			var countcart = document.getElementById('countcart').innerHTML;
			$.ajax({
				url:"{{route('updatecartdown')}}",
				method:'GET',
				data:{
					productId:productId,
					oldquantity:oldquantity
				},
				success: function(data){
					$("tbody").find("tr").remove();
					$("tbody").append(data);
					$.ajax({
						url: "{{route('updatecountcartdown')}}",
						method:'GET',
						data:{
							countcart:countcart
						},
						success: function(data){
							document.getElementById('countcart').innerHTML = data
						},
						error: function(error){

						}
					});
				},
				error: function(error){

				}
			}
			);
		}
	</script>
@endsection
@endsection