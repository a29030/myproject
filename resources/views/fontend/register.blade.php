@extends('fontend.base')
@section('content')
    <div class="container mt-5 mb-5">
        @if(count($errors)>0)
            <div class = "alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        <div class="box">

            <h1>Login</h1>
            <form action="{{route('pregister')}}" method="post">
                @csrf
                <div class="input-box">
                    <input type="text" name="username" required />
                    <label for="">Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required />
                    <label for="">Password</label>
                </div>
                <div class="input-box">
                    <input type="password" name="Repassword" required />
                    <label for="">RePassword</label>
                </div>
                <div class="input-box">
                    <input type="text" name="email" required />
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <input type="text" name="fullname" required />
                    <label for="">Full name</label>
                </div>
                <div class="input-box">
                    <input type="number" name="phone" required />
                    <label for="">Phone</label>
                </div>
                <div class="input-box">
                    <input type="text" name="address" required />
                    <label for="">Address</label>
                </div>
                <input type="submit" value="Submit" />
            </form>

        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active-1");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
@endsection
