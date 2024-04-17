@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white border rounded-lg shadow-xl">
                <div class="text-xl bg-gray-200 p-4">{{ __('Login') }}</div>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error:</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="p-6">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-600">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="mt-1 p-2 w-full border rounded-md @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-600">{{ __('Password') }}</label>

                            <input id="password" type="password" class="mt-1 p-2 w-full border rounded-md @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input class="form-checkbox h-4 w-4 text-indigo-600" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="ml-2 text-sm text-gray-600" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 ml-2" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection