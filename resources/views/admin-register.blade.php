@extends('layouts.basic')


@section('content')


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h2>SLMS Admin Registration</h2>
                </div>
                <div class="login-form">
                    <form method="post" action="/register">
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
                            <label>Department Name</label>
                            <input type="text" class="form-control" placeholder="Department Name" name="department">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Retype Password" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-0 m-t-30 mb">Register</button>
                        
                        <div class="register-link m-t-15 text-center mt-40">
                            <p>Already have account ? <a href="#"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
