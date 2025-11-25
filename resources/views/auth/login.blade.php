@extends('layouts.auth')
@section('title', __('lang_v1.login'))

@section('content')

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf
        @error('email')
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span id="errorMessage">{{ $message }}</span>
            </div>
        @enderror
        @error('password')
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span id="errorMessage">{{ $message }}</span>
            </div>
        @enderror

        <div class="form-group">
            <i class="fas fa-envelope input-icon"></i>
            <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico"
                required autofocus value="{{ old('email') }}" @error('email') is-invalid @enderror>
        </div>

        <div class="form-group">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            <i class="fas fa-eye password-toggle" onclick="mostrarContrasena()"></i>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-sign text-white" for="remember">
                Recuérdame
            </label>
        </div>

        <button type="submit" class="btn btn-login">
            <i class="fas fa-sign-in-alt mr-2"></i>
            Iniciar Sesión
        </button>
    </form>

@endsection
@push('javascript')
    <script type="text/javascript">
        function mostrarContrasena() {
            var tipo = document.getElementById("password");
            if (tipo.type == "password") {
                tipo.type = "text";
                $('.password-toggle').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                tipo.type = "password";
                $('.password-toggle').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>
@endpush
