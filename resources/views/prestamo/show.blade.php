@extends('layouts.app')

@section('template_title')
    {{ $prestamo->name ?? __('Show') . " " . __('Prestamo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Prestamo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('prestamos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Libro Id:</strong>
                            {{ $prestamo->libro_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>User Id:</strong>
                            {{ $prestamo->user_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Prestado El:</strong>
                            {{ $prestamo->prestado_el }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Vencimiento El:</strong>
                            {{ $prestamo->vencimiento_el }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Devuelto El:</strong>
                            {{ $prestamo->devuelto_el }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
