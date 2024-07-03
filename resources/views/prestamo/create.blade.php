@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Prestamo
@endsection

@section('content')
<form method="POST" action="{{ route('prestamos.store') }}"  role="form" enctype="multipart/form-data">
    @csrf
    @include('prestamo.form')
</form>
@endsection
