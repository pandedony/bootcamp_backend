@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white border rounded-lg shadow-xl">
                <div class="text-xl bg-gray-200 p-4">{{ __('Register') }}</div>

                <div class="p-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Name') }}</label>

                            <input id="name" type="text" class="mt-1 p-2 w-full border rounded-md @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-600">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="mt-1 p-2 w-full border rounded-md @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-600">{{ __('Password') }}</label>

                            <input id="password" type="password" class="mt-1 p-2 w-full border rounded-md @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-600">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" type="password" class="mt-1 p-2 w-full border rounded-md" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection