<section class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-xl text-slate-100">
    <header>
        <h2 class="text-lg font-bold text-slate-100">
            Eliminar Cuenta
        </h2>
        <p class="text-sm text-slate-400 mt-1">
            Una vez que tu cuenta sea eliminada, todos sus recursos y datos asociados serán borrados permanentemente. Por favor, asegúrate de descargar cualquier información que desees conservar antes de continuar.
        </p>
    </header>

    <!-- Botón que activa la solicitud de eliminación -->
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-medium text-sm rounded-xl transition shadow-sm">
        Solicitar eliminación de cuenta
    </button>

    <!-- Modal de confirmación protegido por contraseña -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-slate-900 text-slate-100 rounded-2xl border border-slate-800 shadow-2xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-slate-100">
                ¿Estás seguro de que deseas eliminar tu cuenta?
            </h2>

            <p class="text-sm text-slate-400 mt-2">
                Esta acción es irreversible. Por favor, introduce tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.
            </p>

            <div class="mt-4">
                <label for="password" class="sr-only">Contraseña</label>
                <input id="password" name="password" type="password" placeholder="Introduce tu contraseña" class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-slate-100 text-sm focus:ring-2 focus:ring-red-500 outline-none placeholder-slate-500" />
                @error('password', 'userDeletion')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-sm font-medium rounded-xl transition">
                    Cancelar
                </button>

                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-medium rounded-xl transition">
                    Sí, eliminar cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>