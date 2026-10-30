<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Ficha Conductor - Logitrans</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logitrans_ico.ico') }}">

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <main class="container mt-5">
            <h1 class="mb-4">Ficha del Conductor</h1>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><strong>Código:</strong> {{ $conductor->codigo_empleado }}</div>
                        <div class="col-md-6"><strong>Documento:</strong> {{ $conductor->documento_identidad }}</div>
                        <div class="col-md-6"><strong>Nombre Completo:</strong> {{ $conductor->nombres }} {{ $conductor->apellidos }}</div>
                        <div class="col-md-6"><strong>Teléfono:</strong> {{ $conductor->telefono }}</div>
                        <div class="col-md-6"><strong>Tipo de Licencia:</strong> {{ $conductor->tipo_licencia }}</div>
                        <div class="col-md-6"><strong>Vencimiento Licencia:</strong> {{ $conductor->fecha_vencimiento_licencia?->format('d/m/Y') }}</div>
                        <div class="col-md-6"><strong>Años Experiencia:</strong> {{ $conductor->anios_experiencia }} años</div>
                        <div class="col-md-6"><strong>Estado:</strong> <span class="badge bg-success">{{ $conductor->estado_conductor }}</span></div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-light">
                    <h5 class="mb-0">Rutas Asignadas ({{ $conductor->rutas->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($conductor->rutas->isEmpty())
                        <p class="text-muted mb-0">Este conductor no tiene rutas asignadas.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($conductor->rutas as $ruta)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><strong>Ruta:</strong> {{ $ruta->nombre_ruta }} ({{ $ruta->codigo }})</span>
                                    <span class="badge bg-secondary">{{ $ruta->zona_geografica }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <a href="{{ route('conductores.index') }}" class="btn btn-sm btn-outline-primary mb-5">Volver al listado</a>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>