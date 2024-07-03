@extends('layouts.app')

@section('content')
<div class="container-fluid imagen">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card login-card">
                <div class="card-header bg-warning">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-8 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">Login</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .imagen {
        background-image: url('https://img.freepik.com/foto-gratis/gran-coleccion-libros-antiguos-estanteria-madera-generada-inteligencia-artificial_188544-127262.jpg?w=900&t=st=1719703036~exp=1719703636~hmac=030e03bd2ef8f7312ec6b762e9a6369293c102e332bb26380359c8256fc779c3');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        color: rgb(241, 226, 158);
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    .login-card {
        width: 500px;
        height: 300px;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.1);
        background-color: rgba(255, 255, 255, 0.9);
    }
    .card-header {
        color: white;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .form-check-label {
        padding-left: 1.25rem;
    }
</style>
@endsection
