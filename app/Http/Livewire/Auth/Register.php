<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Register extends Component
{

    public $name ='';
    public $email = '';
    public $password = '';
    public $phone = '';
    public $password_confirmation = '';

    protected $rules=[
    'name' => 'required|min:3',
    'email' => 'required|email',
    'password' => 'required|min:5',];


    public function store(){

        $this->validate();

        $response = Http::post(config('services.backend.url').'/api/register', [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number'=> $this->phone,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
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
            $errors = $response->json()['errors'] ?? [];
            foreach ($errors as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
