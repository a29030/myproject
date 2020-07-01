@extends('fontend.layout.admin')
@section('content')
	<div class="span9">
		<div class="content">
			<div class="module message">
				<div style="display: flex" class="module-head">
					<h1>List Product</h1>	
					<form method="GET" action="{{ route('searchproduct') }}">
						<input name="q" style="margin-left: 400px;height: 15px;margin-top: 10px" type="text" placeholder="Search product">
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
								@foreach ($listca as $item)
									<li><a href="{{ route('product', ['category'=>$item->slug_name]) }}">{{ $item->category_name }}</a></li>
								@endforeach
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
								<td style="width: 200px;" class="cell-author hidden-phone hidden-tablet">Product Name</td>
								<td style="width: 150px;" class="cell-title">Price</td>
								<td style="width: 150px;" class="cell-quantity">Inventory number</td>
								<td style="width: 200px;" class="cell-time">Update day</td>
                                <td style="width: 100px;" class="cell-button"></td>
                            </tr>
							@foreach ($list as $item)
                                <tr class="unread">
                                    {{-- <td class="cell-check">
                                        <input type="checkbox" class="inbox-checkbox">
                                    </td>
                                    <td class="cell-icon">
                                        <i class="icon-star"></i>
									</td> --}}
									<td class="cell-id">{{ $item->id }}</td>
                                    <td class="cell-author hidden-phone hidden-tablet">{{ $item->product_name }}</td>
                                    <td class="cell-title">{{ number_format($item->price) }}</td>
                                    <td class="cell-quantity">{{ $item->quantity - $item->sold }}</td>
                                    <td class="cell-time">
                                        @if ($item->updated_at!=null)
                                            {{Carbon\Carbon::parse($item->updated_at)->format('H:i d-m-Y')}}
                                        @endif
                                    </td>
                                    <td class="cell-button">
                                        <a href="{{ route('editproduct', ['id'=>$item->id]) }}"><i style="font-size: 20px" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="{{ route('deleteproduct', ['id'=>$item->id]) }}"><i style="font-size: 20px;margin-left: 5px"  class="fa fa-trash-o" aria-hidden="true"></i></a>
									</td>
                                </tr>
							@endforeach
							{{-- <nav aria-label="Page navigation" style="text-align: center">
								<b>{{$list->links() }}</b>
							</nav> --}}
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
