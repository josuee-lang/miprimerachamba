@extends('layouts.app')

@section('template_title')
    Historial de Reservas
@endsection

@section('content')
    <style>
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #6f42c1, #007bff);
            color: white;
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            background-color: #f8f9fa;
            padding: 2rem;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 1rem;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table-striped tbody tr {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .table-striped tbody tr:hover {
            background-color: #e9ecef;
        }

        .table th, .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table th {
            font-weight: bold;
        }

        .btn-primary, .btn-success, .btn-danger {
            border-radius: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
        .imagen {
            background-image: url('https://c4.wallpaperflare.com/wallpaper/839/50/541/library-cartoon-books-candles-wallpaper-preview.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: rgb(241, 226, 158);
            align-items: center;
            justify-content: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>

    <div class="container-fluid imagen">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <span id="card_title">
                            {{ __('Historial de Reservas') }}
                        </span>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-secondary">
                        <div class="table-responsive">
                            <table class="table table-success table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre del Usuario</th>
                                        <th>Nombre del Libro</th>
                                        <th>Reservado El</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservars as $reservar)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $reservar->user->name }}</td>
                                            <td>{{ $reservar->libro->titulo }}</td>
                                            <td>{{ $reservar->reservar_at }}</td>
                                            <td>{{ $reservar->status }}</td>
                                            <td>
                                                <form action="{{ route('reservars.destroy',$reservar->id) }}" method="POST">
                                                    <!--
                                                    <a class="btn btn-sm btn-primary " href="{{ route('reservars.show',$reservar->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reservars.edit',$reservar->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    -->
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('cancelar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                     
                                            
                                            

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $reservars->links() !!}
            </div>
        </div>
    </div>
@endsection
