<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\Persona; // Asegúrate de importar el modelo Persona
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            // Crear una entrada en la tabla 'personas'
            $persona = Persona::create([
                'razon_social' => $input['name'],
                'direccion' => null, // Proveer un valor para 'direccion'
                'tipo_persona' => null, // Proveer un valor para 'tipo_persona'
                'documento_id' => 1, // Asegúrate de que este ID exista en la tabla 'documentos'
                'numero_documento' => null,
            ]);

            // Crear el usuario y asignar el persona_id
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'persona_id' => $persona->id, // Asignar el persona_id
            ]), function (User $user) {
                $this->createTeam($user);
                // Asignar el rol de "Usuario" al nuevo usuario
                $role = Role::where('name', 'Usuario')->first();
                if ($role) {
                    $user->assignRole($role);
                }
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
}
