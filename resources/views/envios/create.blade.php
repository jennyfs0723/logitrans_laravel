<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Nuevo Envío - Logitrans</title>
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
        <main class="container mt-5 mb-5">
            <h1 class="mb-4">Registrar Nuevo Envío</h1>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <h5 class="alert-heading fw-bold">Por favor corrige los siguientes errores:</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <form action="{{ route('envios.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <!-- Número de Guía -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Número de Guía</label>
                                <input type="text" class="form-control" value="Autogenerado (ej: GUI-000001)" disabled>
                            </div>

                            <!-- Cliente -->
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Cliente Seleccionado</label>
                                <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Seleccione un cliente...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre_o_razon_social }} ({{ $cliente->rut_o_dni }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="mt-1">
                                    <small class="text-muted">
                                        ¿No estás registrado? 
                                        <a href="{{ route('clientes.create') }}" class="text-success fw-bold text-decoration-none">
                                            Regístrate aquí para generar tu envío
                                        </a>
                                    </small>
                                </div>
                                @error('cliente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Estado Inicial Fijo -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Estado Inicial</label>
                                <input type="text" class="form-control text-success fw-bold" value="Recibido" readonly>
                            </div>

                            <!-- Remitente y Destinatario -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Remitente (Quien envía)</label>
                                <input type="text" name="remitente" value="{{ old('remitente') }}" maxlength="20" placeholder="Nombre del remitente" class="form-control @error('remitente') is-invalid @enderror" required>
                                @error('remitente') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Destinatario (Quien recibe)</label>
                                <input type="text" name="destinatario" value="{{ old('destinatario') }}" maxlength="20" placeholder="Nombre del destinatario" class="form-control @error('destinatario') is-invalid @enderror" required>
                                @error('destinatario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Dirección Origen y Entrega -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Dirección de Origen</label>
                                <input type="text" name="direccion_origen" value="{{ old('direccion_origen') }}" maxlength="50" placeholder="Ej: Cra 43A # 1-50, Medellín" class="form-control @error('direccion_origen') is-invalid @enderror" required>
                                @error('direccion_origen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Dirección de Entrega</label>
                                <input type="text" name="direccion_entrega" value="{{ old('direccion_entrega') }}" maxlength="50" placeholder="Ej: Cl. 26 # 68C-61, Bogotá" class="form-control @error('direccion_entrega') is-invalid @enderror" required>
                                @error('direccion_entrega') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Tipo de Servicio y Descripción -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tipo de Servicio</label>
                                <select name="tipo_servicio" class="form-select @error('tipo_servicio') is-invalid @enderror" required>
                                    <option value="normal" {{ old('tipo_servicio') == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="express" {{ old('tipo_servicio') == 'express' ? 'selected' : '' }}>Express</option>
                                    <option value="mismo dia" {{ old('tipo_servicio') == 'mismo dia' ? 'selected' : '' }}>Mismo Día</option>
                                </select>
                                @error('tipo_servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold">Descripción del Contenido</label>
                                <input type="text" name="descripcion_contenido" value="{{ old('descripcion_contenido') }}" maxlength="200" placeholder="Ej: Caja con repuestos electrónicos" class="form-control @error('descripcion_contenido') is-invalid @enderror" required>
                                @error('descripcion_contenido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Peso, Dimensiones, Valor Declarado y Costo -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Peso (kg)</label>
                                <input type="number" step="0.01" min="0.1" name="peso" id="peso" value="{{ old('peso', '1.00') }}" class="form-control @error('peso') is-invalid @enderror" required>
                                @error('peso') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Dimensiones (cm)</label>
                                <input type="text" name="dimensiones" value="{{ old('dimensiones', '30x20x15') }}" placeholder="Largo x Ancho x Alto" class="form-control @error('dimensiones') is-invalid @enderror" required>
                                @error('dimensiones') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Valor Declarado ($)</label>
                                <input type="number" step="0.01" min="0" name="valor_declarado" value="{{ old('valor_declarado', '100000.00') }}" class="form-control @error('valor_declarado') is-invalid @enderror" required>
                                @error('valor_declarado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Costo del Envío ($)</label>
                                <input type="number" step="0.01" name="costo" id="costo" value="{{ old('costo', '25000.00') }}" class="form-control @error('costo') is-invalid @enderror" required readonly>
                                <small class="text-muted">Calculado según el peso.</small>
                                @error('costo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Forma de Pago -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Forma de Pago</label>
                                <select name="forma_pago" class="form-select @error('forma_pago') is-invalid @enderror" required>
                                    <option value="efectivo" {{ old('forma_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                    <option value="transferencia" {{ old('forma_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                    <option value="tarjeta" {{ old('forma_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                    <option value="contra entrega" {{ old('forma_pago') == 'contra entrega' ? 'selected' : '' }}>Contra Entrega</option>
                                </select>
                                @error('forma_pago') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Instrucciones Especiales -->
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Instrucciones Especiales</label>
                                <input type="text" name="instrucciones_especiales" value="{{ old('instrucciones_especiales') }}" maxlength="200" placeholder="Ej: Frágil, entregar en recepción" class="form-control @error('instrucciones_especiales') is-invalid @enderror">
                                @error('instrucciones_especiales') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Botones de Acción dentro del formulario -->
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            @auth
                                <a href="{{ route('envios.index') }}" class="btn btn-secondary">Cancelar</a>
                            @else
                                <a href="{{ url('/') }}" class="btn btn-secondary">Cancelar</a>
                            @endauth
                            <button type="submit" class="btn btn-success fw-bold">Guardar Envío</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Botón de Volver Inteligente -->
            <div class="mt-3">
                @auth
                    <a href="{{ route('envios.index') }}" class="btn btn-secondary">
                        Volver al Panel
                    </a>
                @else
                    <a href="{{ url('/') }}" class="btn btn-secondary">
                        Volver al Inicio
                    </a>
                @endauth
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const pesoInput = document.getElementById('peso');
                const costoInput = document.getElementById('costo');

                function calcularCosto() {
                    const peso = parseFloat(pesoInput.value) || 1;
                    const tarifaBase = 10000;
                    const valorPorKg = 5000;
                    
                    const total = tarifaBase + (peso * valorPorKg);
                    costoInput.value = total.toFixed(2);
                }

                pesoInput.addEventListener('input', calcularCosto);
            });
        </script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>




