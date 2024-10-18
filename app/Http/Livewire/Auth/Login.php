<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{

    public $email='';
    public $password='';

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required'

    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        $attributes = $this->validate();

        if (! $attributes)
        {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        $response = Http::post(config('services.backend.url').'/api/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $token = $data['access_token'];
            $user = $data['user'];

            // Store the token in a secure HTTP-only cookie
            cookie()->queue('api_token', $token, 60 * 24 * 30); // 30 days
            cookie()->queue('user', json_encode($user), 60 * 24 * 30); // 30 days


            return redirect()->intended('/dashboard');
        } else {
            $this->addError('login', 'Invalid credentials');
        }
    }
}
