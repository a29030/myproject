@extends('fontend.layout.admin')
@section('content')
        <div class="span9">
            <input style="display: none" readonly type="text" value="" name="fullname">
            <p><b>Name : </b><span>{{ $dataorder->fullname }}</span></p>
            <input style="display: none" readonly type="text" value="" name="email">
            <p><b>Email : </b><span>{{ $dataorder->email }}</span></p>
            <input style="display: none" readonly type="text" value="" name="email">
            <p><b>Phone : </b><span>{{ $dataorder->phone }}</span></p>
            <input style="display: none" readonly type="text" value="" name="email">
            <p><b>Total Pay : </b><span>{{ number_format($dataorder->totalpay) }}</span></p>
            <input style="display: none" readonly type="text" value="" name="email">
            <p><b>Sale : </b><span>{{ number_format($dataorder->sale_percent) }}</span></p>
            <input style="display: none" readonly type="text" value="" name="email">
            <p><b>Status : </b>
                @if ($dataorder->id_status == 4)
                    <span style="color: rgb(0, 174, 255)">{{ $dataorder->status_order->status }}</span>
                    <i style="color: chartreuse" class="fa fa-check" aria-hidden="true"></i>
                @elseif($dataorder->id_status == 5)
                    <span style="color: black">{{ $dataorder->status_order->status }}</span>
                    <i style="color: black" class="fa fa-times" aria-hidden="true"></i>
                @else
                    <span>{{ $dataorder->status_order->status }}</span>
                @endif    
            </p>
            <input style="display: none" readonly type="text" value="" name="phone">
            <p><b>Date : </b><span>
                {{Carbon\Carbon::parse($dataorder->created_at)->format('H:i d-m-Y')}}
            </span></p>
            <input style="display: none" readonly type="text" value="" name="date">
            <div style="display: flex;word-wrap: break-word">
                <b>List product : 
                    <table class="table table-message">
						<tbody>
							<tr class="heading">
								<td style="" class="cell-id">ID</td>
                                <td style="width: 200px;" class="cell-author hidden-phone hidden-tablet">Product Name</td>
                                <td style="width: 150px;" class="cell-price">Price</td>
                                <td style="width: 150px;" class="cell-price">Sale</td>
                                <td style="width: 150px;" class="cell-phone">Quantity</td>
                                <td style="width: 150px;" class="cell-title">Total</td>
							</tr>
							@foreach ($dataorderproduct as $item)
								<tr class="unread">
									<td class="cell-id">{{ $item->id_product }}</td>
									<td class="cell-author hidden-phone hidden-tablet">{{ $item->product->product_name }}</td>
                                    <td style="width: 150px;" class="cell-price">{{ $item->product->price }}</td>
                                    <td style="width: 150px;" class="cell-price">{{ $item->product->sale_percent }}</td>
                                    <td class="cell-phone">{{ $item->quantity }}</td>
									@if ($item->product->sale_percent==0)
                                        <td class="cell-title">{{ $item->quantity *  $item->product->price }}</td>
                                    @else
                                        <td class="cell-title">{{ $item->quantity *  $item->product->price * $item->product->sale_percent }}</td>
                                    @endif
								</tr>
							@endforeach
						</tbody>
					</table>
                </b>
            </div>
            @if ($dataorder->id_status == 1)
                <div style="margin-top: 10px;margin-left: 280px">
                    <form action="{{ route('processorder') }}" method="POST">
                        @csrf
                        <input style="display: none" type="number" readonly name="id" value="{{ $dataorder->id }}">
                        <input type="submit" name="approval" style="width: 100px;border-radius: 6px;border: black solid 1px" value="Approval">
                        <input type="submit" name="cancel" style="width: 100px;border-radius: 6px;border: black solid 1px;margin-left: 20px" value="Cancel Order">
                    </form>
                </div>    
            @elseif ($dataorder->id_status == 2)
                <div style="margin-top: 10px;margin-left: 280px">
                    <form action="{{ route('processorder') }}" method="POST">
                        @csrf
                        <input style="display: none" type="number" readonly name="id" value="{{ $dataorder->id }}">
                        <input type="submit" name="delivery" style="width: 100px;border-radius: 6px;border: black solid 1px" value="Delivery">
                        <input type="submit" name="cancel" style="width: 100px;border-radius: 6px;border: black solid 1px;margin-left: 20px" value="Cancel Order">
                    </form>
                </div>    
            @elseif ($dataorder->id_status == 3)
                <div style="margin-top: 10px;margin-left: 280px">
                    <form action="{{ route('processorder') }}" method="POST">
                        @csrf
                        <input style="display: none" type="number" readonly name="id" value="{{ $dataorder->id }}">
                        <input type="submit" name="delivered" style="width: 100px;border-radius: 6px;border: black solid 1px" value="Delivered">
                        <input type="submit" name="cancel" style="width: 100px;border-radius: 6px;border: black solid 1px;margin-left: 20px" value="Cancel Order">
                    </form>
                </div> 
            @endif
        </div>
@endsection