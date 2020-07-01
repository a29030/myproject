@extends('fontend.base')
@section('content')
	<div></div>
	<center style="font-size: 50px;margin-top: 50px">Tài khoản cá nhân</center>
	<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin: auto;width: 80%">
		<li class="nav-item">
		  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Chung</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Đổi mật khẩu</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Quản lí đơn hàng</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			<form class="form" action="{{ route('updateaccount') }}" method="post" id="registrationForm">
				@csrf
				<div class="row" style="justify-content: space-around">
					<div>
						<div class="form-group">
							@if ($errors->has('fullname'))
								<strong>{{$errors->first('fullname')}}</strong>
							@endif
							<div class="col-xs-6">
								<label for="first_name"><h4>Họ Tên</h4></label>
								<input type="text" class="form-control" name="fullname" id="fullname" placeholder="fullname" title="enter your fullname if any." value="{{Auth::user()->fullname}}" >
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6">
								<label for="phone"><h4>Tài khoản</h4></label>
								<input readonly type="text" class="form-control" name="username" id="phone" placeholder="enter phone" title="username" value="{{Auth::user()->username}}" >
							</div>
						</div>
				
						<div class="form-group">
							<div class="col-xs-6">
								<label for="email"><h4>Email</h4></label>
								<input readonly type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email." value="{{Auth::user()->email}}">
							</div>
						</div>
					</div>
					<div>
						@if ($errors->has('phone'))
							<strong>{{$errors->first('phone')}}</strong>
						@endif
						<div class="form-group">
							<div class="col-xs-6">
								<label for="phone"><h4>Số điện thoại</h4></label>
								<input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any." value="{{Auth::user()->phone}}" >
							</div>
						</div>
						
						@if ($errors->has('address'))
							<strong>{{$errors->first('address')}}</strong>
						@endif
						<div class="form-group">
							<div class="col-xs-6">
								<label for="address"><h4>Địa chỉ</h4></label>
								<input type="text" name="address" class="form-control" id="address" placeholder="somewhere" title="enter a location" value="{{Auth::user()->address}}">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row" style="justify-content: flex-end;margin-right: 100px;">
					<div class="col-xs-12">
						<button style="min-width: 110px;" class="btn btn-lg btn-success" type="submit"> Lưu</button>
						<button style="min-width: 110px;" class="btn btn-lg btn-success" name="logout" type="submit"> Đăng xuất</button>
					</div>
				</div>
			</form>
		</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<form action="{{ route('changepassword') }}" method="post">
				@csrf
				<div style="display: grid; width: 30%;margin: auto;margin-top: 30px">
					@if ($errors->has('password'))
						<strong>{{$errors->first('password')}}</strong>
					@endif
					<label for="password">Password</label>
					<input id="password" type="password" name="password" required>
					@if ($errors->has('repassword'))
						<strong>{{$errors->first('repassword')}}</strong>
					@endif
					<label for="confirm">RePassword</label>
					<input id="confirm" type="password" name="password_confirmation" required>
					@if ($errors->has('newpassword'))
						<strong>{{$errors->first('newpassword')}}</strong>
					@endif
					<label for="newpassword">Mật khẩu mới</label>
					<input id="newpassword" type="password" name="newpassword" required>
					<div style="width: fit-content;margin: auto;margin-top: 30px;justify-content: space-around" class="row">
						<button type="submit">Đổi mật khẩu</button>
					</div>
				</div>
			</form>
		</div>
		<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
			<div style="background-color: white;width: 80%;margin-left: 190px;padding-top: 50px;margin-left:auto;margin-right: auto" class="module-body table">
				@if (!empty($listorder))
					<h1>Quản lí đơn hàng</h1>
					<table  class="table table-message">
						<tbody>
							<tr style="background-color: aqua" class="heading">
								<td style="width: 100px;" class="cell-id">Mã đơn</td>
								<td style="width: 200px;" class="cell-author hidden-phone hidden-tablet">Ngày mua</td>
								<td style="width: 120px;" class="cell-phone">Tổng tiền</td>
								<td style="width: 150px;" class="cell-title">Trạng thái đơn hàng</td>
								<td style="width: 100px;" class="cell-button"></td>
							</tr>
					@foreach ($listorder as $item)
								<tr class="heading">
									<td style="width: 100px;" class="cell-id">{{ $item->id }}</td>
									<td style="width: 200px;" class="cell-author hidden-phone hidden-tablet">{{ date_format($item->created_at,'d-m-Y') }}</td>
									<td style="width: 120px;" class="cell-phone">{{ $item->totalpay }}</td>
									<td style="width: 150px;" class="cell-title">{{ $item->status_order->status }}</td>
									<td style="width: 120px;" class="cell-button">
										@if ($item->id_status<=3)
											<a style="color: rgba(38, 16, 167, 0.897)" href="{{ route('cancelorder', ['id'=>$item->id]) }}">Hủy</a>
											<span style="margin-left: 5px;border-right: black solid 1px"></span>
										@endif
										<button style="color: rgba(38, 16, 167, 0.897);background: none;border: none" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{ $item->id }}" aria-expanded="false" aria-controls="collapseExample{{ $item->id }}">Chi tiết</button>
									</td>
								</tr>                 
					@endforeach
						</tbody>
					</table>   
					@elseif (empty($lisorder))
							<span style="margin-left: 350px">Bạn chưa có đơn hàng nào</span>
					@endif
			</div>  
		</div>
	</div>
@endsection