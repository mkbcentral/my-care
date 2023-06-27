<div>
    <div class="d-flex justify-content-end p-2">
        <x-form.button type="button" class="btn-color-primay" data-toggle="modal"
                 data-target="#showCreatePatienModal">
            Nouveau...
        </x-form.button>
    </div>
    <div wire:ignore.self class="modal fade" id="showCreatePatienModal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" µaria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong>CREER UN NOUVEAU PATIENT</strong></h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="w-25 mx-auto ">
                        <div class="card">
                            <div class="card-body">
                                @error('idPatientToSearch')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="d-flex">
                                    <x-form.input type="text" placeholder="ID PATIENT"
                                        wire:model.defer='idPatientToSearch' />
                                    <x-form.button type="button" wire:click.prevent='getPatientById' class="btn-primary">
                                        Vérifier
                                    </x-form.button>
                                </div>
                            </div>
                        </div>
                        <span wire:loading wire:target='getPatientById' class="text-center mt-2">Chargement en cours...</span>
                    </div>
                    <form wire:submit.prevent='handlerSubmit'>
                        <div class="row ">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-form.label class="text-success" value="{{ __('Nom complet du patient') }}" />
                                    <div
                                        class="input-group @error('full_name') is-invalid border border-danger rounded @enderror">
                                        <x-form.input type="text" placeholder="Nom du patient"
                                            wire:model.defer='full_name' />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-form.label class="text-success" value="{{ __('Date de naissance') }}" />
                                    <div
                                        class="input-group @error('date_of_birth') is-invalid border border-danger rounded @enderror">
                                        <x-form.date-picker
                                            wire:model.defer='date_of_birth' id="dateOfBirth"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-form.label class="text-success" value="{{ __('Genre/Sexe') }}" />
                                    <div
                                        class="input-group @error('gender') is-invalid border border-danger rounded @enderror">
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
                                    <div
                                        class="input-group @error('blood_group_id') is-invalid border border-danger rounded @enderror">
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
                                <div
                                    class="input-group @error('country_id') is-invalid border border-danger rounded @enderror">
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
                                    <div
                                        class="input-group @error('city_id') is-invalid border border-danger rounded @enderror">
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
                                    <span class="text-secondary" wire:loading
                                        wire:target='updatedCountryId'>Chargement
                                        en
                                        cours...</span>
                                    <div
                                        class="input-group @error('municipality_id') is-invalid border border-danger rounded @enderror">
                                        <x-form.select wire:model='municipality_id'>
                                            <option value="">Choisir</option>
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
                                    <div
                                        class="input-group @error('district') is-invalid border border-danger rounded @enderror">
                                        <x-form.input type="text" placeholder="Votre quartier"
                                            wire:model.defer='district' />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-form.label class="text-success" value="{{ __('Avenue') }}" />
                                    <div
                                        class="input-group @error('address_street') is-invalid border border-danger rounded @enderror">
                                        <x-form.input type="text" placeholder="Votre quartier"
                                            wire:model.defer='address_street' />
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-form.label class="text-success" value="{{ __('Type consultation') }}" />
                                    <div
                                        class="input-group @error('consultation_id') is-invalid border border-danger rounded @enderror">
                                        <x-form.select wire:model='consultation_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($listConsultations as $consultation)
                                                <option value="{{ $consultation->id }}">{{ $consultation->name }}
                                                </option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-form.label class="text-success" value="{{ __('Type patient') }}" />
                                    <span class="text-danger"> (Privé,Abonné,...)</span>
                                    <div
                                        class="input-group @error('sheet_type_patient_id') is-invalid border border-danger rounded @enderror">
                                        <x-form.select wire:model='sheet_type_patient_id'>
                                            @foreach ($listSheetTypePatient as $sheetType)
                                                <option selected value="{{ $sheetType->id }}">{{ $sheetType->name }}
                                                </option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                </div>
                            </div>
                            @if ($isCompany)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <x-form.label class="text-success" value="{{ __('Société') }}" />
                                        <div
                                            class="input-group @error('company_id') is-invalid border border-danger rounded @enderror">
                                            <x-form.select wire:model='company_id'>
                                                <option value="">Choisir...</option>
                                                @foreach ($listCompanies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </x-form.select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($isService)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <x-form.label class="text-success" value="{{ __('Service') }}" />
                                        <div
                                            class="input-group @error('service_id') is-invalid border border-danger rounded @enderror">
                                            <x-form.select wire:model='service_id'>
                                                <option value="">Choisir...</option>
                                                @foreach ($listServices as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </x-form.select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="d-flex justify-content-end">
                            <x-form.button type="submit"
                                class="btn-color-primay d-flex justify-content-center align-items-center">
                                <div wire:loading wire:target='handlerSubmit'
                                    class="spinner-border spinner-border-sm text-white" role="status"></div>
                                <span class="pl-2">Save changes</span>
                            </x-form.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
