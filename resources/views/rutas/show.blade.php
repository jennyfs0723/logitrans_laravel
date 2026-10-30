<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Detalle de Ruta - Logitrans</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logitrans_ico.ico') }}">

        <!-- Bootstrap CSS v5.3 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            crossorigin="anonymous"
        />
    </head>

    <body class="bg-dark text-light">
        <main class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detalle de Ruta: <span class="text-info">{{ $ruta->codigo }} - {{ $ruta->nombre_ruta }}</span></h1>
            </div>

            <!-- Información general de la ruta -->
            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-header bg-secondary bg-opacity-25 border-secondary fw-bold">
                    Información General de la Ruta
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <span class="text-muted d-block">Zona Geográfica:</span>
                            <strong>{{ $ruta->zona_geografica }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Distancia Total (km):</span>
                            <strong>{{ $ruta->distancia_total_km }} km</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Tiempo Estimado:</span>
                            <strong>{{ $ruta->tiempo_estimado }} horas</strong>
                        </div>

                        <hr class="my-3 border-secondary">

                        <div class="col-md-4">
                            <span class="text-muted d-block">Vehículo Asignado:</span>
                            <strong>{{ $ruta->vehiculo?->placa ?? 'Sin vehículo asignado' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Conductor Asignado:</span>
                            <strong>{{ $ruta->conductor?->nombre ?? 'Sin conductor asignado' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted d-block">Puntos Habituales:</span>
                            <strong>{{ $ruta->puntos_entrega_habituales }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Listado de Envíos asociados a la ruta (Soluciona el error de $envio) -->
            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-header bg-secondary bg-opacity-25 border-secondary fw-bold">
                    Envíos Asociados a esta Ruta
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>N° Guía</th>
                                    <th>Destinatario</th>
                                    <th>Dirección Entrega</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ruta->envios as $envio)
                                    <tr>
                                        <td>{{ $envio->numero_guia }}</td>
                                        <td>{{ $envio->destinatario }}</td>
                                        <td>{{ $envio->direccion_entrega }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($envio->estado_actual === 'recibido') bg-warning text-dark
                                                @elseif($envio->estado_actual === 'en transito') bg-primary
                                                @else bg-success @endif">
                                                {{ ucfirst($envio->estado_actual) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('envios.show', $envio) }}" class="btn btn-sm btn-outline-info fw-bold">Ver Guía</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">No hay envíos asociados a esta ruta de distribución.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mb-5">
                <a href="{{ route('rutas.index') }}" class="btn btn-outline-light">Volver al listado de rutas</a>
            </div>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>