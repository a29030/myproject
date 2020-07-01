@extends('fontend.base')
@section('content')
<form action="{{ route('completeorder') }}" method="post">
	@csrf
	<div class="payment-wrap container px-0">
		<div class="payment-form">
			<div class="step">
				<div class="billing-address">
					<div class="section-header">
						<p class="section-title">Địa chỉ nhận hàng</p>
						@if (!Auth::check())
							<p class="section-account">
								<span>Have account?</span>
								<a href="{{ route('login') }}">Signin</a>
							</p>
						@endif
					</div>
					<div class="section-content">
						<form>
							@if ($errors->has('fullname'))
								<i><strong>{{$errors->first('fullname')}}</strong></i>
							@endif
							<input type="text" name="fullname" class="form-control" id="name" placeholder="Fullname" @if (isset($data['fullname']))
								value="{{$data['fullname']}}"
							@endif required>
							@if ($errors->has('email'))
								<i><strong>{{$errors->first('email')}}</strong></i>
							@endif	
							<input type="email" name="email" class="form-control" id="email" placeholder="Email" @if (isset($data['email']))
								value="{{$data['email']}}"
							@endif required>
							@if ($errors->has('phone'))
								<i><strong>{{$errors->first('phone')}}</strong></i>
							@endif
							<input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" @if (isset($data['phone']))
								value="{{$data['phone']}}"
							@endif required>
							@if ($errors->has('address'))
								<i><strong>{{$errors->first('address')}}</strong></i>
							@endif
							<input type="text" name="address" class="form-control" id="address" placeholder="Address" @if (isset($data['address']))
								value="{{$data['address']}}"
							@endif required>
							<select class="form-control">
								<option disabled="" selected="" hidden="">Tỉnh/Thành phố</option>
								<option>Hồ Chí Minh</option>
								<option>Hà Nội</option>
								<option>Đà Nẵng</option>
							</select>
							<select class="form-control">
								<option disabled="" selected="" hidden="">Quận/Huyện</option>
								<option>Quận Ba Đình</option>
								<option>Quận Tây Hồ</option>
								<option>Quận Hoàn Kiếm</option>
							</select>
							<select class="form-control">
								<option disabled="" selected="" hidden="">Phường/Xã</option>
								<option>Phường Đội Cấn</option>
								<option>Phường Giảng Võ</option>
								<option>Phường Kim Mã</option>
							</select>
						</form>
					</div>
				</div>
	
				<div class="payment-method">
					<div class="section-header">
						<p class="section-title">Thanh toán</p>
						<p style="color: red">Chọn 1 trong 4 phương thức thanh toán</p>
					</div>
					<div class="payment-method-content">
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="headingTwo">
									<div data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="payment-method1" name="payment-method" class="custom-control-input">
										<label class="custom-control-label" for="payment-method1">Ship COD(Có phụ phí)</label>
									</div>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingOne">
									<div data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="payment-method2" name="payment-method" class="custom-control-input" checked="checked">
										<label class="custom-control-label" for="payment-method2">VietComBank</label>
									</div>
								</div>
	
								{{-- <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body">Please fill up fullname and phone (*) 
									</div>
								</div> --}}
							</div>
							<div class="card">
								<div class="card-header" id="headingTwo">
									<div data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="payment-method3" name="payment-method" class="custom-control-input">
										<label class="custom-control-label" for="payment-method3">Thanh toán bằng Momo</label>
									</div>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingThree">
									<div data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="payment-method4" name="payment-method" class="custom-control-input">
										<label class="custom-control-label" for="payment-method4">Thanh toán bằng ATM/Visa/Master/JCB</label>
									</div>
								</div>
								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
								</div>
							</div>
						</div>
					</div>
					<div class="step-footer">
						<a class="step-footer-previous-link" href="{{ route('getcart') }}">Giỏ hàng</a>
						<button style="width: 150px;" name="button" type="submit" id="continue_button" class="step-footer-continue-btn btn">Thanh toán</button>
					</div>
				</div>
			</div>
		</div>
		<div class="cart-aside-wrap">
			<div class="cart-aside-content">
				<div class="cart-aside-product">
					<div class="payment-product-table">
						<?php
							//tong tien tat cac cac san pham
							$totalprice = 0;
							//bien check de kiem tra xem co san pham nao trong gio hang duoc giam gia hay khong
							$check = 0;
						?>
						@foreach ($dataproducts as $product)
							<div class="product">
								<div class="product-image">
									<a href="{{ route('ctsp', ['id'=>$product['id']]) }}"><img style="max-width: 65px" src="{{$product['link_image']}}"></a>
									<span class="product-thumbnail-quantity">{{session("fecart.{$product['id']}")}}</span>
								</div>
							<div class="product-info"><a href="{{ route('ctsp', ['id'=>$product['id']]) }}">{{$product['product_name']}}</a> @if ($product['sale_percent']>0)
								(-{{$product['sale_percent']}}%)
							@endif</div>
								{{-- tong tien 1 san pham = gia da giam * so luong --}}
								<div class="product-price">{{number_format((($product['price']/100) * (100-$product['sale_percent']))*session("fecart.{$product['id']}"))}} đ</div>
								@if ($product['sale_percent']>0)
									<?php
										$check = 1;
									?>
								@endif
							</div>
							{{-- tinh tong tien hang --}}
							<?php
								$totalprice += ($product['price']*session("fecart.{$product['id']}"));
							?>
						@endforeach
					</div>
				</div>
			</div>
			{{-- neu khong co san pham nao trong gio hang duoc giam gia thi cho phep su dung code --}}
			@if ($check == 0)
				@if (session('resultcheckcode'))
				<strong>{{session('resultcheckcode')}}</strong>
				@endif
				
				<div class="cart-aside-discount">
					<form style="display: flex" action="{{ route('checkcode') }}" method="get">
						@csrf
						<input class="form-control input-discount" type="text" name="serrie" placeholder="Nhập mã giảm giá" @if (session("serriecode"))
							value="{{session("serriecode")}}"
						@endif>
						<button style="width: 120px;" class="btn button-discount" type="submit">Áp mã</button>
						@if (session("checkcodesuccess")==='true')
							<div>
								<a href="{{ route('forgetcode') }}"><button style="width: fit-content" class="btn button-discount" type="button">Hủy</button></a>
							</div>
						@endif
					</form>
				</div>
			@else
				<strong>Mã giảm giá chỉ áp dụng với đơn hàng không có sản phẩm được giảm giá</strong>
			@endif
			<div class="calc-cash">
					<div class="calc-row">
						<span>Tổng tiền :</span>
						<span>{{number_format($totalprice)}} đ</span>
					</div>	
					<div class="calc-row">
						<span>Phí vận chuyển :</span>
						<span>20.000 đ</span>
					</div>	
				</div>
				<div class="sum">
					
					@if (session('checkcodesuccess')==='true')
						<span>Tổng tiền sau khi áp dụng mã giảm giá : </span>
						<?php
							session()->flash('sale_percent2',session('sale_percent'));
							session()->flash('serries_code',session('serriecode'));
							$total = (($totalprice/100)*(100-session('sale_percent')))+20000;
						?>
					@else
						<span>Tổng tiền : </span>
						<?php
							$total = $totalprice+20000;
						?>
					@endif
					{{session()->flash('totalpay',$total)}}
					<span class="price-sum">{{number_format($total)}} đ</span>
					<input type="text" style="display: none" readonly name="total" value="{{$total}}">
				</div>
			<div class="cart-aside-total">
				
			</div>
		</div>
	</div>
</form>
@endsection