<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transporte Escolar</title>

    <link rel="stylesheet" href="{{ asset('css/login_css/style.css') }}">
</head>

<body>
    <header>
        <h2 class="logo">BURGER MATCH</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
           {{--  <button class="btnLogin-popup" onclick="window.location.href='{{ route('register') }}'">Registrate</button> --}}
        </nav>
    </header>

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>
        <div class="form-box login">
            <h2>Login</h2>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="signin-form">
                @csrf

                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>

                    <input type="email" placeholder="Correo Electronico" id="email" type="email"
                        class="form-control
						  @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Enter a valid email address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>

                    <input id="password" type="password"
                        class="form-control
				                    @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <label for="password">Contraseña</label>
                </div>

                <div class="remember-forgot">
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Recordar cuenta') }}
                        </label>
                    </div>
                </div>
                <div class="login-register">

                    <button type="submit" class="btn" name="login">
                        {{ __('Iniciar Sesion') }}
                    </button>
                    @if (Route::has('password.request'))
                        <br>
                    @endif
                    {{-- <p class="small fw-bold mt-2 pt-1 mb-0">No tienes una cuenta? <br> <a class="register-link"
                            href="{{ route('register') }}" class="link-danger">Registrate</a></p> --}}
                </div>

            </form>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->

    {{-- <script src="script.js"></script> --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
