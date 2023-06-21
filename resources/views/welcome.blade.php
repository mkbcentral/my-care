<x-guest-layout>
    <div class="login-box">
        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <img src="{{ asset('logo.svg') }}" alt="" width="200px">
            </div>
            @livewire('authentification.login')
        </div>
    </div>
</x-guest-layout>
