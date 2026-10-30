<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Seguimiento de Envíos - Logitrans</title>
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
            <h1 class="mb-4">Seguimiento de Envíos</h1>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="text-end mb-4">
                <a href="{{ route('seguimientos.create') }}" class="btn btn-success fw-bold">+ Nueva Novedad</a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover align-middle">
                    <thead>
                        <tr style="--bs-table-bg: #011f27; color: #ffffff;">
                            <th>Fecha y Hora</th>
                            <th>N° Guía</th>
                            <th>Ubicación</th>
                            <th>Actividad</th>
                            <th>Conductor</th>
                            <th>Observaciones</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($seguimientos as $seg)
                            <tr>
                                <td>{{ $seg->fecha_hora ? $seg->fecha_hora->format('d/m/Y h:i A') : 'N/A' }}</td>
                                <td class="fw-bold text-info">{{ $seg->envio?->numero_guia ?? 'Sin guía' }}</td>
                                <td>{{ $seg->ubicacion }}</td>
                                <td>
                                    @if($seg->actividad_realizada === 'recibido')
                                        <span class="badge bg-warning text-dark">Recibido</span>
                                    @elseif($seg->actividad_realizada === 'en transito')
                                        <span class="badge bg-primary">En Tránsito</span>
                                    @elseif($seg->actividad_realizada === 'almacen')
                                        <span class="badge bg-info text-dark">En Almacén</span>
                                    @else
                                        <span class="badge bg-success">Entregado</span>
                                    @endif
                                </td>
                                <td>{{ $seg->conductor?->nombres }} {{ $seg->conductor?->apellidos }}</td>
                                <td>{{ Str::limit($seg->observaciones, 30) }}</td>
                                <!-- Celda de Acciones Corregida (text-nowrap + d-flex) -->
                                <td class="text-end text-nowrap">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <a href="{{ route('seguimientos.show', $seg) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                        <a href="{{ route('seguimientos.edit', $seg) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                        <form action="{{ route('seguimientos.destroy', $seg) }}" method="POST" class="d-inline m-0"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No hay novedades de seguimiento registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($seguimientos->hasPages())
                <div class="mt-3">{{ $seguimientos->links() }}</div>
            @endif

            <div class="mt-4 mb-5">
                <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-light">Volver al panel</a>
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const alert = document.querySelector('.alert-success');
                if (alert) {
                    setTimeout(() => {
                        bootstrap.Alert.getOrCreateInstance(alert).close();
                    }, 1000);
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>