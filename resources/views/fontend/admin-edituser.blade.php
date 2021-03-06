@extends('fontend.layout.admin')
@section('content')
    <div class="span9">
        <form action="{{ route('postedituser', ['id'=>$data->id]) }}" method="post">
            @csrf
            <div style="display: flex; justify-content: space-around">
                <div>
                    @if ($errors->has('fullname'))
                        <strong>{{$errors->first('fullname')}}</strong>
                    @endif
                    <label for="fullname">Fullname</label>
                    <input type="text" name="fullname" id="fullname" value="{{$data->fullname}}" required>
                    <label for="username">Username</label>
                    <input type="text" readonly name="username" id="username" value="{{$data->username}}">
                    <label for="email">Email</label>
                    <input type="text" readonly name="email" id="email" value="{{$data->email}}">
                    @if ($errors->has('phone'))
                        <strong>{{$errors->first('phone')}}</strong>
                    @endif
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{$data->phone}}" required>
                </div>
                <div>
                    @if ($errors->has('address'))
                        <strong>{{$errors->first('address')}}</strong>
                    @endif
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="{{$data->address}}" required>
                    <label for="position"></label>
                    @if ($data->id_group == 1)
                        <select name="position" id="position">
                            <option selected value="1">Normal</option>
                            <option value="2">Manager</option>
                            <option value="3">Admin</option>
                        </select>
                    @else
                        @if ($data->id_group == 2)
                            <select name="position" id="position">
                                <option value="1">Normal</option>
                                <option selected value="2">Manager</option>
                                <option value="3">Admin</option>
                            </select>
                        @else
                            @if ($data->id_group == 3)
                                <select name="position" id="position">
                                    <option value="1">Normal</option>
                                    <option value="2">Manager</option>
                                    <option selected value="3">Admin</option>
                                </select>
                            @endif
                        @endif
                    @endif
                    <label for="date">Date</label>
                    <input type="text" readonly name="date" id="date" value="{{$data->created_at}}">
                </div>
            </div>
            <div style="width: 100%;text-align: center">
                <button type="submit" style="">Update</button>
            </div>
        </form>
    </div>
    <!--/.span9-->
@endsection
