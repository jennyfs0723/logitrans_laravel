<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Editar Cliente - Logitrans</title>
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
            <h1 class="mb-4">Editar Cliente</h1>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-dark">Código Único (Autogenerado)</label>
                                <input type="text" value="{{ $cliente->codigo_unico }}" class="form-control bg-dark" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipo de Cliente</label>
                                <select name="tipo_cliente" class="form-select @error('tipo_cliente') is-invalid @enderror" required>
                                    <option value="individual" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="empresarial" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'empresarial' ? 'selected' : '' }}>Empresarial</option>
                                </select>
                                @error('tipo_cliente') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Nombre o Razón Social</label>
                                <input type="text" name="nombre_o_razon_social" value="{{ old('nombre_o_razon_social', $cliente->nombre_o_razon_social) }}" class="form-control @error('nombre_o_razon_social') is-invalid @enderror" required>
                                @error('nombre_o_razon_social') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">RUT / DNI</label>
                                <input type="text" name="rut_o_dni" value="{{ old('rut_o_dni', $cliente->rut_o_dni) }}" class="form-control @error('rut_o_dni') is-invalid @enderror" required>
                                @error('rut_o_dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Teléfono (Solo números)</label>
                                <input type="tel" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="form-control @error('telefono') is-invalid @enderror" required>
                                @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Correo Electrónico</label>
                                <input type="email" name="email" value="{{ old('email', $cliente->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Dirección Fiscal</label>
                                <input type="text" name="direccion_fiscal" value="{{ old('direccion_fiscal', $cliente->direccion_fiscal) }}" class="form-control @error('direccion_fiscal') is-invalid @enderror" required>
                                @error('direccion_fiscal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Actualizar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-outline-primary mb-5">Volver al listado</a>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>