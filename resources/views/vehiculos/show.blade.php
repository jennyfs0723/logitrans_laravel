<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Detalle de Vehículo - Logitrans</title>
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
            <h1 class="mb-4">Detalle del Vehículo <span class="text-info">{{ $vehiculo->numero_placa }}</span></h1>

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <span class="text-muted d-block">Registro Único:</span>
                            <strong>{{ $vehiculo->registro_unico }}</strong>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted d-block">Estado Operativo:</span>
                            <span class="badge {{ $vehiculo->estado_operativo === 'activo' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($vehiculo->estado_operativo) }}
                            </span>
                        </div>

                        <hr class="my-3 border-secondary">

                        <div class="col-md-4">
                            <span class="text-muted d-block">Marca:</span>
                            <strong>{{ $vehiculo->marca }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Modelo:</span>
                            <strong>{{ $vehiculo->modelo }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Año:</span>
                            <strong>{{ $vehiculo->anio }}</strong>
                        </div>

                        <div class="col-md-4">
                            <span class="text-muted d-block">Tipo de Vehículo:</span>
                            <span class="badge bg-secondary fs-6">{{ ucfirst($vehiculo->tipo_vehiculo) }}</span>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Capacidad de Carga:</span>
                            <strong>{{ number_format($vehiculo->capacidad_carga, 2) }} kg</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Consumo Promedio:</span>
                            <strong>{{ number_format($vehiculo->consumo_promedio_combustible, 2) }}</strong>
                        </div>

                        <hr class="my-3 border-secondary">

                        <div class="col-md-4">
                            <span class="text-muted d-block">Kilometraje Actual:</span>
                            <strong>{{ number_format($vehiculo->km_actual, 1) }} km</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Fecha de Adquisición:</span>
                            <strong>{{ $vehiculo->fecha_adquisicion ? $vehiculo->fecha_adquisicion->format('d/m/Y') : 'N/A' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Rutas Asignadas:</span>
                            <strong>{{ $vehiculo->rutas->count() }} ruta(s) activa(s)</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mb-5">
                <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-warning fw-bold">Editar Vehículo</a>
                <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-light">Volver al listado</a>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>