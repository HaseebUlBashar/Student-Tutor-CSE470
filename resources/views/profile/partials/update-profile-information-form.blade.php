{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"
      action="{{ route('profile.update') }}"
      enctype="multipart/form-data"
      class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
    <x-input-label for="profile_picture" :value="__('Profile Picture')" />

    <div class="mt-3 flex items-center gap-4">

        @if ($user->profile_picture)
            <img
                src="{{ asset('storage/' . $user->profile_picture) }}"
                alt="{{ $user->name }}"
                class="w-20 h-20 rounded-full object-cover border border-gray-300"
            >
        @else
            <div
                class="w-20 h-20 rounded-full bg-blue-600
                       flex items-center justify-center
                       text-white text-2xl font-bold"
            >
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
        @endif

        <div>
            <input
                id="profile_picture"
                name="profile_picture"
                type="file"
                accept="image/jpeg,image/png,image/webp"
                class="block w-full text-sm text-gray-700
                       dark:text-gray-300"
            >

            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('profile_picture')"
            />
        </div>

    </div>
</div>
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div>
    <x-input-label for="phone" :value="__('Phone')" />

    <x-text-input
        id="phone"
        name="phone"
        type="text"
        class="mt-1 block w-full"
        :value="old('phone', $user->phone)"
        autocomplete="tel"
        placeholder="Enter your phone number"
    />

    <x-input-error
        class="mt-2"
        :messages="$errors->get('phone')"
    />
</div>
<div>
    <x-input-label for="department" :value="__('Department')" />

    <select
        id="department"
        name="department"
        class="mt-1 block w-full rounded-md
               border-gray-300 dark:border-gray-700
               dark:bg-gray-900 dark:text-gray-300
               focus:border-indigo-500
               focus:ring-indigo-500"
    >
        <option value="">Select Department</option>

        <option
            value="CSE"
            {{ old('department', $user->department) === 'CSE' ? 'selected' : '' }}
        >
            CSE
        </option>

        <option
            value="BBA"
            {{ old('department', $user->department) === 'BBA' ? 'selected' : '' }}
        >
            BBA
        </option>

        <option
            value="EEE"
            {{ old('department', $user->department) === 'EEE' ? 'selected' : '' }}
        >
            EEE
        </option>
    </select>

    <x-input-error
        class="mt-2"
        :messages="$errors->get('department')"
    />
</div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

```
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __("Update your account's profile information, contact details and department.") }}
    </p>
</header>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form
    method="post"
    action="{{ route('profile.update') }}"
    enctype="multipart/form-data"
    class="mt-6 space-y-6"
>
    @csrf
    @method('patch')

    <!-- Profile Picture -->
    <div>
        <x-input-label for="profile_picture" :value="__('Profile Picture')" />

        <div class="mt-3 flex items-center gap-4">

            @if ($user->profile_picture)
                <img
                    src="{{ asset('storage/' . $user->profile_picture) }}"
                    alt="{{ $user->name }}"
                    class="w-20 h-20 rounded-full object-cover border border-gray-300"
                >
            @else
                <div
                    class="w-20 h-20 rounded-full bg-blue-600
                           flex items-center justify-center
                           text-white text-2xl font-bold"
                >
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div>
                <input
                    id="profile_picture"
                    name="profile_picture"
                    type="file"
                    accept="image/jpeg,image/png,image/webp"
                    class="block w-full text-sm text-gray-700
                           dark:text-gray-300"
                >

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
                </p>

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('profile_picture')"
                />
            </div>

        </div>
    </div>

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />

        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name', $user->name)"
            required
            autofocus
            autocomplete="name"
        />

        <x-input-error
            class="mt-2"
            :messages="$errors->get('name')"
        />
    </div>

    <!-- Email -->
    <div>
        <x-input-label for="email" :value="__('Email')" />

        <x-text-input
            id="email"
            name="email"
            type="email"
            class="mt-1 block w-full"
            :value="old('email', $user->email)"
            required
            autocomplete="username"
        />

        <x-input-error
            class="mt-2"
            :messages="$errors->get('email')"
        />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button
                        form="send-verification"
                        class="underline text-sm text-gray-600
                               dark:text-gray-400 hover:text-gray-900
                               dark:hover:text-gray-100 rounded-md
                               focus:outline-none focus:ring-2
                               focus:ring-offset-2 focus:ring-indigo-500
                               dark:focus:ring-offset-gray-800"
                    >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <!-- Phone -->
    <div>
        <x-input-label for="phone" :value="__('Phone')" />

        <x-text-input
            id="phone"
            name="phone"
            type="text"
            class="mt-1 block w-full"
            :value="old('phone', $user->phone)"
            autocomplete="tel"
            placeholder="Enter your phone number"
        />

        <x-input-error
            class="mt-2"
            :messages="$errors->get('phone')"
        />
    </div>

    <!-- Department -->
    @if (Auth::user()->role !== 'admin')
    <div>
        <x-input-label for="department" :value="__('Department')" />

        <select
            id="department"
            name="department"
            class="mt-1 block w-full rounded-md
                   border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-gray-300
                   focus:border-indigo-500
                   focus:ring-indigo-500"
        >
            <option value="">Select Department</option>

            <option
                value="CSE"
                {{ old('department', $user->department) === 'CSE' ? 'selected' : '' }}
            >
                CSE
            </option>

            <option
                value="BBA"
                {{ old('department', $user->department) === 'BBA' ? 'selected' : '' }}
            >
                BBA
            </option>

            <option
                value="EEE"
                {{ old('department', $user->department) === 'EEE' ? 'selected' : '' }}
            >
                EEE
            </option>
        </select>

        <x-input-error
            class="mt-2"
            :messages="$errors->get('department')"
        />
    </div>
    @endif
    <!-- Save -->
    <div class="flex items-center gap-4">
        <x-primary-button>
            {{ __('Save') }}
        </x-primary-button>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
```

</section>
