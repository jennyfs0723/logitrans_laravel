<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logitrans - Envíos seguros y logística inteligente</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logitrans_ico.ico') }}">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Estilos mínimos únicamente para scrollbar e imagen de fondo fija -->
    <style>
        html { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 14px; }
        ::-webkit-scrollbar-track { background: #151c1e; }
        ::-webkit-scrollbar-thumb { background: #332e2f; border-radius: 10px; border: 2px solid #151c1e; }
        ::-webkit-scrollbar-thumb:hover { background: #394143; }

        .bg-layout {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.75)), 
                        url('{{ asset("assets/img/imagen_fondo.jpg") }}') center/cover no-repeat fixed;
            min-height: 100vh;
        }

        .avatar-img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>

<body class="bg-dark text-light">

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="bg-layout d-flex flex-column justify-content-between">
        <nav class="navbar navbar-expand-lg sticky-top border-bottom border-secondary-subtle" style="background-color: rgba(0,0,0,0.85);">
            <div class="container">
                <!-- Logo y Marca -->
                <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white fs-4" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/imagen_logo.jpg') }}" alt="Logo Logitrans" width="32" height="32" class="rounded" onerror="this.src='https://via.placeholder.com/32?text=LT'">
                    Logitrans
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('envios.create')}}">Solicita tu envio</a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <a href="{{ route('seguimientos.index') }}" class="nav-link text-white">Rastrear</a>
                            @else
                                <button type="button" class="btn btn-link nav-link text-white text-decoration-none p-0 bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Rastrear
                                </button>
                            @endauth
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="https://wa.me/573001234567" target="_blank">Contactanos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Cotizar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#nosotros">Nosotros</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3 me-4">
                        @auth
                            <li class="nav-item d-flex align-items-center gap-3">
                                <span class="navbar-text text-white fw-semibold me-2">
                                    👋 Hola, {{ Auth::user()->name }}
                                </span>
                                <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-light fw-bold me-2">
                                    Panel de Control
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-light fw-bold">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link fw-bold text-white me-2">Ingresar</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-success fw-bold text-white px-3">Registrarse</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>  
        </header>

        <!-- SECCIÓN PORTADA / HERO -->
        <header class="container text-center py-5 my-auto">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="display-3 fw-bold text-white mb-3">Envíos seguros y logística inteligente</h1>
                    <p class="lead text-light mb-4 fs-4">Garantizamos seguridad, confiabilidad y rapidez.</p>
                    <a href="{{ route('envios.create') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 py-2 fw-bold">Solicitar mi envío</a>
                </div>
            </div>
        </header>
    </div>

    <!-- SECCIÓN NUESTROS VEHÍCULOS -->
    <section class="py-5" style="background-color: #151c1e;">
        <div class="container py-4">
            <h2 class="text-center fw-bold text-white mb-5">Nuestros vehículos</h2>
            
            <div class="row g-4 align-items-stretch">
                <!-- Camiones -->
                <div class="col-md-4">
                    <div class="card bg-dark text-light border-secondary h-100 shadow-sm">
                        <img src="{{ asset('assets/img/camion.jpg') }}" class="card-img-top" alt="Camiones Logitrans" style="height: 220px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?q=80&w=600&auto=format&fit=crop'">
                        <div class="card-body d-flex flex-column text-center">
                            <h3 class="h4 fw-bold text-white mb-3">Camiones</h3>
                            <p class="card-text text-secondary mb-4 flex-grow-1">Transportamos tu mercancía a cualquier rincón del país con total seguridad.</p>
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary fw-bold w-100 mt-auto">Conoce más</a>
                        </div>
                    </div>
                </div>

                <!-- Furgonetas (Destacada) -->
                <div class="col-md-4">
                    <div class="card bg-dark text-light border-danger border-2 h-100 shadow-lg" style="transform: scale(1.02);">
                        <img src="{{ asset('assets/img/furgoneta.jpg') }}" class="card-img-top" alt="Furgonetas Logitrans" style="height: 220px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?q=80&w=600&auto=format&fit=crop'">
                        <div class="card-body d-flex flex-column text-center">
                            <h3 class="h4 fw-bold text-white mb-3">Furgonetas</h3>
                            <p class="card-text text-secondary mb-4 flex-grow-1">Contamos con envíos más rápidos en furgoneta, para entregas en menor tiempo.</p>
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-danger fw-bold w-100 mt-auto">Conoce más</a>
                        </div>
                    </div>
                </div>

                <!-- Motos -->
                <div class="col-md-4">
                    <div class="card bg-dark text-light border-secondary h-100 shadow-sm">
                        <img src="{{ asset('assets/img/motocicleta.jpg') }}" class="card-img-top" alt="Motos Logitrans" style="height: 220px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=600&auto=format&fit=crop'">
                        <div class="card-body d-flex flex-column text-center">
                            <h3 class="h4 fw-bold text-white mb-3">Motos</h3>
                            <p class="card-text text-secondary mb-4 flex-grow-1">Servicio de mensajería prioritaria para tus envíos más urgentes dentro de la ciudad.</p>
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary fw-bold w-100 mt-auto">Conoce más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TESTIMONIOS -->
    <section class="py-5" style="background-color: #151c1e;">
        <div class="container py-4">
            <h2 class="text-center fw-bold text-white mb-5">Lo que opinan nuestros usuarios</h2>
            
            <div class="row g-4 align-items-stretch">
                <!-- Testimonio 1 -->
                <div class="col-md-4">
                    <div class="card bg-dark text-light border-secondary h-100 p-3 shadow-sm">
                        <div class="card-body d-flex flex-column align-items-start">
                            <img src="{{ asset('assets/img/cliente1.jpg') }}" alt="Juliana Jaramillo" class="avatar-img mb-3 border border-secondary" onerror="this.src='https://i.pravatar.cc/150?img=47'">
                            <p class="card-text text-secondary mb-4 flex-grow-1">"Logitrans transformó nuestra cadena de suministro. Sus furgonetas siempre llegan a tiempo y el rastreo es exacto."</p>
                            <div>
                                <h4 class="h6 fw-bold text-white mb-0">Juliana Jaramillo</h4>
                                <small class="text-muted">Gerente de Distribución</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonio 2 (Destacado) -->
                <div class="col-md-4">
                    <div class="card bg-dark text-light border-danger h-100 p-3 shadow">
                        <div class="card-body d-flex flex-column align-items-start">
                            <img src="{{ asset('assets/img/cliente2.jpg') }}" alt="Juan Mendoza" class="avatar-img mb-3 border border-danger" onerror="this.src='https://i.pravatar.cc/150?img=12'">
                            <p class="card-text text-light mb-4 flex-grow-1">"Excelente servicio logístico. La seguridad que ofrecen en sus camiones nacionales nos da total tranquilidad para envíos masivos."</p>
                            <div>
                                <h4 class="h6 fw-bold text-white mb-0">Juan Mendoza</h4>
                                <small class="text-muted">Director de Operaciones</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonio 3 -->
                <div class="col-md-4">
                    <div class="card bg-dark text-light border-secondary h-100 p-3 shadow-sm">
                        <div class="card-body d-flex flex-column align-items-start">
                            <img src="{{ asset('assets/img/cliente3.jpg') }}" alt="Lina Moreno" class="avatar-img mb-3 border border-secondary" onerror="this.src='https://i.pravatar.cc/150?img=32'">
                            <p class="card-text text-secondary mb-4 flex-grow-1">"Usé el servicio de mensajería express y llegó el mismo día, en buen estado y el mensajero muy gentil, excelente servicio."</p>
                            <div>
                                <h4 class="h6 fw-bold text-white mb-0">Lina Moreno</h4>
                                <small class="text-muted">Emprendedora</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    <section class="py-5 text-center" style="background-color: #151c1e; border-top: 1px solid #212529;">
        <div class="container py-3">
            <h3 class="fw-bold text-secondary mb-2">¿Trabajas con nosotros?</h3>
            <p class="text-white mb-3">Accede a nuestra plataforma interna de gestión logística y control de operaciones.</p>
            <a href="{{ route('login') }}" class="btn btn-outline-light fw-bold px-4 py-2">Haz clic aquí para ingresar</a>
        </div>
    </section>

    <!-- PIE DE PÁGINA (FOOTER) -->
   <footer class="py-5 border-top border-secondary-subtle" style="background-color: #0f1315;" id="nosotros">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <h4 class="h5 fw-bold text-white mb-3">Logitrans</h4>
                    <p class="text-secondary small">Soluciones logísticas inteligentes y envíos seguros a todo el país.</p>
                </div>

                <div class="col-md-3">
                    <h4 class="h5 fw-bold text-white mb-3">Navegación</h4>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-secondary text-decoration-none">Inicio</a></li>
                        <li class="mb-2"><a href="{{ route('envios.create') }}" class="text-secondary text-decoration-none">Solicita tu envio</a></li>
                        <li class="mb-2">
                            @auth
                                <a href="{{ route('seguimientos.index') }}" class="text-secondary text-decoration-none">Rastrear</a>
                            @else
                                <button type="button" class="btn btn-link text-secondary text-decoration-none p-0 bg-transparent border-0 small text-start" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Rastrear
                                </button>
                            @endauth
                        </li>

                        <li class="mb-2"><a href="#nosotros" class="text-secondary text-decoration-none">Nosotros</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h4 class="h5 fw-bold text-white mb-3">Contacto</h4>
                    <p class="text-secondary small mb-1">📍 Medellín, Colombia</p>
                    <p class="text-secondary small mb-1">📞 (604) 123-4567</p>
                    <p class="text-secondary small mb-1">✉️ soporte@logitrans.com</p>
                </div>

                <div class="col-md-3">
                    <h4 class="h5 fw-bold text-white mb-3">Síguenos</h4>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/" target="_blank" class="btn btn-dark btn-sm rounded-circle fw-bold text-white border-secondary" style="width: 36px; height: 36px;">FB</a>
                        <a href="https://www.instagram.com/" target="_blank" class="btn btn-dark btn-sm rounded-circle fw-bold text-white border-secondary" style="width: 36px; height: 36px;">IG</a>
                    </div>
                </div>
            </div>

            <div class="border-top border-secondary pt-4 text-center">
                <p class="text-muted small mb-0">&copy; 2026 Logitrans S.A. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <!-- Modal de Advertencia de Inicio de Sesión -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4" style="background-color: #25231e; color: #e3e8ee;">
                    
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="loginModalLabel">Acceso Restringido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-center py-4">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="#0d6efd" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            </svg>
                        </div>
                        <p class="fs-6 fw-semibold text-white mb-1">Debes iniciar sesión para acceder a esta función.</p>
                        <p class="text-secondary small mb-0">Para garantizar la seguridad de los envíos, es necesario estar registrado en el sistema.</p>
                    </div>

                    <div class="modal-footer border-0 justify-content-center pb-4 gap-2">
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold rounded-pill" data-bs-dismiss="modal">
                            Volver a inicio
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-primary px-4 fw-bold rounded-pill shadow-sm" style="background-color: #0d6efd; border-color: #0d6efd;">
                            Iniciar Sesión
                        </a>
                    </div>

                </div>
            </div>
        </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>