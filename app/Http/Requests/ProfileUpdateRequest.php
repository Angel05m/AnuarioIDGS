<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            
            // 💡 AÑADIR NUEVOS CAMPOS AQUÍ:
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['nullable', 'string', 'max:255'], // 'nullable' si es opcional
            'matricula' => [
                'required',
                'string',
                'max:20',
                // Asegura que la matrícula sea única, ignorando al usuario actual
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            // 💡 FIN DE NUEVOS CAMPOS
            
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            
            // La foto de perfil no necesita estar aquí, ya que la validamos y procesamos
            // en el ProfileController, que es la práctica recomendada para archivos.
        ];
    }
}