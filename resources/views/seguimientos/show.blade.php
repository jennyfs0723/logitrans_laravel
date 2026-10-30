<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Detalle de Novedad - Logitrans</title>
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
            <h1 class="mb-4">Detalle de Novedad de Seguimiento</h1>

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <span class="text-muted d-block">Número de Guía:</span>
                            <strong class="text-info fs-5">{{ $seguimiento->envio?->numero_guia ?? 'Sin guía' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted d-block">Actividad Realizada:</span>
                            <span class="badge fs-6 
                                @if($seguimiento->actividad_realizada === 'recibido') bg-warning text-dark
                                @elseif($seguimiento->actividad_realizada === 'en transito') bg-primary
                                @elseif($seguimiento->actividad_realizada === 'almacen') bg-info text-dark
                                @else bg-success @endif">
                                {{ ucfirst($seguimiento->actividad_realizada) }}
                            </span>
                        </div>

                        <hr class="my-3 border-secondary">

                        <div class="col-md-6">
                            <span class="text-muted d-block">Fecha y Hora de Registro:</span>
                            <strong>{{ $seguimiento->fecha_hora ? $seguimiento->fecha_hora->format('d/m/Y h:i A') : 'N/A' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted d-block">Ubicación Reportada:</span>
                            <strong>{{ $seguimiento->ubicacion }}</strong>
                        </div>

                        <div class="col-md-6">
                            <span class="text-muted d-block">Conductor Responsable:</span>
                            <strong>{{ $seguimiento->conductor?->nombres }} {{ $seguimiento->conductor?->apellidos }}</strong>
                            <small class="text-muted">({{ $seguimiento->conductor?->licencia }})</small>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted d-block">Cliente Titular:</span>
                            <strong>{{ $seguimiento->envio?->cliente?->nombre_o_razon_social ?? 'N/A' }}</strong>
                        </div>

                        <div class="col-12 mt-3">
                            <span class="text-muted d-block">Observaciones:</span>
                            <p class="p-3 bg-secondary bg-opacity-10 rounded border border-secondary mb-0">
                                {{ $seguimiento->observaciones }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mb-5">
                <a href="{{ route('seguimientos.edit', $seguimiento) }}" class="btn btn-warning fw-bold">Editar Novedad</a>
                <a href="{{ route('seguimientos.index') }}" class="btn btn-outline-light">Volver al listado</a>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>