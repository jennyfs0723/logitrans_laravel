<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Editar Seguimiento - Logitrans</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logitrans_ico.ico') }}">

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            crossorigin="anonymous"
        />
    </head>

    <body class="bg-dark text-light">
        <main class="container mt-5">
            <h1 class="mb-4">Editar Novedad de Seguimiento</h1>

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <form action="{{ route('seguimientos.update', $seguimiento) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Envío (Guía)</label>
                                <select name="envio_id" class="form-select @error('envio_id') is-invalid @enderror" required>
                                    @foreach($envios as $envio)
                                        <option value="{{ $envio->id }}" {{ old('envio_id', $seguimiento->envio_id) == $envio->id ? 'selected' : '' }}>
                                            {{ $envio->numero_guia }} - {{ $envio->remitente }} -> {{ $envio->destinatario }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('envio_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Conductor a Cargo</label>
                                <select name="conductor_id" class="form-select @error('conductor_id') is-invalid @enderror" required>
                                    @foreach($conductores as $conductor)
                                        <option value="{{ $conductor->id }}" {{ old('conductor_id', $seguimiento->conductor_id) == $conductor->id ? 'selected' : '' }}>
                                            {{ $conductor->nombres }} {{ $conductor->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('conductor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Ubicación Actual</label>
                                <input type="text" name="ubicacion" value="{{ old('ubicacion', $seguimiento->ubicacion) }}" maxlength="100" class="form-control @error('ubicacion') is-invalid @enderror" required>
                                @error('ubicacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Actividad Realizada</label>
                                <select name="actividad_realizada" class="form-select @error('actividad_realizada') is-invalid @enderror" required>
                                    <option value="recibido" {{ old('actividad_realizada', $seguimiento->actividad_realizada) == 'recibido' ? 'selected' : '' }}>Recibido</option>
                                    <option value="en transito" {{ old('actividad_realizada', $seguimiento->actividad_realizada) == 'en transito' ? 'selected' : '' }}>En Tránsito</option>
                                    <option value="almacen" {{ old('actividad_realizada', $seguimiento->actividad_realizada) == 'almacen' ? 'selected' : '' }}>En Almacén</option>
                                    <option value="entregado" {{ old('actividad_realizada', $seguimiento->actividad_realizada) == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                </select>
                                @error('actividad_realizada') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha y Hora</label>
                                <input type="datetime-local" name="fecha_hora" value="{{ old('fecha_hora', $seguimiento->fecha_hora?->format('Y-m-d\TH:i')) }}" class="form-control @error('fecha_hora') is-invalid @enderror" required>
                                @error('fecha_hora') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Observaciones</label>
                                <input type="text" name="observaciones" value="{{ old('observaciones', $seguimiento->observaciones) }}" maxlength="200" class="form-control @error('observaciones') is-invalid @enderror" required>
                                @error('observaciones') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('seguimientos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Actualizar Novedad</button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="{{ route('seguimientos.index') }}" class="btn btn-sm btn-outline-light mb-5">Volver al listado</a>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>