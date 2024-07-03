<div class="container-fluid imagen vh-100 ">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow customt">
                <div class="card-header bg-primary text-white d-flex justify-content-center">
                    <h4>{{ __('RESERVAR LIBRO') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservars.store') }}" method="POST">
                        @csrf

                        <!-- Campo para seleccionar usuarios -->
                        <div class="form-group mb-3">
                            <label for="user_id" class="form-label">{{ __('Usuario') }}</label>
                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                <option value="">Seleccione un usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $reservar?->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Campo para seleccionar libros -->
                        <div class="form-group mb-3">
                            <label for="libro_id" class="form-label">{{ __('Libro') }}</label>
                            <select name="libro_id" class="form-control @error('libro_id') is-invalid @enderror" id="libro_id">
                                <option value="">Seleccione un libro</option>
                                @foreach($libros as $libro)
                                    <option value="{{ $libro->id }}" {{ old('libro_id', $reservar?->libro_id) == $libro->id ? 'selected' : '' }}>
                                        {{ $libro->titulo }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('libro_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Campo de fecha de reserva -->
                        <div class="form-group mb-3">
                            <label for="reservar_at" class="form-label">{{ __('Fecha de Reserva') }}</label>
                            <input type="date" name="reservar_at" class="form-control @error('reservar_at') is-invalid @enderror" value="{{ old('reservar_at', $reservar?->reservar_at) }}" id="reservar_at" placeholder="Fecha de Reserva">
                            {!! $errors->first('reservar_at', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Campo de estado oculto -->
                        <input type="hidden" name="status" value="pendiente">

                        <!-- Botón de envío -->
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-success w-100">{{ __('Reservar') }}</button>
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
        background-image: url('https://img.freepik.com/fotos-premium/filas-libros-estantes-biblioteca-espacio-desarrollo-al-generado_866663-10641.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    
    }
</style>