<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Nueva Ruta - Logitrans</title>
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
            <h1 class="mb-4">Registrar Nueva Ruta</h1>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <h5 class="alert-heading fw-bold">Corrige los siguientes errores:</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <form action="{{ route('rutas.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <!-- Código Autogenerado -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Código de la Ruta</label>
                                <input type="text" class="form-control" value="Autogenerado" disabled>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold">Nombre de la Ruta</label>
                                <input type="text" name="nombre_ruta" value="{{ old('nombre_ruta') }}" placeholder="Ej: Ruta Norte - Aburrá" class="form-control @error('nombre_ruta') is-invalid @enderror" required>
                                @error('nombre_ruta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Zona Geográfica</label>
                                <input type="text" name="zona_geografica" value="{{ old('zona_geografica') }}" placeholder="Ej: Valle de Aburrá / Zona Norte" class="form-control @error('zona_geografica') is-invalid @enderror" required>
                                @error('zona_geografica') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Puntos de Entrega Habituales</label>
                                <input type="text" name="puntos_entrega_habituales" value="{{ old('puntos_entrega_habituales') }}" placeholder="Ej: Bello, Copacabana, Girardota" class="form-control @error('puntos_entrega_habituales') is-invalid @enderror" required>
                                @error('puntos_entrega_habituales') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Distancia Total (km)</label>
                                <input type="number" step="0.01" min="0" name="distancia_total_km" value="{{ old('distancia_total_km') }}" placeholder="Ej: 45.5" class="form-control @error('distancia_total_km') is-invalid @enderror" required>
                                @error('distancia_total_km') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Tiempo Estimado (horas)</label>
                                <input type="number" min="0" name="tiempo_estimado" value="{{ old('tiempo_estimado') }}" placeholder="Ej: 90" class="form-control @error('tiempo_estimado') is-invalid @enderror" required>
                                @error('tiempo_estimado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Vehículo Asignado</label>
                                <select name="vehiculo_id" class="form-select @error('vehiculo_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Seleccione vehículo...</option>
                                    @foreach($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                            {{ $vehiculo->placa }} ({{ $vehiculo->marca }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehiculo_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Conductor Asignado</label>
                                <select name="conductor_id" class="form-select @error('conductor_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Seleccione conductor...</option>
                                    @foreach($conductores as $conductor)
                                        <option value="{{ $conductor->id }}" {{ old('conductor_id') == $conductor->id ? 'selected' : '' }}>
                                            {{ $conductor->nombres }} {{ $conductor->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('conductor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('rutas.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success fw-bold">Guardar Ruta</button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="{{ route('rutas.index') }}" class="btn btn-sm btn-outline-light mb-5">Volver al listado</a>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>