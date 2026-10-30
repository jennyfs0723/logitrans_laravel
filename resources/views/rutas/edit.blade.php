<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Editar Ruta - Logitrans</title>
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
            <h1 class="mb-4">Editar Ruta: <span class="text-warning">{{ $ruta->codigo }}</span></h1>

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <form action="{{ route('rutas.update', $ruta) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Código de la Ruta</label>
                                <input type="text" name="codigo" value="{{ old('codigo', $ruta->codigo) }}" class="form-control @error('codigo') is-invalid @enderror" required>
                                @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold">Nombre de la Ruta</label>
                                <input type="text" name="nombre_ruta" value="{{ old('nombre_ruta', $ruta->nombre_ruta) }}" class="form-control @error('nombre_ruta') is-invalid @enderror" required>
                                @error('nombre_ruta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Zona Geográfica</label>
                                <input type="text" name="zona_geografica" value="{{ old('zona_geografica', $ruta->zona_geografica) }}" class="form-control @error('zona_geografica') is-invalid @enderror" required>
                                @error('zona_geografica') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Puntos de Entrega Habituales</label>
                                <input type="text" name="puntos_entrega_habituales" value="{{ old('puntos_entrega_habituales', $ruta->puntos_entrega_habituales) }}" class="form-control @error('puntos_entrega_habituales') is-invalid @enderror" required>
                                @error('puntos_entrega_habituales') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Distancia Total (km)</label>
                                <input type="number" step="0.01" min="0" name="distancia_total_km" value="{{ old('distancia_total_km', $ruta->distancia_total_km) }}" class="form-control @error('distancia_total_km') is-invalid @enderror" required>
                                @error('distancia_total_km') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Tiempo Estimado (min)</label>
                                <input type="number" min="0" name="tiempo_estimado" value="{{ old('tiempo_estimado', $ruta->tiempo_estimado) }}" class="form-control @error('tiempo_estimado') is-invalid @enderror" required>
                                @error('tiempo_estimado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Vehículo Asignado</label>
                                <select name="vehiculo_id" class="form-select @error('vehiculo_id') is-invalid @enderror" required>
                                    @foreach($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id', $ruta->vehiculo_id) == $vehiculo->id ? 'selected' : '' }}>
                                            {{ $vehiculo->placa }} ({{ $vehiculo->marca }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehiculo_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Conductor Asignado</label>
                                <select name="conductor_id" class="form-select @error('conductor_id') is-invalid @enderror" required>
                                    @foreach($conductores as $conductor)
                                        <option value="{{ $conductor->id }}" {{ old('conductor_id', $ruta->conductor_id) == $conductor->id ? 'selected' : '' }}>
                                            {{ $conductor->nombres }} {{ $conductor->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('conductor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('rutas.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Actualizar Ruta</button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="{{ route('rutas.index') }}" class="btn btn-sm btn-outline-light mb-5">Volver al listado</a>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>