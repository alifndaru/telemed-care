@extends('layouts.auth')

@section('title', 'Login PKBI')

@section('content')

  <section class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-semibold text-center text-blue-600">Create an Account</h2>
      <p class="mt-2 text-sm text-center text-gray-600">Fill in the details below to sign up</p>

      <form class="mt-8 space-y-6">
        <!-- Name Field -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" id="name"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="John Doe" required>
        </div>

        <!-- Email Field -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="you@example.com" required>
        </div>

        <!-- Jenis Kelamin Field -->
        <div>
          <label for="Jenis Kelamin" class="block text-sm mb-3 font-medium text-gray-700">Jenis Kelamin</label>

          <div class="inline">
            <input type="radio" value="Pria">
            <label for="pria">Pria</label>
          </div>
          <div class="m-3 inline">
            <input type="radio" value="Wanita">
            <label for="wanita">Wanita</label>
          </div>

        </div>

        <!-- Password Field -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="********" required>
        </div>

        <!-- Confirm Password Field -->
        <div>
          <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <input type="password" id="confirm-password"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="********" required>
        </div>

        <!-- Register Button -->
        <button type="submit"
          class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 focus:outline-none focus:bg-blue-700">Sign
          Up</button>
      </form>

      <!-- Divider -->
      <div class="mt-6 flex items-center justify-center">
        <span class="text-sm text-gray-600">Already have an account?</span>
        <a href="#" class="ml-2 text-sm text-blue-600 font-medium hover:underline">Log in</a>
      </div>
    </div>
  </section>
@endsection
