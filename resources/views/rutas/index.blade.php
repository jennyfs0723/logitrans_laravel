<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Rutas de Distribución - Logitrans</title>
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
            <h1 class="mb-4">Rutas de Distribución</h1>

           
            @if (session('error'))
                <div class="alert alert-dismissible fade show mb-4 border" style="background-color: #2a1215; border-color: #5c1d24 !important; color: #ffb3b8;" role="alert">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <!-- Alerta de Éxito -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 bg-success text-white mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <div>
                            <strong>¡Éxito!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-end mb-4">
                <a href="{{ route('rutas.create') }}" class="btn btn-success fw-bold">+ Nueva Ruta</a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover align-middle">
                    <thead>
                        <tr style="--bs-table-bg: #011f27; color: #ffffff;">
                            <th>Código</th>
                            <th>Nombre de la Ruta</th>
                            <th>Zona Geográfica</th>
                            <th>Distancia (km)</th>
                            <th>Tiempo (horas)</th>
                            <th>Vehículo</th>
                            <th>Conductor</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rutas as $ruta)
                            <tr>
                                <td class="fw-bold text-info">{{ $ruta->codigo }}</td>
                                <td>{{ $ruta->nombre_ruta }}</td>
                                <td>{{ $ruta->zona_geografica }}</td>
                                <td>{{ $ruta->distancia_total_km }} km</td>
                                <td>{{ $ruta->tiempo_estimado }} horas</td>
                                <td>{{ $ruta->vehiculo?->placa ?? 'Sin vehículo' }}</td>
                                <td>{{ $ruta->conductor?->nombres ?? 'Sin conductor' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('rutas.show', $ruta) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                    <a href="{{ route('rutas.edit', $ruta) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('rutas.destroy', $ruta) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar esta ruta?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No hay rutas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($rutas->hasPages())
                <div class="mt-3">{{ $rutas->links() }}</div>
            @endif

            <div class="mt-4 mb-5">
                <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-light">Volver al panel</a>
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successAlert = document.querySelector('.alert-success');
                if (successAlert) {
                    setTimeout(() => {
                        const alertInstance = bootstrap.Alert.getOrCreateInstance(successAlert);
                        if (alertInstance) alertInstance.close();
                    }, 4000);
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>