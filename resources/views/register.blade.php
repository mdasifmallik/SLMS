@extends('layouts.basic')


@section('content')

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h2>SLMS Registration</h2>
                </div>
                <div class="login-form">
                    <form method="post" action="store_student">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <select name="department" class="form-control" id="mySelect" onchange="ajax_select()">
                                <option value="">Choose Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="ajax_select">
                            <label>Batch</label>
                            <select name="batch" id="" class="form-control">
                                <option value="">Choose Batch</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Roll</label>
                            <input type="text" class="form-control" placeholder="Roll" name="roll">
                        </div>
                        <div class="form-group">
                            <label>Verification Code</label>
                            <input type="text" class="form-control" placeholder="Verification Code" name="verification_code">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Retype Password" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30 mb">Register</button>
                        
                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ? <a href="/login"> Sign in</a></p>
                        </div>
                        <div class="register-link m-t-15 text-center">
                            <p>Or,<a href="/register_lecturer"> Register </a>as a Lecturer!</p>
                        </div>
                        <div class="register-link m-t-15 text-center">
                            <p>Or,<a href="/register/create"> Register </a>as an admin!</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    


@endsection


@section('script')

    <script>
        function ajax_select(){
            var x = document.getElementById("mySelect").value;
            var xhttp;
              xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("ajax_select").innerHTML = this.responseText;
                }
              };
              xhttp.open("GET", "/register/"+x, true);
              xhttp.send();
        }
    </script>

@endsection