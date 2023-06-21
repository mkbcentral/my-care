<?php

namespace App\Http\Livewire\Authentification;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\View\Components\GuestLayout;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    public function loginUser()
    {
        $request = new LoginRequest();
        $data = $this->validate($request->rules());
        try {
            if (Auth::attempt($data)) {
                return  redirect()->route('app.dashboard-main');
            }
            session()->flash('message', 'Email ou mot de password incorrect.');
        } catch (Exception $ex) {
            session()->flush(['message' => $ex->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.authentification.login');
    }
}
