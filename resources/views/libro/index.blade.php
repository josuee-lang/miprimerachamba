@extends('layouts.app')

@section('template_title')
    Libros
@endsection

@section('content')
<div class="imagen">
    <div class="container-fluid">
        <!-- Formulario de búsqueda y filtros -->
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-center">
                <form action="{{ route('libros.index') }}" method="GET" class="form-inline">
                    <div class="row mt-5">
                        <div class="col-md-8 col-12">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar por título" aria-label="Buscar por título">
                                <button class="btn btn-outline-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mt-md-0 mt-2">
                            <div class="input-group">
                                <select class="form-select" name="genre">
                                    <option value="" selected disabled>Género</option>
                                    <option value="Realismo mágico">Realismo mágico</option>
                                    <option value="Distopía">Distopía</option>
                                    <option value="Novela">Novela</option>
                                    <option value="Fantasía">Fantasía</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Listado de libros -->
        <div class="row">
            @foreach($libros as $libro)
            <div class="col-lg-4 col-md-6 col-12 mt-5">
                <div class="card bg-light" style="border: 2px solid #414040; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <img src="{{ asset('storage/' . $libro->imagen) }}" class="card-img-top img-fluid img-small" alt="Imagen del libro">
                    <div class="card-body">
                        <h4 class="card-title" style="color: #2C3E50;">{{ $libro->titulo }}</h4>
                        <h6 class="card-subtitle mb-2"><strong>Autor:</strong> {{ $libro->autor }}</h6>
                        <p class="card-text"><strong>Género:</strong> {{ $libro->genero }}</p>
                        <p class="card-text"><strong>ISBN:</strong> {{ $libro->isbn }}</p>
                        <p class="card-text"><strong>Copias disponibles:</strong> {{ $libro->copias }}</p>
                        <div class="d-grid gap-2">
                            @if ($libro->copias > 0)
                                <a href="{{ route('prestamos.create') }}" class="btn btn-success" style="background-color: #27AE60; border-color: #27AE60;">Préstamo</a>
                            @else
                                <a href="{{ route('reservars.create') }}" class="btn btn-primary mb-2" style="background-color: #2980B9; border-color: #2980B9;">Reservar</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row bg-dark mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $libros->links() }}
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">
                {{ __('Libro') }}
            </span>
            <div class="float-right">
                <a href="{{ route('libros.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                  {{ __('Create New') }}
                </a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success m-4">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card-body bg-white">
        <div class="table-responsive">
            @php $i = 0; @endphp
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Imagen</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Genero</th>
                        <th>Isbn</th>
                        <th>Copias</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($libros as $libro)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                @if($libro->imagen)
                                    <img src="{{ asset('storage/' . $libro->imagen) }}" alt="Imagen del libro" width="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->genero }}</td>
                            <td>{{ $libro->isbn }}</td>
                            <td>{{ $libro->copias }}</td>
                            <td>
                                <form action="{{ route('libros.destroy',$libro->id) }}" method="POST">
                                    <a class="btn btn-sm btn-primary" href="{{ route('libros.show',$libro->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                    <a class="btn btn-sm btn-success" href="{{ route('libros.edit',$libro->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{!! $libros->links() !!}
<style>
    .img-small {
        width: 100px;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .imagen {
        background-image: url('https://c4.wallpaperflare.com/wallpaper/839/50/541/library-cartoon-books-candles-wallpaper-preview.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        color: rgb(241, 226, 158);
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
</style>

@endsection
