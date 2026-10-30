<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Gestión de Vehículos - Logitrans</title>
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
            <h1 class="mb-4">Gestión de Vehículos</h1>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="text-end mb-4">
                <a href="{{ route('vehiculos.create') }}" class="btn btn-success fw-bold">+ Nuevo Vehículo</a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover align-middle">
                    <thead>
                        <tr style="--bs-table-bg: #011f27; color: #ffffff;">
                            <th>Placa</th>
                            <th>Registro Único</th>
                            <th>Marca / Modelo</th>
                            <th>Tipo</th>
                            <th>Capacidad (kg)</th>
                            <th>Km Actual</th>
                            <th>Estado Operativo</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehiculos as $vehiculo)
                            <tr>
                                <td class="fw-bold text-info">{{ $vehiculo->numero_placa }}</td>
                                <td>{{ $vehiculo->registro_unico }}</td>
                                <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->anio }})</td>
                                <td><span class="badge bg-secondary">{{ ucfirst($vehiculo->tipo_vehiculo) }}</span></td>
                                <td>{{ number_format($vehiculo->capacidad_carga, 2) }} kg</td>
                                <td>{{ number_format($vehiculo->km_actual, 1) }} km</td>
                                <td>
                                    @if($vehiculo->estado_operativo === 'activo')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En Mantenimiento</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('vehiculos.show', $vehiculo) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                    <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este vehículo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No hay vehículos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($vehiculos->hasPages())
                <div class="mt-3">{{ $vehiculos->links() }}</div>
            @endif

            <div class="mt-4 mb-5">
                <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-light">Volver al panel</a>
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        bootstrap.Alert.getOrCreateInstance(alert).close();
                    }, 1000);
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>