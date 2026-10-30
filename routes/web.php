<?php
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


require __DIR__.'/auth.php';