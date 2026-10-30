<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Gestión de Envíos - Logitrans</title>
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
            <h1 class="mb-4">Gestión de Envíos</h1>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #ffc107; color: #212529; font-weight: 500;">
                    <div class="d-flex align-items-center gap-2">
                        <!-- Icono de advertencia -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        <div>{{ session('warning') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-end mb-4">
                <a href="{{ route('envios.create') }}" class="btn btn-success fw-bold">+ Nuevo envío</a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover align-middle">
                    <thead>
                        <tr style="--bs-table-bg: #011f27; color: #ffffff;">
                            <th>N° Guía</th>
                            <th>Cliente</th>
                            <th>Origen</th>
                            <th>Entrega</th>
                            <th>Servicio</th>
                            <th>Costo</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($envios as $envio)
                            <tr>
                                <td class="fw-bold text-info">{{ $envio->numero_guia }}</td>
                                <td>{{ $envio->cliente?->nombre_o_razon_social ?? 'Sin cliente' }}</td>
                                <td>{{ $envio->direccion_origen }}</td>
                                <td>{{ $envio->direccion_entrega }}</td>
                                <td><span class="badge bg-secondary">{{ ucfirst($envio->tipo_servicio) }}</span></td>
                                <td>${{ number_format($envio->costo, 2) }}</td>
                                <td>
                                    @if($envio->estado_actual === 'recibido')
                                        <span class="badge bg-warning text-dark">Recibido</span>
                                    @elseif($envio->estado_actual === 'en transito')
                                        <span class="badge bg-primary">En Tránsito</span>
                                    @else
                                        <span class="badge bg-success">Entregado</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('envios.show', $envio) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                    <a href="{{ route('envios.edit', $envio) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('envios.destroy', $envio) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar este envío?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Todavía no hay envíos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($envios->hasPages())
                <div class="mt-3">
                    {{ $envios->links() }}
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
                    }, 1000);
                }
            });
        </script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>