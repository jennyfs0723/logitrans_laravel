<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Editar Vehículo - Logitrans</title>
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
            <h1 class="mb-4">Editar Vehículo: <span class="text-warning">{{ $vehiculo->numero_placa }}</span></h1>

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
                    <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Registro Único del Vehículo</label>
                                <input type="text" name="registro_unico" value="{{ old('registro_unico', $vehiculo->registro_unico) }}" class="form-control @error('registro_unico') is-invalid @enderror" required>
                                @error('registro_unico') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Número de Placa</label>
                                <input type="text" name="numero_placa" value="{{ old('numero_placa', $vehiculo->numero_placa) }}" class="form-control @error('numero_placa') is-invalid @enderror" required>
                                @error('numero_placa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Marca</label>
                                <input type="text" name="marca" value="{{ old('marca', $vehiculo->marca) }}" class="form-control @error('marca') is-invalid @enderror" required>
                                @error('marca') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Modelo</label>
                                <input type="text" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}" class="form-control @error('modelo') is-invalid @enderror" required>
                                @error('modelo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Año</label>
                                <input type="number" name="anio" value="{{ old('anio', $vehiculo->anio) }}" min="1900" max="{{ date('Y') + 1 }}" class="form-control @error('anio') is-invalid @enderror" required>
                                @error('anio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Capacidad de Carga (kg)</label>
                                <input type="number" step="0.01" min="0" name="capacidad_carga" value="{{ old('capacidad_carga', $vehiculo->capacidad_carga) }}" class="form-control @error('capacidad_carga') is-invalid @enderror" required>
                                @error('capacidad_carga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Consumo Promedio Combustible</label>
                                <input type="number" step="0.01" min="0" name="consumo_promedio_combustible" value="{{ old('consumo_promedio_combustible', $vehiculo->consumo_promedio_combustible) }}" class="form-control @error('consumo_promedio_combustible') is-invalid @enderror" required>
                                @error('consumo_promedio_combustible') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha de Adquisición</label>
                                <input type="date" name="fecha_adquisicion" value="{{ old('fecha_adquisicion', $vehiculo->fecha_adquisicion?->format('Y-m-d')) }}" class="form-control @error('fecha_adquisicion') is-invalid @enderror" required>
                                @error('fecha_adquisicion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kilometraje Actual (km)</label>
                                <input type="number" step="0.01" min="0" name="km_actual" value="{{ old('km_actual', $vehiculo->km_actual) }}" class="form-control @error('km_actual') is-invalid @enderror" required>
                                @error('km_actual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipo de Vehículo</label>
                                <select name="tipo_vehiculo" class="form-select @error('tipo_vehiculo') is-invalid @enderror" required>
                                    <option value="camion" {{ old('tipo_vehiculo', $vehiculo->tipo_vehiculo) == 'camion' ? 'selected' : '' }}>Camión</option>
                                    <option value="furgoneta" {{ old('tipo_vehiculo', $vehiculo->tipo_vehiculo) == 'furgoneta' ? 'selected' : '' }}>Furgoneta</option>
                                    <option value="motocicleta" {{ old('tipo_vehiculo', $vehiculo->tipo_vehiculo) == 'motocicleta' ? 'selected' : '' }}>Motocicleta</option>
                                </select>
                                @error('tipo_vehiculo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Estado Operativo</label>
                                <select name="estado_operativo" class="form-select @error('estado_operativo') is-invalid @enderror" required>
                                    <option value="activo" {{ old('estado_operativo', $vehiculo->estado_operativo) == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="en mantenimiento" {{ old('estado_operativo', $vehiculo->estado_operativo) == 'en mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                                </select>
                                @error('estado_operativo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Actualizar Vehículo</button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="{{ route('vehiculos.index') }}" class="btn btn-sm btn-outline-light mb-5">Volver al listado</a>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>