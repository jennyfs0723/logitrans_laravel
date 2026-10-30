<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Logitrans</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logitrans_ico.ico') }}">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

    <style>
        html { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 14px; }
        ::-webkit-scrollbar-track { background: #151c1e; }
        ::-webkit-scrollbar-thumb { background: #332e2f; border-radius: 10px; border: 2px solid #151c1e; }
        ::-webkit-scrollbar-thumb:hover { background: #394143; }
    </style>
</head>

<body class="bg-dark text-light">

    <!-- Contenedor principal con imagen de fondo fija -->
    <div style="background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.85)), url('{{ asset('assets/img/imagen_fondo.jpg') }}') center/cover no-repeat fixed; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 30px 15px;">
        
        <div style="width: 100%; max-width: 400px;">
            
            <!-- Logo superior de Logitrans -->
            <div style="text-align: center; margin-bottom: 20px;">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/imagen_logo.jpg') }}" alt="Logo Logitrans" width="55" height="55" style="border-radius: 12px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.5);" onerror="this.src='https://via.placeholder.com/55?text=LT'">
                </a>
            </div>

            <!-- Contenedor ultra compacto en color hueso para el registro -->
            <div style="background-color: #f5f2eb; color: #212529; padding: 20px 24px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
                
                <div style="text-align: center; margin-bottom: 15px;">
                    <h4 style="font-weight: bold; color: #212529; margin: 0; font-size: 18px;">Registro de Usuario</h4>
                    <p style="color: #6c757d; font-size: 12px; margin: 0;">Crea tu cuenta en Logitrans</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div style="margin-bottom: 10px;">
                        <label for="name" style="display: block; font-weight: 600; color: #212529; margin-bottom: 2px; font-size: 12px;">Nombre</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" style="width: 100%; padding: 8px 10px; border: 1px solid #ced4da; border-radius: 6px; background-color: #ffffff; color: #212529; box-sizing: border-box; font-size: 13px;" />
                        @error('name')
                            <span style="color: #dc3545; font-size: 10px; margin-top: 2px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div style="margin-bottom: 10px;">
                        <label for="email" style="display: block; font-weight: 600; color: #212529; margin-bottom: 2px; font-size: 12px;">Correo Electrónico</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" style="width: 100%; padding: 8px 10px; border: 1px solid #ced4da; border-radius: 6px; background-color: #ffffff; color: #212529; box-sizing: border-box; font-size: 13px;" />
                        @error('email')
                            <span style="color: #dc3545; font-size: 10px; margin-top: 2px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 10px;">
                        <label for="password" style="display: block; font-weight: 600; color: #212529; margin-bottom: 2px; font-size: 12px;">Contraseña</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" style="width: 100%; padding: 8px 10px; border: 1px solid #ced4da; border-radius: 6px; background-color: #ffffff; color: #212529; box-sizing: border-box; font-size: 13px;" />
                        @error('password')
                            <span style="color: #dc3545; font-size: 10px; margin-top: 2px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div style="margin-bottom: 15px;">
                        <label for="password_confirmation" style="display: block; font-weight: 600; color: #212529; margin-bottom: 2px; font-size: 12px;">Confirmar Contraseña</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" style="width: 100%; padding: 8px 10px; border: 1px solid #ced4da; border-radius: 6px; background-color: #ffffff; color: #212529; box-sizing: border-box; font-size: 13px;" />
                        @error('password_confirmation')
                            <span style="color: #dc3545; font-size: 10px; margin-top: 2px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div style="margin-bottom: 12px;">
                        <button type="submit" style="background-color: #212529; color: #ffffff; padding: 8px 14px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 13px; width: 100%;">
                            Registrarme
                        </button>
                    </div>

                    <!-- Separador -->
                    <div style="text-align: center; margin: 12px 0; border-bottom: 1px solid #dcd6cd; position: relative;">
                        <span style="background-color: #f5f2eb; padding: 0 6px; position: relative; top: 7px; font-size: 11px; color: #6c757d;">O también puedes</span>
                    </div>
                    <div style="height: 6px;"></div>

                    <!-- Botón de Google -->
                    <div style="text-align: center; margin-bottom: 12px;">
                        <a href="{{ route('google.login') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 8px; background-color: #ffffff; color: #3c4043; border: 1px solid #dadce0; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 12px; box-sizing: border-box; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48" style="flex-shrink: 0;">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.46-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                                <path fill="none" d="M0 0h48v48H0z"/>
                            </svg>
                            <span>Continuar con Google</span>
                        </a>
                    </div>

                    <!-- Footer links -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; font-size: 11px;">
                        <span style="color: #6c757d;">¿Ya estás registrado? <a href="{{ route('login') }}" style="color: #212529; text-decoration: underline; font-weight: bold;">Iniciar sesión</a></span>
                        <a href="{{ route('welcome') }}" style="color: #6c757d; text-decoration: none; border: 1px solid #adb5bd; padding: 2px 8px; border-radius: 4px;">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>