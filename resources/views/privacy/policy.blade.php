<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Tratamiento de Datos - Logitrans</title>
    <!-- Favicon de la aplicación -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logitrans_ico.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white">

    <!-- Barra de navegación superior oscura -->
    <header class="bg-slate-900 border-b border-slate-800 shadow-sm py-4 px-6 md:px-12 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="bg-blue-600 text-white font-bold p-2 rounded-lg shadow">LT</span>
            <span class="text-xl font-bold tracking-tight text-slate-100">Logitrans</span>
        </div>
        <a href="/login" class="text-sm font-medium text-blue-400 hover:text-blue-300 transition">
            &larr; Volver al sistema
        </a>
    </header>

    <!-- Contenedor Principal de la Política -->
    <main class="max-w-4xl mx-auto px-6 py-10 w-full my-6">
        <div class="bg-slate-900 shadow-2xl border border-slate-800 rounded-2xl p-8 md:p-12">
            
            <!-- Encabezado del documento -->
            <div class="border-b border-slate-800 pb-6 mb-6">
                <span class="inline-block bg-blue-950 text-blue-400 border border-blue-800/50 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-3">Marco Legal Colombiano</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-100 tracking-tight">Política de Tratamiento de Datos Personales y Privacidad</h1>
                <p class="text-sm text-slate-400 mt-1">Conforme a la Ley 1581 de 2012 y el Decreto Reglamentario 1377 de 2013</p>
            </div>
            
            <div class="space-y-6 text-slate-300 text-sm md:text-base leading-relaxed">
                <p>En cumplimiento de las disposiciones legales vigentes en materia de protección de datos personales, <strong>Logitrans</strong> adopta la presente política para garantizar que el tratamiento de la información se realice bajo estrictos estándares de seguridad y respeto por la privacidad de nuestros usuarios y clientes.</p>

                <section>
                    <h2 class="text-lg font-bold text-slate-200 mb-2 flex items-center gap-2">
                        <span class="text-blue-400">1.</span> Identificación del Responsable del Tratamiento
                    </h2>
                    <div class="bg-slate-950/60 p-4 rounded-xl border border-slate-800 space-y-1 text-sm text-slate-300">
                        <p><strong>Razón Social:</strong> Logitrans S.A.S.</p>
                        <p><strong>Correo Electrónico de contacto:</strong> contacto@logitrans.test</p>
                        <p><strong>Canales de atención:</strong> Para consultas, reclamos o actualización de datos, comuníquese a través de nuestro correo oficial.</p>
                    </div>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-slate-200 mb-2 flex items-center gap-2">
                        <span class="text-blue-400">2.</span> Finalidad del Tratamiento de los Datos
                    </h2>
                    <p class="mb-2">Los datos personales recolectados a través de la plataforma serán tratados exclusivamente para:</p>
                    <ul class="list-disc list-inside space-y-1.5 pl-2 text-slate-300">
                        <li>Gestión y administración eficiente de envíos, clientes y operaciones logísticas.</li>
                        <li>Envío de notificaciones operativas, alertas de seguridad y confirmaciones de copias de seguridad en la nube.</li>
                        <li>Cumplimiento de obligaciones legales, tributarias y contractuales derivadas de nuestros servicios.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-slate-200 mb-2 flex items-center gap-2">
                        <span class="text-blue-400">3.</span> Derechos del Titular</h2>
                    <p>Como titular de los datos personales, usted cuenta con el derecho imprescriptible a conocer, actualizar, rectificar su información, solicitar prueba de la autorización otorgada, y revocarla o solicitar la supresión de los datos cuando sea procedente de acuerdo con la ley.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-slate-200 mb-2 flex items-center gap-2">
                        <span class="text-blue-400">4.</span> Medidas de Seguridad de la Información</h2>
                    <p>Logitrans implementa rigurosas medidas técnicas, humanas y administrativas para salvaguardar la información almacenada en nuestras bases de datos y en infraestructura cloud (como Backblaze B2 y cifrado de conexiones en tránsito), mitigando riesgos de pérdida, adulteración o acceso no autorizado.</p>
                </section>
            </div>

            <!-- Pie interno de la tarjeta -->
            <div class="mt-10 pt-6 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center text-sm text-slate-400 gap-4">
                <span>Última actualización: 2026</span>
                <a href="/login" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl transition shadow-sm">
                    Regresar al sistema
                </a>
            </div>
        </div>
    </main>

    <!-- Pie de página institucional -->
    <footer class="bg-slate-900 border-t border-slate-800 py-6 text-center text-xs text-slate-500">
        <p>&copy; 2026 Logitrans. Todos los derechos reservados. Sistema de Gestión Logística.</p>
    </footer>

</body>
</html>