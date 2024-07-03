@extends('layouts.app')

@section('content')
<div class="container-fluid imagen">
    <div class="row">
        <div class="col-12 welcome-text">
            <h1>Bienvenidos a Nuestra Biblioteca</h1>
            <p>Un mundo del conocimiento y aventuras te espera.</p>
            <a href="{{ route('libros.index') }}" class="btn btn-custom btn-lg">Explorar Ahora</a>


        </div>
    </div>
</div>

<style>
    .imagen {
        background-image: url('https://png.pngtree.com/background/20230426/original/pngtree-an-old-library-has-wooden-step-leading-to-stairs-picture-image_2486870.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        /* Ajusta la altura del contenedor */
        color: rgb(241, 226, 158);
        /* Texto en blanco */
        display: flex;
        align-items: center;
        /* Centra el contenido verticalmente */
        justify-content: center;
        /* Centra el contenido horizontalmente */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        /* Sombra de texto */
        /* Ajusta la altura del contenedor */
    }

    .welcome-text {
        text-align: center;
    }

    .welcome-text h1 {
        font-size: 4rem;
    }

    .welcome-text p {
        font-size: 2rem;
    }

    .btn-custom {
        background-color: #ff6f61;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #ff4a3d;
    }
</style>

@endsection