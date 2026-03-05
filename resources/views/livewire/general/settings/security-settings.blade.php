<div>
    <div>
        <x-alerts.success/>
    </div>

    <h2 class="mb-2">Update Password</h2>

    <p class="mb-2">
        <a href="#password" class="text-primary underline hover:text-secondary">Click here</a> for password requirements
    </p>

    <form wire:submit="save" class="mb-2">
        @csrf
        <div class="flex flex-col justify-center">
            <x-forms.input-password wire:model.blur="password"/>
            <x-forms.input-conf-password wire:model.blur="password_confirmation"/>
        </div>

        <div class="mt-2 flex justify-center">
            <x-forms.input-submit/>
        </div>
    </form>

    <div class="border-t border-gray-300 my-6"></div>


    <h3 class="mb-2">Two Factor Authentication</h3>


    <!-- If user has NOT enabled 2FA at all: -->
    @unless (auth()->user()->two_factor_secret)
        <!-- Show the "Enable 2FA" button -->
        <form method="POST" action="/user/two-factor-authentication" class="flex justify-center">
            @csrf
            <x-forms.input-submit value="Enable Two-Factor"/>
        </form>

        <!-- If user has enabled 2FA but NOT confirmed it yet: -->

    @elseif (! auth()->user()->two_factor_confirmed_at)
        <div class="flex flex-col justify-center text-center">
            <div class="mb-4 font-medium text-sm text-danger ">
                Please finish configuring two factor authentication below.
            </div>

            <!-- Show QR Code, Recovery Codes, and Confirm Form -->
            <div class="m-auto mb-4">{!! auth()->user()->twoFactorQrCodeSvg() !!}</div>

            <!-- List recovery codes -->
            <ul class="mb-4">
                <span class="font-semibold">Recovery Codes</span>
                @foreach ((array) auth()->user()->recoveryCodes() as $code)
                    <li>{{ $code }}</li>
                @endforeach
            </ul>
            <!-- Form to POST code to /user/confirmed-two-factor-authentication -->
            <form method="POST" action="/user/confirmed-two-factor-authentication">
                @csrf
                <label for="code">Authenticator Code</label>
                <input type="text" name="code" id="code" class="mb-2">
                <x-forms.input-submit value="Confirm 2FA"/>
            </form>
        </div>
        <!-- If user has enabled and confirmed 2FA: -->
    @else
        <div class="text-green-600">
            Two Factor Authentication is fully enabled!
        </div>
        <!-- Display disable button if user wants to remove 2FA -->
        <form method="POST" action="/user/two-factor-authentication">
            @csrf
            @method('DELETE')
            <div class="flex justify-center">
                <x-forms.input-submit value="Disable Two-Factor"/>
            </div>

        </form>
    @endunless

    <div class="border-t border-gray-300 my-6"></div>

    <x-content.password-requirements/>

</div>
