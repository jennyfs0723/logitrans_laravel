<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Detalle Cliente - Logitrans</title>
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
            <h1 class="mb-4">Detalles del Cliente</h1>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><strong>Código:</strong> {{ $cliente->codigo_unico }}</div>
                        <div class="col-md-6"><strong>Tipo:</strong> <span class="text-capitalize">{{ $cliente->tipo_cliente }}</span></div>
                        <div class="col-md-6"><strong>Nombre/Razón Social:</strong> {{ $cliente->nombre_o_razon_social }}</div>
                        <div class="col-md-6"><strong>RUT/DNI:</strong> {{ $cliente->rut_o_dni }}</div>
                        <div class="col-md-6"><strong>Teléfono:</strong> {{ $cliente->telefono }}</div>
                        <div class="col-md-6"><strong>Email:</strong> {{ $cliente->email }}</div>
                        <div class="col-12"><strong>Dirección Fiscal:</strong> {{ $cliente->direccion_fiscal }}</div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-light">
                    <h5 class="mb-0">Envíos Registrados ({{ $cliente->envios->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($cliente->envios->isEmpty())
                        <p class="text-muted mb-0">Este cliente no ha realizado envíos.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($cliente->envios as $envio)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><strong>Guía:</strong> {{ $envio->numero_guia }} | <strong>Destinatario:</strong> {{ $envio->destinatario }}</span>
                                    <span class="badge bg-primary">{{ $envio->estado_actual }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-outline-primary">Volver al listado</a>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>