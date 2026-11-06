<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Logitrans</title>
    
    <!-- Favicon Oficial -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logitrans_ico.ico') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(3, 7, 18, 0.85), rgba(3, 7, 18, 0.85)), url('{{ asset('assets/img/imagen_fondo.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-dark text-light d-flex align-items-center justify-content-center py-4">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <!-- Tarjeta Principal con Estilo Bootstrap Oscuro -->
                <div class="card bg-dark border-secondary text-light shadow-lg p-4 p-md-5 rounded-4">
                    
                    <!-- Logotipo superior -->
                    <div class="text-center mb-4">
                        <a href="/">
                            <img src="{{ asset('assets/img/imagen_logo.jpg') }}" alt="Logitrans" class="img-fluid mx-auto d-block mb-3 shadow" style="max-width: 70px; height: auto;">
                        </a>
                        <h4 class="fw-bold text-white">¿Olvidaste tu contraseña?</h4>
                    </div>

                    <!-- Mensaje descriptivo -->
                    <p class="text-secondary small text-center mb-4">
                        No te preocupes. Ingresa tu correo electrónico registrado y te enviaremos un enlace de restablecimiento para que elijas una nueva.
                    </p>

                    <!-- Estado de la sesión / Mensajes de éxito -->
                    @if (session('status'))
                        <div class="alert alert-success text-center py-2 small" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Formulario -->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary fw-semibold small">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control bg-black text-light border-secondary py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="tucorreo@dominio.com">
                            @error('email')
                                <div class="invalid-feedback text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2.5 fw-bold shadow-sm">
                                Enviar enlace de recuperación
                            </button>
                        </div>
                    </form>

                    <!-- Enlace para volver al login -->
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none text-secondary small">
                            &larr; Volver al inicio de sesión
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>