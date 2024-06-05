<?php

namespace App\Actions\Fortify;

use App\Models\Documento;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'razon_social' => ['required', 'string', 'max:150'],
            'direccion' => ['required', 'string', 'max:255'],
            'tipo_persona' => ['required', 'string'],
            'documento_id' => ['required', 'integer'],
            'numero_documento' => ['required', 'string'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }

        // Actualizar la información de la persona
        $persona = $user->persona;
        $persona->update([
            'razon_social' => $input['razon_social'] ?? $persona->razon_social,
            'direccion' => $input['direccion'] ?? $persona->direccion,
            'tipo_persona' => $input['tipo_persona'] ?? $persona->tipo_persona,
            'documento_id' => $input['documento_id'] ?? $persona->documento_id,
            'numero_documento' => $input['numero_documento'] ?? $persona->numero_documento,
        ]);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
