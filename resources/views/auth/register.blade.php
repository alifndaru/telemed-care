@extends('layouts.auth')

@section('title', 'Register PKBI')

@section('content')

  <section class="flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-bold text-center text-blue-600">Buat Akun</h2>
      <p class="mt-2 text-center text-gray-600">Isi form dibawah secara lengkap sesuai identitas anda</p>

      <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
        @csrf

        <!-- Name Field -->
        <div class="col-span-2">
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" id="name" name="name"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="Nama lengkap" value="{{ old('name') }}" required>
          @error('name')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div class="col-span-2">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
          @error('email')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div class="col-span-2">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="Password" required>
          @error('password')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="col-span-2">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Ulangi Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="Ulangi Password-mu" required>
          @error('password_confirmation')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Jenis Kelamin -->
        <div class="col-span-2 md:col-span-1">
          <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
          <select id="jenis_kelamin" name="jenis_kelamin"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            required>
            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            <option value="Lainnya" {{ old('jenis_kelamin') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
          </select>
          @error('jenis_kelamin')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Tempat Lahir -->
        <div class="col-span-2 md:col-span-1">
          <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
          <input type="text" id="tempat_lahir" name="tempat_lahir"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="Kota" value="{{ old('tempat_lahir') }}" required>
          @error('tempat_lahir')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Tanggal Lahir -->
        <div class="col-span-2 md:col-span-1">
          <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
          <input type="date" id="tanggal_lahir" name="tanggal_lahir"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            value="{{ old('tanggal_lahir') }}" required>
          @error('tanggal_lahir')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Status Pernikahan -->
        <div class="col-span-2 md:col-span-1">
          <label for="status_pernikahan" class="block text-sm font-medium text-gray-700">Status Pernikahan</label>
          <select id="status_pernikahan" name="status_pernikahan"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            required>
            <option value="Menikah" {{ old('status_pernikahan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
            <option value="Belum Menikah" {{ old('status_pernikahan') == 'Belum Menikah' ? 'selected' : '' }}>Belum
              Menikah
            </option>
          </select>
          @error('status_pernikahan')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Agama -->
        <div class="col-span-2 md:col-span-1">
          <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
          <input type="text" id="agama" name="agama"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="agama" value="{{ old('agama') }}" required>
          @error('agama')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- No Telp -->
        <div class="col-span-2 md:col-span-1">
          <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telp</label>
          <input type="text" id="no_telp" name="no_telp"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="Nomor Telepon / WhatsApp" value="{{ old('no_telp') }}" required>
          @error('no_telp')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Alamat -->
        <div class="col-span-2">
          <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
          <textarea id="alamat" name="alamat"
            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
            placeholder="Alamat" required>{{ old('alamat') }}</textarea>
          @error('alamat')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit Button -->
        <div class="col-span-2 text-center">
          <button type="submit"
            class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none">
            Daftar
          </button>
        </div>
      </form>
    </div>
  </section>

@endsection
