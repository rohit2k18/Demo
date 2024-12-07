<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Trezix Product" />
    <meta name="keywords" content="Trezix Product">

    <title>Trezix Products</title>
    <link rel="shortcut icon" href="/storage/app/public/image/favicon.ico" type="image/x-icon">
    <!--<link rel="icon" href="/storage/app/public/image/favicon.ico" type="image/x-icon">-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/welcome.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    
</head>

<body class="lightbody" id="body">

    <div class="wrapper">
        @if(session()->has('success'))
        <span class="valid-feedback">
            <strong><i class="fa-regular fa-circle-check"></i> {{ session()->get('success') }}</strong>
        </span>
        @endif
        @if(session()->has('error'))
        <span class="invalid-feedback" role="alert">
            <strong><i class="fa-regular fa-circle-xmark"></i> {{ session()->get('error') }}</strong>
        </span>
        @endif
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <!-- Login Form Part -->
                <form action="{{route('login')}}" method="POST" class="login">
                    @csrf
                    <div class="field">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email Address" required>
                        @error('email')
                            <span class="invalid-feedback mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="rememberme"><input type="checkbox" name="rememberme" id="rememberme">Remember Me  </label>
                    </div>
                    <!-- <div class="pass-link"><a href="#">Forgot password?</a></div> -->
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <button type="submit" class="btn" >Login</button>
                    </div>
                    <div class="signup-link">Not a member? <a href="">Signup now</a></div>
                </form>

                <!-- Signup Form Part -->
                <form action="{{route('signup')}}" method="POST" class="signup">
                    @csrf
                    <div class="field">
                        <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Your Name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <input type="email" name="email" id="signup_email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email Address" required>
                        @error('email')
                            <span class="invalid-feedback mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <input type="password" name="password" id="signup_password" class="@error('password') is-invalid @enderror" placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="@error('password_confirmation') is-invalid @enderror" placeholder="Confirm password" required>
                    </div>
                    <div class="field">
                        <select name="user_role" id="signup_user_role" class="@error('user_role') is-invalid @enderror" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="admin" {{ old('user_role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('user_role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('user_role')
                            <span class="invalid-feedback mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <button type="submit" class="btn" >Signup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /#wrapper -->
    <!-- jQuery -->

    <script src="{{asset('js/lazysizes.min.js')}}" async=""></script>
    <script src="{{asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");

        const signupActive = {{ session('signup') ? 'true' : 'false' }};

        if (signupActive) {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
            $('#signup').prop('checked',true);
            $('#login').prop('checked',false);
        }

        signupBtn.onclick = (()=>{
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (()=>{
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (()=>{
            signupBtn.click();
            return false;
        });
    </script>
</body>

</html>