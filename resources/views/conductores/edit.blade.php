<!doctype html>
<html lang="es" data-bs-theme="dark">
    <head>
        <title>Editar Conductor - Logitrans</title>
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
            <h1 class="mb-4">Editar Conductor</h1>

            <div class="card shadow-sm mb-4 border-secondary">
                <div class="card-body">
                    <form action="{{ route('conductores.update', $conductor) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Código de Empleado</label>
                                <input type="text" value="{{ $conductor->codigo_empleado }}" class="form-control" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Documento de Identidad</label>
                                <input type="text" name="documento_identidad" value="{{ old('documento_identidad', $conductor->documento_identidad) }}" class="form-control @error('documento_identidad') is-invalid @enderror" required>
                                @error('documento_identidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nombres</label>
                                <input type="text" name="nombres" value="{{ old('nombres', $conductor->nombres) }}" class="form-control @error('nombres') is-invalid @enderror" required>
                                @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Apellidos</label>
                                <input type="text" name="apellidos" value="{{ old('apellidos', $conductor->apellidos) }}" class="form-control @error('apellidos') is-invalid @enderror" required>
                                @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Teléfono (Solo números)</label>
                                <input type="tel" name="telefono" value="{{ old('telefono', $conductor->telefono) }}" class="form-control @error('telefono') is-invalid @enderror" required>
                                @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipo de Licencia</label>
                                <input type="text" name="tipo_licencia" value="{{ old('tipo_licencia', $conductor->tipo_licencia) }}" class="form-control @error('tipo_licencia') is-invalid @enderror" required>
                                @error('tipo_licencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Vencimiento Licencia</label>
                                <input type="date" name="fecha_vencimiento_licencia" value="{{ old('fecha_vencimiento_licencia', $conductor->fecha_vencimiento_licencia?->format('Y-m-d')) }}" class="form-control @error('fecha_vencimiento_licencia') is-invalid @enderror" required>
                                @error('fecha_vencimiento_licencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Años de Experiencia</label>
                                <input type="number" name="anios_experiencia" min="0" value="{{ old('anios_experiencia', $conductor->anios_experiencia) }}" class="form-control @error('anios_experiencia') is-invalid @enderror" required>
                                @error('anios_experiencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Estado del Conductor</label>
                                <select name="estado_conductor" class="form-select @error('estado_conductor') is-invalid @enderror" required>
                                    <option value="disponible" {{ old('estado_conductor', $conductor->estado_conductor) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="en ruta" {{ old('estado_conductor', $conductor->estado_conductor) == 'en ruta' ? 'selected' : '' }}>En Ruta</option>
                                    <option value="descanso" {{ old('estado_conductor', $conductor->estado_conductor) == 'descanso' ? 'selected' : '' }}>Descanso</option>
                                </select>
                                @error('estado_conductor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold">Actualizar Conductor</button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="{{ route('conductores.index') }}" class="btn btn-sm btn-outline-light mb-5">Volver al listado</a>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>