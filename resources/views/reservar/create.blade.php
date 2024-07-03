@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Reservar
@endsection

@section('content')

<form method="POST" action="{{ route('reservars.store') }}"  role="form" enctype="multipart/form-data">
    @csrf
    @include('reservar.form')
</form>
<style>
    .fondo{
        background-image: url('https://img.freepik.com/foto-gratis/libros-antiguos-adornan-biblioteca-cuidadosamente-arreglados-clasicos-gemas-raras_157027-2332.jpg?w=900&t=st=1719610076~exp=1719610676~hmac=b3f9e619d7483d494963208ee5795f73c093342b9c6a18e221af9043f9de3570');
    }
</style>
                    
@endsection
