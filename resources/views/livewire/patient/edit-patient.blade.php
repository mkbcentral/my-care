<div>
    <form wire:submit.prevent='handlerSubmit'>
        <div class="row ">
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success text-left" value="{{ __('Nom complet du patient') }}" />
                    <div class="input-group @error('full_name') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" placeholder="Nom du patient" wire:model.defer='full_name' />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Date de naissance') }}" />
                    <div class="input-group @error('date_of_birth') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="date" placeholder="Date de naissance" wire:model.defer='date_of_birth' />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Genre/Sexe') }}" />
                    <div class="input-group @error('gender') is-invalid border border-danger rounded @enderror">
                        <x-form.select wire:model.defer='gender'>
                            @foreach ($listGenders as $gender)
                                <option selected value="{{ $gender->name }}">
                                    {{ $gender->name }}
                                </option>
                            @endforeach

                        </x-form.select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('N° Sec. Sociale ') }}" />
                    <span class="text-danger"> (Non obligatoire)</span>
                    <div
                        class="input-group @error('social_security_number') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" placeholder="N° Sec Sociale"
                            wire:model.defer='social_security_number' />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Personne à contacter') }}" />
                    <div
                        class="input-group @error('emergency_contact_name') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" placeholder="Personne à contacter"
                            wire:model.defer='emergency_contact_name' />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('N° Tél de contact') }}" />
                    <div
                        class="input-group @error('emergency_contact_phone_number') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" placeholder="N° Tél de contact"
                            wire:model.defer='emergency_contact_phone_number' />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Groupe sanguin') }}" />
                    <span class="text-danger"> (Non obligatoire)</span>
                    <div class="input-group @error('blood_group_id') is-invalid border border-danger rounded @enderror">
                        <x-form.select wire:model.defer='blood_group_id'>
                            @foreach ($listBloodGroups as $bloodGroup)
                                <option selected value="{{ $bloodGroup->id }}">
                                    {{ $bloodGroup->name }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <x-form.label class="text-success" value="{{ __('Pays') }}" />
                <div class="input-group @error('country_id') is-invalid border border-danger rounded @enderror">
                    <x-form.select wire:model='country_id'>
                        @foreach ($listCountries as $country)
                            <option selected value="{{ $country->id }}">
                                {{ $country->flag . ' ' . $country->name }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Ville') }}" />
                    <span class="text-secondary" wire:loading wire:target='updatedCountryId'>Chargement
                        en
                        cours...</span>
                    <div class="input-group @error('city_id') is-invalid border border-danger rounded @enderror">
                        <x-form.select wire:model='city_id'>
                            <option value="">Choisir</option>
                            @foreach ($listCities as $ciry)
                                <option value="{{ $ciry->id }}">{{ $ciry->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Commune') }}" />

                    <div
                        class="input-group @error('municipality_id') is-invalid border border-danger rounded @enderror">
                        <x-form.select wire:model='municipality_id'>

                            @foreach ($listMunicipalities as $municipality)
                                <option value="{{ $municipality->id }}">{{ $municipality->name }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Quartier') }}" />
                    <div class="input-group @error('district') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" placeholder="Votre quartier" wire:model.defer='district' />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Avenue') }}" />
                    <div
                        class="input-group @error('address_street') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" placeholder="Votre quartier" wire:model.defer='address_street' />
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <x-form.label class="text-success" value="{{ __('Numero') }}" />
                    <span class="text-danger"> (Non obligatoire)</span>
                    <div
                        class="input-group @error('address_street_number') is-invalid border border-danger rounded @enderror">
                        <x-form.input type="text" placeholder="Votre quartier"
                            wire:model.defer='address_street_number' />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <x-form.button type="submit" class="btn-color-primay d-flex justify-content-center align-items-center">
                <div wire:loading wire:target='handlerSubmit' class="spinner-border spinner-border-sm text-white"
                    role="status"></div>
                <span class="pl-2">Save changes</span>
            </x-form.button>
        </div>
    </form>
</div>
