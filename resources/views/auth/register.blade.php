@extends('layouts.app')

@section('content')

<div class="w-full">
    <div class="flex justify-center items-center">
        <div class="w-full md:w-1/4 flex flex-col justify-center border rounded-md py-10 mx-5 shadow">
            <span class="text-lg font-medium uppercase self-center">Register</span>
            <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col self-center p-8">
                @csrf

                <div class="mb-3">
                    <label for="name" class="mb-3">Fullname</label>

                    <div class="flex flex-col">
                        <input 
                            id="name" 
                            type="text" 
                            class="focus:outline-none 
                                    focus:ring ring-gray-200 border border-2 
                                    rounded-md w-full p-2 @error('name') 
                                    is-invalid @enderror" 
                            name="email" 
                            value="{{ old('name') }}" 
                            required autocomplete="name" autofocus>

                        @error('email')
                            <span class="invalid-feedback text-red-400 text-sm font-thin" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="mb-3">Email</label>

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
                    <label for="password" class="mb-1">Password</label>

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
                            required>

                        @error('password')
                            <span class="invalid-feedback text-red-400 text-sm font-thin" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="mb-1">Confirm Password</label>

                    <div class="flex flex-col">
                        <input 
                            id="password-confirm" 
                            type="password" 
                            class="focus:outline-none focus:ring ring-gray-200 
                                    border 
                                    rounded-md w-full p-2 
                                    @error('password') 
                                    is-invalid @enderror"
                            name="password_confirmation" 
                            required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback text-red-400 text-sm font-thin" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                    {{ __('Register') }}
                </button>
                <div class="mt-3">
                    <span>{{ __('Already have account?') }}</span>
                    <a class="underline" href="{{ route('login') }}">{{ __('Login Here') }}</a>

                </div>
            </form>


        </div>
    </div>
</div>
@endsection
