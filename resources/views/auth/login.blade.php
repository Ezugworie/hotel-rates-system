@extends('layouts.app')

@section('content')
<div class="w-full">
    <div class="flex flex-row w-full h-screen items-center justify-evenly">
        <!-- <div 
            class="h-screen hidden md:flex justify-center w-3/5 bg-gray-500 bg-no-repeat bg-cover relative items-center login--background"
            >
           
        </div> -->
        <img class="inset-0  hidden md:flex justify-center w-3/5" src="{{ URL::to('/assets/svgs/hotel.svg') }}">
        <div class="w-1/4 flex flex-col items-center justify-self-center py-10 mx-5 border rounded shadow-md">
            <span class="text-3xl font-medium uppercase self-center text-gray-500"> {{ __('Admin Login') }}</span>
            <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col self-center justify-center p-8">
                @csrf

                <div class="mb-3">
                    <label for="email" class="mb-3"> {{ __('Email') }}</label>

                    <div class="flex flex-col">
                        <input 
                            id="email" 
                            type="email" 
                            class="focus:outline-none 
                                    focus:ring ring-gray-200 border-2 
                                    rounded-md w-full p-3 @error('email') 
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
                                    rounded-md w-full p-3 
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

                <button 
                    type="submit" 
                    class="w-full bg-gray-500 mt-6
                            text-gray-50 
                            rounded-md p-3
                            hover:bg-gray-700 focus:outline-none
                            shadow
                            focus:ring-2 focus:ring-gray-600 
                            focus:ring-opacity-50">
                    {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
