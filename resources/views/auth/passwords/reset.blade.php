@extends('layouts.app')
@section('content')
    <div class="sm:w-5/12 mb-10 container mx-auto">
        <div class="container mx-auto h-full lg:p-10">
            <header class="container mx-auto px-4 py-2 mt-10 lg:flex items-center h-full lg:mt-0">
                <div class="w-full">
                    <h1 class="text-2xl font-bold lg:text-4xl">Reset Your <span class="text-green-700">Password</span></h1>
                    <div class="w-24 h-2 bg-blue-700 my-4"></div>
                    <div class="mt-10">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="flex flex-col mb-5">
                                <label for="email" class="mb-1 text-xs tracking-wide text-gray-600">E-Mail Address:</label>
                                <div class="relative">
                                    <div
                                        class="inline-flex  items-center justify-center absolute left-0 top-0  h-full w-10 text-gray-400 ">
                                        <i class="fas fa-at text-green-500"></i>
                                    </div>
                                    <input id="email" type="email" name="email"
                                           class="text-sm placeholder-gray-500 pl-10 pr-4 rounded-2xl border border-gray-400 w-full py-2 focus:outline-none focus:border-green-400 @error('email') is-invalid @enderror "
                                           placeholder="Enter your email" value="{{ $email ?? old('email') }}" required
                                           autocomplete="email" autofocus />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col mb-6">
                                <label for="password"
                                       class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Password:</label>
                                <div class="relative">
                                    <div
                                        class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                        <span>
                                            <i class="fas fa-lock text-green-500"></i>
                                        </span>
                                    </div>

                                    <input id="password" type="password" name="password"
                                           class="text-sm placeholder-gray-500 pl-10 pr-4 rounded-2xl border border-gray-400 w-full py-2 focus:outline-none focus:border-green-400 @error('password') is-invalid @enderror "
                                           placeholder="Enter your password" required autocomplete="new-password" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col mb-6">
                                <label for="password-confirm"
                                       class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Confirm Password:</label>
                                <div class="relative">
                                    <div
                                        class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                        <span>
                                            <i class="fas fa-lock text-green-500"></i>
                                        </span>
                                    </div>
                                    <input id="password-confirm" type="password" name="password_confirmation"
                                           class="text-sm placeholder-gray-500 pl-10 pr-4 rounded-2xl border border-gray-400 w-full py-2 focus:outline-none focus:border-green-400"
                                           placeholder="Re-enter your password"
                                           required autocomplete="new-password" />
                                </div>
                            </div>
                            <div class="flex w-full">
                                <button type="submit"
                                        class=" flex mt-2 items-center justify-center focus:outline-none  text-white text-sm sm:text-base bg-green-500 hover:bg-green-600 rounded-2xl py-2 w-full transition duration-150 ease-in">
                                    <span class="mr-2 uppercase">Reset Password</span>
                                    <span>
                                        <svg class="h-6 w-6" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </header>
        </div>
    </div>
@endsection
