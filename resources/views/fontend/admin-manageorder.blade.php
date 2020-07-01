@extends('fontend.layout.admin')
@section('content')
	<div class="span9">
		<div class="content">
			<div class="module message">
				<div style="display: flex" class="module-head">
					<h1>List Order</h1>	
					<form method="GET" action="{{ route('searchproduct') }}">
						<input name="q" style="margin-left: 440px;height: 15px;margin-top: 10px" type="text" placeholder="Search order">
						<button style="background-color: aqua;" type="submit">
							<i style="" class="fa fa-search" aria-hidden="true"></i>
						</button>
					</form>
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
								<li><a href="{{ route('manageorder', ['status'=>'all']) }}">All</a></li>
								<li><a href="{{ route('manageorder', ['status'=>'wait']) }}">Wait</a></li>
								<li><a href="{{ route('manageorder', ['status'=>'approval']) }}">Approval</a></li>
								<li><a href="{{ route('manageorder', ['status'=>'delivery']) }}">Delivery</a></li>
								<li><a href="{{ route('manageorder', ['status'=>'delivered']) }}">Delivered</a></li>
								<li><a href="{{ route('manageorder', ['status'=>'cancel']) }}">Cancel</a></li>
								<li class="divider"></li>
								<li><a href="#">Settings</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="module-body table">
					<table class="table table-message">
						<tbody>
							<tr class="heading">
								{{-- <td class="cell-check">
									<input type="checkbox" class="inbox-checkbox">
								</td>
								<td class="cell-icon">
								</td> --}}
								<td style="" class="cell-id">ID</td>
                                <td style="width: 200px;" class="cell-author hidden-phone hidden-tablet">Fullname</td>
                                <td style="width: 120px;" class="cell-phone">Phone</td>
								<td style="width: 150px;" class="cell-title">Total Money</td>
								<td style="width: 150px;" class="cell-quantity">Status</td>
								<td style="width: 170px;" class="cell-time">Update day</td>
                                <td style="width: 100px;" class="cell-button"></td>
							</tr>
							@foreach ($data as $item)
								@if ($item->id_status==1)
									<tr class="unread">
								@else
									<tr class="read">
								@endif
									<td class="cell-id">{{ $item->id }}</td>
									<td class="cell-author hidden-phone hidden-tablet">{{ $item->fullname }}</td>
									<td class="cell-phone">{{ $item->phone }}</td>
									<td class="cell-title">{{ number_format($item->totalpay) }}</td>
									<td class="cell-quantity">
										@if ($item->id_status == 4)
											<span style="color: rgb(0, 174, 255)">{{ $item->status_order->status }}</span>
											<i style="color: chartreuse" class="fa fa-check" aria-hidden="true"></i>
										@elseif($item->id_status == 5)
											<span style="color: black">{{ $item->status_order->status }}</span>
											<i style="color: black" class="fa fa-times" aria-hidden="true"></i>
										@else 
											<span>{{ $item->status_order->status }}</span>
										@endif    
									</td>
									<td class="cell-time">
										@if ($item->created_at!=null)
											{{Carbon\Carbon::parse($item->created_at)->format('H:i d-m-Y')}}
										@endif
									</td>
									<td class="cell-button">
										<a href="{{ route('detailorder', ['id'=>$item->id]) }}">Detail</a>
									</td>
								</tr>
							@endforeach
							{{-- <nav aria-label="Page navigation" style="text-align: center">
								<b>{{$list->links() }}</b>
                            </nav>  --}}
						</tbody>
					</table>
				</div>
				<div class="module-foot">
				</div>
			</div>
		</div>
		<!--/.content-->
	</div>
	<!--/.span9-->
@endsection
