<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Logitrans</title>
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

    <!-- CONTENEDOR PRINCIPAL CON FONDO DE IMAGEN FIJA -->
    <div style="background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.85)), url('{{ asset('assets/img/imagen_fondo.jpg') }}') center/cover no-repeat fixed; min-height: 100vh; padding: 40px 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            
            <!-- ENCABEZADO DEL DASHBOARD -->
            <div style="background-color: rgba(15, 19, 21, 0.92); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 12px; padding: 25px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.6);">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="{{ asset('assets/img/imagen_logo.jpg') }}" alt="Logo Logitrans" width="48" height="48" style="border-radius: 8px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/48?text=LT'">
                    <div>
                        <h2 style="color: #ffffff; font-size: 24px; font-weight: bold; margin: 0 0 5px 0;">Panel de Control - Logitrans</h2>
                        <p style="color: #adb5bd; font-size: 14px; margin: 0;">Bienvenido, <strong style="color: #ffffff;">{{ Auth::user()->name }}</strong>. Selecciona un módulo para gestionar las operaciones.</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <a href="{{ url('/') }}" style="background-color: transparent; color: #ffffff; border: 1px solid #ced4da; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; transition: all 0.2s;">
                        Ir a la página principal
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background-color: #dc3545; color: #ffffff; border: none; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: bold; cursor: pointer;">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>

            <!-- CUADRÍCULA DE MÓDULOS -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
                
                <!-- Módulo 1: Clientes -->
                <div style="background-color: rgba(21, 28, 30, 0.92); border: 1px solid #495057; border-radius: 12px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 8px 20px rgba(0,0,0,0.4);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #ffffff; font-size: 18px; font-weight: bold; margin: 0;">Clientes</h3>
                            <span style="background-color: #6c757d; color: #ffffff; font-size: 11px; font-weight: bold; padding: 3px 8px; border-radius: 4px;">CRUD</span>
                        </div>
                        <p style="color: #adb5bd; font-size: 13px; line-height: 1.5; margin-bottom: 25px;">Administra la base de datos de clientes corporativos y particulares asociados a la red de envíos.</p>
                    </div>
                    <a href="{{ route('clientes.index') }}" style="background-color: #ffffff; color: #212529; text-align: center; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        Acceder a Clientes
                    </a>
                </div>

                <!-- Módulo 2: Envíos -->
                <div style="background-color: rgba(21, 28, 30, 0.92); border: 2px solid #dc3545; border-radius: 12px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 8px 20px rgba(0,0,0,0.4);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #ffffff; font-size: 18px; font-weight: bold; margin: 0;">Envíos</h3>
                            <span style="background-color: #dc3545; color: #ffffff; font-size: 11px; font-weight: bold; padding: 3px 8px; border-radius: 4px;">Operativo</span>
                        </div>
                        <p style="color: #adb5bd; font-size: 13px; line-height: 1.5; margin-bottom: 25px;">Crea, edita, programa y realiza seguimiento completo de las encomiendas y mercancías en tránsito.</p>
                    </div>
                    <a href="{{ route('envios.index') }}" style="background-color: #dc3545; color: #ffffff; text-align: center; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        Acceder a Envíos
                    </a>
                </div>

                <!-- Módulo 3: Vehículos -->
                <div style="background-color: rgba(21, 28, 30, 0.92); border: 1px solid #495057; border-radius: 12px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 8px 20px rgba(0,0,0,0.4);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #ffffff; font-size: 18px; font-weight: bold; margin: 0;">Vehículos</h3>
                            <span style="background-color: #6c757d; color: #ffffff; font-size: 11px; font-weight: bold; padding: 3px 8px; border-radius: 4px;">Flota</span>
                        </div>
                        <p style="color: #adb5bd; font-size: 13px; line-height: 1.5; margin-bottom: 25px;">Controla la flota disponible de camiones, furgonetas y motocicletas asignadas a la logística.</p>
                    </div>
                    <a href="{{ route('vehiculos.index') }}" style="background-color: #ffffff; color: #212529; text-align: center; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        Acceder a Vehículos
                    </a>
                </div>

                <!-- Módulo 4: Conductores -->
                <div style="background-color: rgba(21, 28, 30, 0.92); border: 1px solid #495057; border-radius: 12px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 8px 20px rgba(0,0,0,0.4);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #ffffff; font-size: 18px; font-weight: bold; margin: 0;">Conductores</h3>
                            <span style="background-color: #0dcaf0; color: #000000; font-size: 11px; font-weight: bold; padding: 3px 8px; border-radius: 4px;">Personal</span>
                        </div>
                        <p style="color: #adb5bd; font-size: 13px; line-height: 1.5; margin-bottom: 25px;">Gestiona la información, licencias y asignación del personal de conducción para las rutas de entrega.</p>
                    </div>
                    <a href="{{ route('conductores.index') }}" style="background-color: #ffffff; color: #212529; text-align: center; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        Acceder a Conductores
                    </a>
                </div>

                <!-- Módulo 5: Rutas -->
                <div style="background-color: rgba(21, 28, 30, 0.92); border: 1px solid #495057; border-radius: 12px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 8px 20px rgba(0,0,0,0.4);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #ffffff; font-size: 18px; font-weight: bold; margin: 0;">Rutas</h3>
                            <span style="background-color: #6c757d; color: #ffffff; font-size: 11px; font-weight: bold; padding: 3px 8px; border-radius: 4px;">Logística</span>
                        </div>
                        <p style="color: #adb5bd; font-size: 13px; line-height: 1.5; margin-bottom: 25px;">Optimiza y establece los trayectos nacionales y urbanos para garantizar entregas puntuales.</p>
                    </div>
                    <a href="{{ route('rutas.index') }}" style="background-color: #ffffff; color: #212529; text-align: center; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        Acceder a Rutas
                    </a>
                </div>

                <!-- Módulo 6: Seguimientos -->
                <div style="background-color: rgba(21, 28, 30, 0.92); border: 1px solid #495057; border-radius: 12px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 8px 20px rgba(0,0,0,0.4);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <h3 style="color: #ffffff; font-size: 18px; font-weight: bold; margin: 0;">Seguimientos</h3>
                            <span style="background-color: #198754; color: #ffffff; font-size: 11px; font-weight: bold; padding: 3px 8px; border-radius: 4px;">Control</span>
                        </div>
                        <p style="color: #adb5bd; font-size: 13px; line-height: 1.5; margin-bottom: 25px;">Actualiza el estatus y reportes de estado en tiempo real para el control interno de la empresa.</p>
                    </div>
                    <a href="{{ route('seguimientos.index') }}" style="background-color: #ffffff; color: #212529; text-align: center; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        Acceder a Seguimientos
                    </a>
                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script