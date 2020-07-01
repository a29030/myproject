@extends('fontend.layout.admin')
@section('content')
    <div class="span9">
        <form action="{{ route('postdetailmessage', ['id'=>$data->id]) }}" method="post">
            @csrf
            <p><b>Sender: </b><span>{{$data->fullname}}</span></p>
            <input style="display: none" readonly type="text" value="{{$data->fullname}}" name="fullname">
            <p><b>Email: </b><span>{{$data->email}}</span></p>
            <input style="display: none" readonly type="text" value="{{$data->email}}" name="email">
            <p><b>Phone: </b><span>{{$data->phone}}</span></p>
            <input style="display: none" readonly type="text" value="{{$data->phone}}" name="phone">
            <p><b>Date: </b><span>{{$data->created_at}}</span></p>
            <input style="display: none" readonly type="text" value="{{$data->date}}" name="date">
            <div style="word-wrap: break-word;">
                <b>Content: </b> {{$data->content}}
            </div>
            <div>
                <textarea style="width: 100%;margin-top:20px" name="contentreply" id="" cols="30" rows="10"></textarea>
            </div>
            <button type="submit">Reply</button>
        </form>
    </div>
@endsection