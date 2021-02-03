<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <!-- Font Icon -->
<link rel="apple-touch-icon" sizes="76x76" href="{{asset("assets/img/logo.png")}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset("assets/img/logo.png")}}">
<link rel="stylesheet" href="{{asset('colorlib/fonts/material-icon/css/material-design-iconic-font.min.css')}}">
<!-- Main css -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{asset('colorlib/css/style.css')}}">
</head>
<body>
    <div class="box">
        <div class="box-body">
    @if(Session::has('sukses'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					{{ Session::get('sukses') }}
				</div>
				@endif
                @if(Session::has('gagal'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
					{{ Session::get('gagal') }}
				</div>
                @endif
                </div>
            </div>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign Up</h2>
                        <form method="POST" action="{{ '/postregister' }}" class="register-form" id="register-form">
                                {{ csrf_field() }}
                            <div class="form-group" {{ $errors->has('name') ? ' has-error' : '' }}>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your Name" required autofocus/>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="form-group" {{ $errors->has('email') ? ' has-error' : '' }} >
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Your Email"/>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="form-group" {{ $errors->has('password') ? ' has-error' : '' }}>
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password"/>
                            </div>
                            {{-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> --}}
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{asset('colorlib/images/signup-image.jpg')}}" alt="sing up image"></figure>
                        <a href="/login" class="signup-image-link">I am already have an account</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
