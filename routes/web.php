<?php

use Resend\Laravel\Facades\Resend;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RutaDistribucionController;
use App\Http\Controllers\SeguimientoEnvioController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

// Ruta pública de inicio
Route::get('/', function () {
    return view('welcome');
})->name('welcome'); 


// Ruta pública para el formulario de rastreo
Route::post('/rastrear', [SeguimientoEnvioController::class, 'rastrear'])->name('rastrear');

// Rutas del panel (puedes dejarlas fuera o dentro del middleware 'auth' según prefieras)
Route::resource('clientes', ClienteController::class);
Route::resource('conductores', ConductorController::class)->parameters([
    'conductores' => 'conductor'
]);
Route::resource('vehiculos', VehiculoController::class);
Route::resource('rutas', RutaDistribucionController::class)->parameters([
    'rutas' => 'ruta'
]);
Route::resource('envios', EnvioController::class);
Route::resource('seguimientos', SeguimientoEnvioController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/auth/google/redirect', [SocialLoginController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->name('social.callback');

Route::get('/probar-resend', function () {
    try {
        Resend::emails()->send([
            'from' => 'soporte@logitrans.space',
            'to' => ['jennyfs1997@gmail.com'],
            'subject' => 'Prueba Oficial - Logitrans',
            'html' => '<h1>¡Hola desde Logitrans!</h1><p>Correo enviado utilizando la API oficial de Resend.</p>',
        ]);

        return redirect()->to('/')->with('success', '¡Correo enviado con éxito!');
    } catch (\Exception $e) {
        return redirect()->to('/')->with('error', 'Error al enviar el correo: ' . $e->getMessage());
    }
});

Route::post('/dashboard/backup', function () {
    $nombreArchivo = 'respaldo_logitrans_' . date('Y-m-d_H-i-s') . '.txt';
    $contenidoRespaldo = "Copia de seguridad del sistema Logitrans generada el " . now();

    // Esto sube directamente al bucket usando el disco 's3' configurado
    Storage::disk('s3')->put('backups/' . $nombreArchivo, $contenidoRespaldo);

    return redirect('/dashboard')->with('success', '¡La copia se ha almacenado con éxito en la nube!');
})->middleware(['auth'])->name('backup.crear');


Route::view('/politica-privacidad', 'privacy.policy')->name('privacy.policy');


Route::middleware('auth')->group(function () {
    // Ruta existente o nueva para eliminar cuenta
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/limpiar-usuario', function () {
    $deleted = User::where('email', 'jennyfs1997@gmail.com')->delete();
    return "Usuarios eliminados: " . $deleted;
});


require __DIR__.'/auth.php';