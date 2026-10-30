<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Editar Envío - Logitrans</title>
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
            <h1 class="mb-4">Editar Envío</h1>

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <form action="{{ route('envios.update', $envio) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Número de Guía -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Número de Guía</label>
                                <input type="text" value="{{ $envio->numero_guia }}" class="form-control" disabled>
                                <input type="hidden" name="numero_guia" value="{{ $envio->numero_guia }}">
                            </div>

                            <!-- Cliente (Sincronizado con 'cliente_id') -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Cliente</label>
                                <select name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id', $envio->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre_o_razon_social }} ({{ $cliente->rut_o_dni }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Estado Actual -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Estado Actual</label>
                                <select name="estado_actual" class="form-select @error('estado_actual') is-invalid @enderror" required>
                                    <option value="recibido" {{ old('estado_actual', $envio->estado_actual) == 'recibido' ? 'selected' : '' }}>Recibido</option>
                                    <option value="en transito" {{ old('estado_actual', $envio->estado_actual) == 'en transito' ? 'selected' : '' }}>En Tránsito</option>
                                    <option value="entregado" {{ old('estado_actual', $envio->estado_actual) == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                </select>
                                @error('estado_actual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Remitente -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Remitente</label>
                                <input type="text" name="remitente" value="{{ old('remitente', $envio->remitente) }}" class="form-control @error('remitente') is-invalid @enderror" required>
                                @error('remitente') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Destinatario -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Destinatario</label>
                                <input type="text" name="destinatario" value="{{ old('destinatario', $envio->destinatario) }}" class="form-control @error('destinatario') is-invalid @enderror" required>
                                @error('destinatario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Dirección de Origen -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Dirección de Origen</label>
                                <input type="text" name="direccion_origen" value="{{ old('direccion_origen', $envio->direccion_origen) }}" class="form-control @error('direccion_origen') is-invalid @enderror" required>
                                @error('direccion_origen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Dirección de Entrega -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Dirección de Entrega</label>
                                <input type="text" name="direccion_entrega" value="{{ old('direccion_entrega', $envio->direccion_entrega) }}" class="form-control @error('direccion_entrega') is-invalid @enderror" required>
                                @error('direccion_entrega') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Tipo de Servicio -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tipo de Servicio</label>
                                <select name="tipo_servicio" class="form-select @error('tipo_servicio') is-invalid @enderror" required>
                                    <option value="normal" {{ old('tipo_servicio', $envio->tipo_servicio) == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="express" {{ old('tipo_servicio', $envio->tipo_servicio) == 'express' ? 'selected' : '' }}>Express</option>
                                    <option value="mismo dia" {{ old('tipo_servicio', $envio->tipo_servicio) == 'mismo dia' ? 'selected' : '' }}>Mismo Día</option>
                                </select>
                                @error('tipo_servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Forma de Pago (Requerida en tu controlador) -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Forma de Pago</label>
                                <select name="forma_pago" class="form-select @error('forma_pago') is-invalid @enderror" required>
                                    <option value="contra entrega" {{ old('forma_pago', $envio->forma_pago) == 'contra entrega' ? 'selected' : '' }}>Contra Entrega</option>
                                    <option value="transferencia" {{ old('forma_pago', $envio->forma_pago) == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                    <option value="efectivo" {{ old('forma_pago', $envio->forma_pago) == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                    <option value="tarjeta" {{ old('forma_pago', $envio->forma_pago) == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                </select>
                                @error('forma_pago') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Peso -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Peso (kg)</label>
                                <input type="number" step="0.01" name="peso" value="{{ old('peso', $envio->peso) }}" class="form-control @error('peso') is-invalid @enderror" required>
                                @error('peso') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Descripción del Contenido -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Descripción del Contenido</label>
                                <input type="text" name="descripcion_contenido" value="{{ old('descripcion_contenido', $envio->descripcion_contenido) }}" class="form-control @error('descripcion_contenido') is-invalid @enderror" required>
                                @error('descripcion_contenido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Dimensiones -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Dimensiones</label>
                                <input type="text" name="dimensiones" value="{{ old('dimensiones', $envio->dimensiones) }}" class="form-control @error('dimensiones') is-invalid @enderror" required>
                                @error('dimensiones') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Valor Declarado -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Valor Declarado ($)</label>
                                <input type="number" step="0.01" name="valor_declarado" value="{{ old('valor_declarado', $envio->valor_declarado) }}" class="form-control @error('valor_declarado') is-invalid @enderror" required>
                                @error('valor_declarado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Costo del Envío -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Costo del Envío ($)</label>
                                <input type="number" step="0.01" name="costo" value="{{ old('costo', $envio->costo) }}" class="form-control @error('costo') is-invalid @enderror" required>
                                @error('costo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Instrucciones Especiales -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Instrucciones Especiales</label>
                                <input type="text" name="instrucciones_especiales" value="{{ old('instrucciones_especiales', $envio->instrucciones_especiales) }}" class="form-control @error('instrucciones_especiales') is-invalid @enderror">
                                @error('instrucciones_especiales') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('envios.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Actualizar Envío</button>
                        </div>
                    </form>
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