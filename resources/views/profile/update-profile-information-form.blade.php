<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>


                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>


                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Razon Social -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="razon_social" value="{{ __('Razon Social') }}" />
            <x-input id="razon_social" type="text" class="mt-1 block w-full" wire:model="state.razon_social" required
            autocomplete="razon_social" />
            <x-input-error for="razon_social" class="mt-2" />
        </div>

        <!-- Direccion -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="direccion" value="{{ __('Direccion') }}" />
            <x-input id="direccion" type="text" class="mt-1 block w-full" wire:model="state.direccion" required
            autocomplete="direccion" />
            <x-input-error for="direccion" class="mt-2" />
        </div>

        <!-- Tipo Persona -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="tipo_persona" value="{{ __('Tipo Persona') }}" />
            <x-select id="tipo_persona" type="text" class="mt-1 block w-full" wire:model="state.tipo_persona">
                <option value="" selected>Seleccione una opción...</option>
                <option value="natural" {{old('tipo_persona') == 'natural' ? 'selected' : ''}}>Persona Natural</option>
                <option value="juridica" {{old('tipo_persona') == 'natural' ? 'selected' : ''}}>Persona Juridica</option>
            </x-select>
            @error('tipo_persona')
                <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>


        <!-- Campo de selección para el tipo de documento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="documento_id" value="{{ __('Tipo Documento') }}" />
            <x-select id="documento_id" type="text" class="mt-1 block w-full" wire:model="state.documento_id">
                <option value="" selected>Seleccione una opción...</option>
                <option value="1" {{old('documento_id') == 'natural' ? 'selected' : ''}}>DNI</option>
                <option value="2" {{old('documento_id') == 'natural' ? 'selected' : ''}}>RUC</option>
                <option value="3" {{old('documento_id') == 'natural' ? 'selected' : ''}}>PASAPORTE</option>
                <option value="4" {{old('documento_id') == 'natural' ? 'selected' : ''}}>CARNET EXTRANJERIA</option>
            </x-select>
            @error('documento_id')
                <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>


        <!-- # documento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="numero_documento" value="{{ __('Numero Documento') }}" />
            <x-input id="numero_documento" type="text" class="mt-1 block w-full"
                wire:model="state.numero_documento" />
            <x-input-error for="numero_documento" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
