<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <div class="text-red-500" id="email-status"></div>

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone No -->
            <div class="mt-4">
                <x-input-label for="phone_no" :value="__('Phone no')" />

                <x-text-input id="phone_no" class="block mt-1 w-full" type="number" name="phone_no" :value="old('phone_no')"
                    required />

                <x-input-error :messages="$errors->get('phone_no')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button id="register" class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script>
            function validateEmail(email) {
                return String(email)
                    .toLowerCase()
                    .match(
                        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    );
            };

            $("#email").on('input', function(e) {
                const email = e.target.value;

                // Frontend Validation.
                if (validateEmail(email)) {
                    $("#email-status").html("");
                    $("#register").removeAttr('disabled');
                } else {
                    $("#email-status").html("Invalid Email.");
                    $("#register").attr('disabled', 'true');
                    return;
                }

                // Send to server to check the Email.
                $("#email-status").html('Checking email...');
                $.ajax({
                        method: "POST",
                        url: "/api/check-email",
                        data: {
                            email: email,
                        }
                    })
                    .done(function(response) {
                        if (response.status) {
                            $("#email-status").html("");
                            $("#register").removeAttr('disabled');
                        } else {
                            $("#register").attr('disabled', 'true');
                            $("#email-status").html(response.message);
                        }
                    })
                    .fail(function() {
                        console.error('Something went wrong.');
                    });
            });
        </script>
    @endsection
</x-guest-layout>
