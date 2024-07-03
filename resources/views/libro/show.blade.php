@extends('layouts.app')

@section('template_title')
    {{ $libro->name ?? __('Show') . " " . __('Libro') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Libro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('libros.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Titulo:</strong>
                            {{ $libro->titulo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Autor:</strong>
                            {{ $libro->autor }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Genero:</strong>
                            {{ $libro->genero }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Isbn:</strong>
                            {{ $libro->isbn }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Copias:</strong>
                            {{ $libro->copias }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
