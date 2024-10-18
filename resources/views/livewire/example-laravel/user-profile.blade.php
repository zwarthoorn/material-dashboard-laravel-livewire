<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ json_decode( Cookie::get('user'))->name }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        CEO / Co-Founder
                    </p>
                </div>
            </div>

        </div>
        <div class="card card-plain h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-3">Profile Information</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                @if (session('status'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{ Session::get('status') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif
                @if (Session::has('demo'))
                <div class="row">
                    <div class="alert alert-danger alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{ Session::get('demo') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif
                <form wire:submit='update'>
                    <div class="row">

                        <div class="mb-3 col-md-6">

                            <label class="form-label">Email address</label>
                            <input wire:model.blur="user.email" type="email" class="form-control border border-2 p-2" disabled>
                            @error('user.email')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">

                            <label class="form-label">Name</label>
                            <input wire:model.blur="user.name" type="text" class="form-control border border-2 p-2">
                            @error('user.name')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">

                            <label class="form-label">Phone</label>
                            <input wire:model.blur="user.phone_number" type="number" class="form-control border border-2 p-2">
                            @error('user.phone')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">

                            <label class="form-label">Username</label>
                            <input wire:model.blur="user.username" type="text" class="form-control border border-2 p-2">
                            @error('user.username')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-12">

                            <label class="form-label">Date of Birth</label>
                            <input wire:model.blur="user.date_of_birth" type="date" class="form-control border border-2 p-2">
                            @error('user.date_of_birth')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-3">Billing address</h6>
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">Street</label>
                            <input wire:model.blur="user.billing_address.street_address" type="text" class="form-control border border-2 p-2">
                            @error('user.billing_address.street_address')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">House Number</label>
                            <input wire:model.blur="user.billing_address.house_number" type="text" class="form-control border border-2 p-2">
                            @error('user.billing_address.house_number')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">City</label>
                            <input wire:model.blur="user.billing_address.city" type="text" class="form-control border border-2 p-2">
                            @error('user.billing_address.city')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">State / Provence</label>
                            <input wire:model.blur="user.billing_address.state_province" type="text" class="form-control border border-2 p-2">
                            @error('user.billing_address.state_province')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">Postal Codee</label>
                            <input wire:model.blur="user.billing_address.postal_code" type="text" class="form-control border border-2 p-2">
                            @error('user.billing_address.postal_code')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">Country</label>
                            <input wire:model.blur="user.billing_address.country" type="text" class="form-control border border-2 p-2" placeholder="NL">
                            @error('user.billing_address.country')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-3">Address</h6>
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">Street</label>
                            <input wire:model.blur="user.address.street_address" type="text" class="form-control border border-2 p-2">
                            @error('user.address.street_address')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">House Number</label>
                            <input wire:model.blur="user.address.house_number" type="text" class="form-control border border-2 p-2">
                            @error('user.address.house_number')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">City</label>
                            <input wire:model.blur="user.address.city" type="text" class="form-control border border-2 p-2">
                            @error('user.address.city')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">State / Provence</label>
                            <input wire:model.blur="user.address.state_province" type="text" class="form-control border border-2 p-2">
                            @error('user.address.state_province')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">Postal Codee</label>
                            <input wire:model.blur="user.address.postal_code" type="text" class="form-control border border-2 p-2">
                            @error('user.address.postal_code')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">

                            <label class="form-label">Country</label>
                            <input wire:model.blur="user.address.country" type="text" class="form-control border border-2 p-2" placeholder="NL">
                            @error('user.address.country')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn bg-gradient-dark">Submit</button>
                </form>

            </div>
        </div>
    </div>

</div>
