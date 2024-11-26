@extends('layouts.auth')

@section('title', 'Register PKBI')

@section('content')

  <section class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-semibold text-center text-blue-600">Create an Account</h2>
      <p class="mt-2 text-sm text-center text-gray-600">Fill in the details below to sign up</p>

      <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
        @csrf

        <!-- Name Field -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" id="name" name="name"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="John Doe" value="{{ old('name') }}" required>
          @error('name')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email Field -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="you@example.com" value="{{ old('email') }}" required>
          @error('email')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password Field -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="********" required>
          @error('password')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirm Password Field -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="********" required>
          @error('password_confirmation')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Register Button -->
        <button type="submit"
          class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 focus:outline-none focus:bg-blue-700">
          Sign Up
        </button>
      </form>

      <!-- Divider -->
      <div class="mt-6 flex items-center justify-center">
        <span class="text-sm text-gray-600">Already have an account?</span>
        <a href="{{ route('login') }}" class="ml-2 text-sm text-blue-600 font-medium hover:underline">Log in</a>
      </div>
    </div>
  </section>

@endsection
