<div class="card-body">
    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent='loginUser'>
        <x-form.label class="text-lb-primary-400" value="{{ __('Adresse mail') }}" />
        <div class="input-group @error('email') is-invalid border border-danger rounded @enderror">
            <x-form.input type="text" placeholder="Adresse mail" wire:model.defer='email' />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user text-lb-primary"></span>
                </div>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        <x-form.label class="text-lb-primary-400 mt-3" value="{{ __('Mot de passe') }}" />
        <div class="input-group  @error('password') is-invalid border border-danger rounded @enderror">
            <x-form.input type="password" placeholder="******" wire:model.defer='password' />
            <div class="input-group-append">
                <div class="input-group-text bg-successs">
                    <span class="fas fa-lock text-lb-primary"></span>
                </div>
            </div>
        </div>

        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        <div class="row mt-4">
            <div class="col-12">
                <x-form.button type="submit" class="btn-color-primay d-flex justify-content-center align-items-center">
                    <div wire:loading wire:target='loginUser' class="spinner-border spinner-border-sm text-white"
                        role="status"></div>
                    <span class="pl-2">Se connecter</span>
                </x-form.button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>
