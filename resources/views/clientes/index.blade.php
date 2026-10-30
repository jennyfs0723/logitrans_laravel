<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Clientes - Logitrans</title>
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
            <h1 class="mb-4">Gestión de Clientes</h1>

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
                <a href="{{ route('clientes.create') }}" class="btn btn-success fw-bold">+ Nuevo cliente</a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover align-middle">
                    <thead>
                        <tr style="--bs-table-bg: #011f27; color: #ffffff;">
                            <th>Código</th>
                            <th>Nombre / Razón Social</th>
                            <th>RUT / DNI</th>
                            <th>Tipo</th>
                            <th>Teléfono</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr>
                                <td class="fw-bold">{{ $cliente->codigo_unico }}</td>
                                <td>{{ $cliente->nombre_o_razon_social }}</td>
                                <td>{{ $cliente->rut_o_dni }}</td>
                                <td class="text-capitalize">{{ $cliente->tipo_cliente }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td class="text-end">
                                    <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar este cliente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Todavía no hay clientes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($clientes->hasPages())
                <div class="mt-3">
                    {{ $clientes->links() }}
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