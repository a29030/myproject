@extends('fontend.base')
@section('content')
    <div style="background-color: white;width: 800px;margin-left: 190px;padding-top: 50px;" class="module-body table">
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
@endsection