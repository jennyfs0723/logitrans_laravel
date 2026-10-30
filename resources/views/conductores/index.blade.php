<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Conductores - Logitrans</title>
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
            <h1 class="mb-4">Gestión de Conductores</h1>

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
                <a href="{{ route('conductores.create') }}" class="btn btn-success fw-bold">+ Nuevo conductor</a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover align-middle">
                    <thead>
                        <tr style="--bs-table-bg: #011f27; color: #ffffff;">
                            <th>Código</th>
                            <th>Nombre Completo</th>
                            <th>Documento</th>
                            <th>Licencia</th>
                            <th>Vencimiento</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($conductores as $conductor)
                            <tr>
                                <td class="fw-bold">{{ $conductor->codigo_empleado }}</td>
                                <td>{{ $conductor->nombres }} {{ $conductor->apellidos }}</td>
                                <td>{{ $conductor->documento_identidad }}</td>
                                <td><span class="badge bg-secondary">{{ $conductor->tipo_licencia }}</span></td>
                                <td>{{ $conductor->fecha_vencimiento_licencia?->format('d/m/Y') }}</td>
                                <td>
                                    @if($conductor->estado_conductor === 'disponible')
                                        <span class="badge bg-success">Disponible</span>
                                    @elseif($conductor->estado_conductor === 'en ruta')
                                        <span class="badge bg-primary">En Ruta</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Descanso</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('conductores.show', $conductor) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                    <a href="{{ route('conductores.edit', $conductor) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('conductores.destroy', $conductor) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar este conductor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Todavía no hay conductores registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($conductores->hasPages())
                <div class="mt-3">
                    {{ $conductores->links() }}
                </div>
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
                        alertInstance.close();
                    }, 1000); // Se oculta automáticamente a los 3 segundos (3000 ms)
                }
            });
        </script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>