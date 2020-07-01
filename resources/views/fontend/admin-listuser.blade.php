@extends('fontend.layout.admin')
@section('content')
	<div class="span9">
		<div class="content">
			<div class="module message">
				<div class="module-head">
					<h3>
						List Users</h3>
				</div>
				<div class="module-option clearfix">
					<div class="pull-left">
						<div class="btn-group">
							<button class="btn">
								Filter</button>
							<button class="btn dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="{{ route('showlistuser', ['type'=>'all']) }}">All</a></li>
								<li><a href="{{ route('showlistuser', ['type'=>'normal']) }}">Normal</a></li>
                                <li><a href="{{ route('showlistuser', ['type'=>'admin']) }}">Admin</a></li>
                                <li><a href="{{ route('showlistuser', ['type'=>'manager']) }}">Manager</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<form action="{{ route('adminsearchuser') }}" method="get">
							<input type="text" name="q" id="">
							<button style="margin-bottom: 10px;" type="submit"><i class="fas fa-search"></i></button>
						</form>
					</div>
				</div>

				<div class="module-body table">
                    @if(session('thongbao'))
                        <div class = "alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
					<table class="table table-message">
						<tbody>
							<tr class="heading">
								<td class="cell-author hidden-phone hidden-tablet">
									Fullname
								</td>
								<td class="cell-title">
									Username
								</td>
								<td class="cell-icon hidden-phone hidden-tablet">
									Position
								</td>
								<td class="cell-time align-right">
									Date
								</td>
								<td class="cell-time align-right">
								</td>
							</tr>
							@foreach ($data as $user)
								<tr class="read">
									<td class="cell-author hidden-phone hidden-tablet">
										<a href="{{ route('profile', ['id'=>$user->id]) }}">{{$user->fullname}}</a>
									</td>
									<td class="cell-title">
										{{$user->username}}
									</td>
									<td class="cell-icon hidden-phone hidden-tablet">
										{{Ucwords($user->group_user->group_name)}}
									</td>
									<td class="cell-time align-right">
										{{date_format($user->created_at,'Y-m-d')}}
									</td>
									<td>
                                        <a href="{{ route('getedituser', ['id'=>$user->id]) }}"><i style="font-size: 20px" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										<i onclick="var result = confirm('Bạn có thực sự muốn xóa người dùng này?')
										if(result == true){
											window.location.href = '{{URL::to('admin/deleteuser?id='.$user->id)}}'
										}else{

										}" style="font-size: 20px;margin-left: 5px" class="fas fa-user-times"></i>

									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="module-foot">
				</div>
			</div>
		</div>
		<!--/.content-->
		<nav aria-label="Page navigation example" style="text-align: center">
			{{$data->links() }}
		</nav>
	</div>
	<!--/.span9-->
@endsection
