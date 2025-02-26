<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

                        {{-- register  --}}
                        <form id="register" method="POST" action="{{ route('register') }}"  x-show="activeForm === 'register'"  x-cloak>
                            @csrf


                            <div class="mb-3">
                                <label class="form-label text-dark">Name</label>
                                <input  id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="form-control">
                            </div>


                            <div class="mb-3">
                                <label class="form-label text-dark">Email</label>
                                <input  id="email"  type="email" name="email" :value="old('email')" required autocomplete="username" class="form-control">
                            </div>

                            <!-- Password -->
                             <div class="mt-3">
                                 <label for="password" class="form-label">Password</label>
                                 <input id="password" type="password" name="password" required  autocomplete="new-password" class="form-control">
                                 @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                             </div>

                             <!-- Confirm Password -->
                             <div class="mt-3">
                                 <label for="password_confirmation" class="form-label">Confirm Password</label>
                                 <input id="password_confirmation" type="password" name="password_confirmation" required  autocomplete="new-password" class="form-control">
                                 @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                             </div>

                            {{-- <div class="mb-3">
                                <label class="form-label text-dark">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">+91</span>
                                    <input type="text" class="form-control" required>
                                    <button class="btn btn-outline-dark">Get OTP</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-dark">State</label>
                                    <select class="form-select" required>
                                        <option selected disabled>Select State</option>
                                        <option>Punjab</option>
                                        <option>Delhi</option>
                                        <option>Maharashtra</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-dark">City</label>
                                    <select class="form-select" required>
                                        <option selected disabled>Select City</option>
                                        <option>Jalandhar</option>
                                        <option>Chandigarh</option>
                                        <option>Mumbai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-dark">Qualification</label>
                                    <select class="form-select" required>
                                        <option selected disabled>Select Qualification</option>
                                        <option>12th Pass</option>
                                        <option>Graduation</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-dark">Discipline Interested In</label>
                                    <select class="form-select" required>
                                        <option selected disabled>Select Discipline</option>
                                        <option>Engineering</option>
                                        <option>Management</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="mb-3 mt-3 form-check">
                                <input type="checkbox" class="form-check-input" required>
                                <label class="form-check-label text-dark">I authorize LPU to contact me via Email, SMS, WhatsApp, and Call.</label>
                            </div>

                            <button type="submit" class="btn bg btn-primary w-100">Register</button>
                        </form>
</x-guest-layout>
