<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
// 💡 DEBEMOS AÑADIR ESTAS LÍNEAS
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information and handle file upload.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. VALIDACIÓN ADICIONAL Y DE LA FOTO (MANUALMENTE)
        // La validación de la matrícula y la foto NO están en ProfileUpdateRequest (porque la foto es un archivo).
        $request->validate([
            // Validamos que la matrícula sea única, excluyendo al usuario actual
            'matricula' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($request->user()->id)], 
            // Validamos el archivo: opcional, debe ser una imagen, max 2MB
            'foto_perfil' => ['nullable', 'image', 'max:2048'], 
        ]);

        // 2. LÓGICA DE SUBIDA Y BORRADO DE LA FOTO
        if ($request->hasFile('foto_perfil')) {
            $user = $request->user();

            // Borrar la foto anterior si existe
            if ($user->foto_perfil) {
                Storage::disk('public')->delete($user->foto_perfil);
            }

            // Guardar la nueva foto en la carpeta 'avatars'
            $path = $request->file('foto_perfil')->store('avatars', 'public');
            
            // Asignar la ruta al campo 'foto_perfil'
            $request->user()->foto_perfil = $path;
        }

        // 3. ACTUALIZAR CAMPOS DE TEXTO
        // El método fill usa $request->validated(), que ahora incluye todos los campos de texto
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        
        // 4. Opcional: Eliminar la foto de perfil al borrar el usuario
        if ($user->foto_perfil) {
            Storage::disk('public')->delete($user->foto_perfil);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}