@extends('layouts.app')

@section('title', 'Login PKBI')

@section('content')

  <section class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-semibold text-center text-blue-600">Welcome Back</h2>
      <p class="mt-2 text-sm text-center text-gray-600">Please login to your account</p>

      <form class="mt-8 space-y-6">
        <!-- Email Field -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="you@example.com" required>
        </div>

        <!-- Password Field -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="********" required>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between">
          <label class="flex items-center">
            <input type="checkbox" class="text-blue-600 focus:ring-blue-500 h-4 w-4 rounded" />
            <span class="ml-2 text-sm text-gray-600">Remember me</span>
          </label>
          <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
        </div>

        <!-- Login Button -->
        <button type="submit"
          class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 focus:outline-none focus:bg-blue-700">Log
          In</button>
      </form>

      <!-- Divider -->
      <div class="mt-6 flex items-center justify-center">
        <span class="text-sm text-gray-600">Don't have an account?</span>
        <a href="#" class="ml-2 text-sm text-blue-600 font-medium hover:underline">Sign up</a>
      </div>
    </div>
  </section>
@endsection
