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