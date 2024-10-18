<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\User;
use App\UserApiService;
use Livewire\Component;

class UserProfile extends Component
{

    public array $user;

    protected function rules(){
        return [
            'user.name' => 'required',
            'user.email' => 'required|email',
            'user.phone_number' => 'required|max:10',
            'user.billing_address.street_address' => 'required',
            'user.billing_address.house_number' => 'required',
            'user.billing_address.city' => 'required',
            'user.billing_address.state_province' => 'required',
            'user.billing_address.postal_code' => 'required',
            'user.billing_address.country' => 'required',
            'user.address.street_address' => 'required',
            'user.address.house_number' => 'required',
            'user.address.city' => 'required',
            'user.address.state_province' => 'required',
            'user.address.postal_code' => 'required',
            'user.address.country' => 'required',
        ];
    }

    public function mount(UserApiService $userService) {

        $savedUser = json_decode( request()->cookie('user'));
        $user =$userService->getUserById($savedUser->id);

        $this->user = $user['data'];

    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();


        dd($this->user);

        return back()->withStatus('Profile successfully updated.');
    }


public function render()
{
    return view('livewire.example-laravel.user-profile');
}

}
