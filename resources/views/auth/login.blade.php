@extends('layouts.auth')

@section('title', 'Login PKBI')

@section('content')
  <section class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-semibold text-center text-blue-600">Selamat Datang</h2>
      <p class="mt-2 text-sm text-center text-gray-600">Masuk ke akun PKBI-mu</p>

      <!-- Session Status -->
      @if (session('status'))
        <div id="status-message"
          class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4">
          {{ session('status') }}
          <button id="close-btn" class="absolute top-0 right-0 mt-2 mr-2 text-green-700">&times;</button>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Field -->
        <div class="!mt-2">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="@gmail.com" value="{{ old('email') }}" required autofocus>
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password Field -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="********" required>
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between">
          <label for="remember_me" class="flex items-center">
            <input id="remember_me" type="checkbox" class="text-blue-600 focus:ring-blue-500 h-4 w-4 rounded"
              name="remember">
            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
          @endif
        </div>

        <!-- Login Button -->
        <button type="submit"
          class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 focus:outline-none focus:bg-blue-700">
          Log In
        </button>
      </form>

      <!-- Divider -->
      <div class="mt-6 flex items-center justify-center">
        <span class="text-sm text-gray-600">Belum Punya Akun?</span>
        <a href="{{ route('register') }}" class="ml-2 text-sm text-blue-600 font-medium hover:underline">Daftar disini</a>
      </div>
    </div>
  </section>
@endsection
