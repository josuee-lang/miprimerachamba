@extends('layouts.app')

@section('template_title')
    Registrar Préstamo
@endsection

@section('content')
<div class="ontainer-fluid imagen vh-100 ">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="text-center mb-4">
                    <a href="{{ route('libros.index') }}" class="btn btn-primary">{{ __('Regresar al Inicio') }}</a>
                </div>
            @endif

            <div class="card shadow customt">
                <div class="card-header bg-primary text-white text-center">
                    <h4>{{ __('PRESTAR LIBRO') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('prestamos.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="libro_id" class="form-label">{{ __('Libro') }}</label>
                                    <select name="libro_id" class="form-control @error('libro_id') is-invalid @enderror" id="libro_id">
                                        <option value="">Seleccione un libro</option>
                                        @foreach($libros as $libro)
                                            <option value="{{ $libro->id }}" {{ old('libro_id', $prestamo?->libro_id) == $libro->id ? 'selected' : '' }}>
                                                {{ $libro->titulo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('libro_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="user_id" class="form-label">{{ __('Usuario') }}</label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                        <option value="">Seleccione un usuario</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $prestamo?->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="prestado_el" class="form-label">{{ __('Prestado El') }}</label>
                                    <input type="date" name="prestado_el" class="form-control @error('prestado_el') is-invalid @enderror" value="{{ old('prestado_el', $prestamo?->prestado_el) }}" id="prestado_el">
                                    {!! $errors->first('prestado_el', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="vencimiento_el" class="form-label">{{ __('Vencimiento El') }}</label>
                                    <input type="date" name="vencimiento_el" class="form-control @error('vencimiento_el') is-invalid @enderror" value="{{ old('vencimiento_el', $prestamo?->vencimiento_el) }}" id="vencimiento_el">
                                    {!! $errors->first('vencimiento_el', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100">{{ __('Registrar Préstamo') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .customt{
        margin-top: 10rem;
    }
    .imagen {
        background-image: url('https://static.vecteezy.com/ti/foto-gratuito/t1/3313160-vista-frontale-di-elegante-biblioteca-con-scale-foto.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var prestadoEl = document.getElementById('prestado_el');
        var vencimientoEl = document.getElementById('vencimiento_el');

        // Escuchar cambios en el campo de fecha de préstamo
        prestadoEl.addEventListener('change', function() {
            var fechaPrestamo = new Date(this.value); // Obtener la fecha de préstamo seleccionada
            var fechaVencimiento = new Date(fechaPrestamo.getTime() + (30 * 24 * 60 * 60 * 1000)); // Calcular la fecha de vencimiento (30 días después)

            // Formatear la fecha de vencimiento como YYYY-MM-DD para establecerla en el campo de fecha
            var vencimientoFormatted = fechaVencimiento.toISOString().split('T')[0];
            vencimientoEl.value = vencimientoFormatted;
        });
    });
</script>
@endsection
