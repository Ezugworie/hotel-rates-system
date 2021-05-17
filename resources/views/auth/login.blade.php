@extends('layouts.app')

@section('content')
<div class="w-full">
    <div class="flex justify-center items-center">
        <div class="w-full md:w-1/4 flex flex-col justify-center border rounded-md py-10 mx-5 shadow">
            <span class="text-lg font-medium uppercase self-center"> {{ __('Admin Login') }}</span>
            <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col self-center p-8">
                @csrf

                <div class="mb-3">
                    <label for="email" class="mb-3"> {{ __('Email') }}</label>

                    <div class="flex flex-col">
                        <input 
                            id="email" 
                            type="email" 
                            class="focus:outline-none 
                                    focus:ring ring-gray-200 border border-2 
                                    rounded-md w-full p-2 @error('email') 
                                    is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback text-red-400 text-sm font-thin" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="mb-1"> {{ __('Password') }}</label>

                    <div class="flex flex-col">
                        <input 
                            id="password" 
                            type="password" 
                            class="focus:outline-none focus:ring ring-gray-200 
                                    border 
                                    rounded-md w-full p-2 
                                    @error('password') 
                                    is-invalid @enderror"
                            name="password" 
                            required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback text-red-400 text-sm font-thin" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gray-500 
                            text-gray-50 
                            rounded-md p-2
                            hover:bg-gray-700 focus:outline-none
                            shadow
                            focus:ring-2 focus:ring-gray-600 
                            focus:ring-opacity-50">
                    {{ __('Login') }}
                </button>
                <div class="mt-3">
                    <span>{{ __('Don\'t have account?') }}</span>
                    <a class="underline" href="{{ route('register') }}">{{ __('Register Here') }}</a>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
