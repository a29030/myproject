@extends('fontend.layout.admin')
@section('content')
	<div class="span9">
		<div class="content">
			<div class="module message">
				<div class="module-head">
					<h3>
						Message</h3>
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
								<li><a href="{{ route('admin-contact', ['status'=>'all']) }}">All</a></li>
								<li><a href="{{ route('admin-contact', ['status'=>'unread']) }}">Unread</a></li>
								<li><a href="{{ route('admin-contact', ['status'=>'read']) }}">Read</a></li>
								<li class="divider"></li>
								<li><a href="#">Settings</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<form action="{{ route('adminsearchcontact') }}" method="get">
							<input type="text" name="q" id="">
							<button style="margin-bottom: 10px;" type="submit"><i class="fas fa-search"></i></button>
						</form>
					</div>
				</div>
				<div class="module-body table">
					<table class="table table-message">
						<tbody>
							<tr class="heading">
								<td class="cell-check">
									<input type="checkbox" class="inbox-checkbox">
								</td>
								<td class="cell-author hidden-phone hidden-tablet">
									Sender
								</td>
								<td class="cell-title">
									Email
								</td>
								<td class="cell-icon hidden-phone hidden-tablet">
									Phone
								</td>
								<td class="cell-time align-right">
									Date
								</td>
							</tr>
							@foreach ($data as $message)
								@if ($message->status == 0)
									<tr class="unread">
										<td class="cell-check">
											<input type="checkbox" class="inbox-checkbox">
										</td>
										<td class="cell-author hidden-phone hidden-tablet">
											<a href="{{ route('detailmessage', ['id'=>$message->id]) }}">{{$message->fullname}}</a>
										</td>
										<td class="cell-title">
											{{$message->email}}
										</td>
										<td class="cell-icon hidden-phone hidden-tablet">
											{{$message->phone}}
										</td>
										<td class="cell-time align-right">
											{{date_format($message->created_at,'Y-m-d')}}
										</td>
									</tr>
								@else
									<tr class="read">
										<td class="cell-check">
											<input type="checkbox" class="inbox-checkbox">
										</td>
										<td class="cell-author hidden-phone hidden-tablet">
											<a href="{{ route('detailmessage', ['id'=>$message->id]) }}">{{$message->fullname}}</a>
										</td>
										<td class="cell-title">
											{{$message->email}}
										</td>
										<td class="cell-icon hidden-phone hidden-tablet">
											{{$message->phone}}
										</td>
										<td class="cell-time align-right">
											{{date_format($message->created_at,'Y-m-d')}}
										</td>
									</tr>
								@endif
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
