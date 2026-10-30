<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Detalle del Envío - Logitrans</title>
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
            <h1 class="mb-4">Detalle de la Guía <span class="text-info">{{ $envio->numero_guia }}</span></h1>

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><strong>Cliente:</strong> {{ $envio->cliente?->nombre_o_razon_social ?? 'N/A' }}</div>
                        <div class="col-md-6"><strong>Estado Actual:</strong> 
                            <span class="badge {{ $envio->estado_actual === 'entregado' ? 'bg-success' : ($envio->estado_actual === 'recibido' ? 'bg-warning text-dark' : 'bg-primary') }}">
                                {{ ucfirst($envio->estado_actual) }}
                            </span>
                        </div>
                        <div class="col-md-6"><strong>Remitente:</strong> {{ $envio->remitente }}</div>
                        <div class="col-md-6"><strong>Destinatario:</strong> {{ $envio->destinatario }}</div>
                        <div class="col-md-6"><strong>Dirección Origen:</strong> {{ $envio->direccion_origen }}</div>
                        <div class="col-md-6"><strong>Dirección Entrega:</strong> {{ $envio->direccion_entrega }}</div>
                        <div class="col-md-4"><strong>Tipo Servicio:</strong> {{ ucfirst($envio->tipo_servicio) }}</div>
                        <div class="col-md-4"><strong>Peso:</strong> {{ $envio->peso }} kg</div>
                        <div class="col-md-4"><strong>Dimensiones:</strong> {{ $envio->dimensiones }}</div>
                        <div class="col-md-4"><strong>Valor Declarado:</strong> ${{ number_format($envio->valor_declarado, 2) }}</div>
                        <div class="col-md-4"><strong>Costo Envío:</strong> ${{ number_format($envio->costo, 2) }}</div>
                        <div class="col-md-4"><strong>Forma de Pago:</strong> {{ $envio->forma_pago }}</div>
                        <div class="col-12"><strong>Contenido:</strong> {{ $envio->descripcion_contenido }}</div>
                        <div class="col-12"><strong>Instrucciones Especiales:</strong> {{ $envio->instrucciones_especiales ?? 'Ninguna' }}</div>
                    </div>
                </div>
            </div>

            <a href="{{ route('envios.index') }}" class="btn btn-sm btn-outline-light mb-5">Volver al listado</a>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>